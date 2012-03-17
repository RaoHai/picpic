<?php


	/**
	 * controller 的基类
	 *
	 * Copyright(c) 2011-2012 by surgesoft. All rights reserved
	 *
	 * To contact the author write to {@link mailto:surgesoft@gmail.com}
	 *
	 * @author surgesoft
	 * @version $Id: model.base.class.php 2012-01-06 16:06
	 * @package model.base.class.php
	 * 控制器的模板编译参考了vemplator
	 * 但是实现方法可能略有差异
	 */
	class ControllerBase
	{
		public $model;
		protected $view;
		protected $TemplateFolder;
		protected $TemplateFile;
		protected $values;
        public $instance;
		public function  __construct()
		{
			//$this->model = new ModelBase();
			$instance = get_class($this);
            $this->instance = $instance;
			$modelname = $instance."_model";
			require_once( APPLICATION_PATH."/models/model.{$instance}.class.php");
			$this->TemplateFolder= APPLICATION_PATH."/view/{$instance}/";
			$this->model	 = new $modelname($instance);
           
			//echo $modelname;
			//echo $TemplateFolder;
		}
        public function save()
        {
            global $_Struct;
            $savedata;
            foreach ($_Struct[$this->instance] as $data)
            {
                $savedata[]=isset($this->$data)?$this->$data:0;
            }
            $this->model->New($savedata);
           // var_dump($savedata);
            //var_dump($_Struct[$this->instance]);
        }
	
		 /*模板引擎
		 * 参考自vemplator
		 * 理论上这一部分应该放在view里
		 * 但是现在写在controller里
		 * view部分完全是模板和compiled过的文件
		*/
		protected function RenderTemplate($action)
		{
			$this->TemplateFile = $this->TemplateFolder."".$action.".rhtml";
			$compiledFile =  $this->TemplateFolder."".$action.".php";
			if(file_exists($this->TemplateFile)&& filemtime($compiledFile) >= filemtime($this->TemplateFile))
			{
				//echo filemtime($compiledFile),"|".filemtime($this->TemplateFile);
				require_once($compiledFile);
			}
			else
			{
				//echo "重新编译";
				$lines = file($this->TemplateFile);
				$newLines = array();
				$matches = null;
				foreach($lines as $line)  {
					$num = preg_match_all('/\{[$]([^{}]+)\}/', $line, &$matches);
					if($num > 0) {
						for($i = 0; $i < $num; $i++) {
							$match = $matches[0][$i];
							$new = $this->transformSyntax($matches[1][$i]);
							$line = str_replace($match, $new, $line);
						}
					}
					$newLines[] = $line;
				}
					$f = fopen($compiledFile, 'w');
					fwrite($f, implode('',$newLines));
					fclose($f);
					require_once($compiledFile);

			}
		}
		private function transformSyntax($input) {
		$from = array(
			'/(^|\|,|\(|\+| )([a-zA-Z_][a-zA-Z0-9_]*)($|\.|\)|\[|\|\+)/',
			'/(^|\|,|\(|\+| )([a-zA-Z_][a-zA-Z0-9_]*)($|\.|\)|\[|\|\+)/', 
			'/\./',
		);
		$to = array(
			'$1$this->values["$2$3"]',
			'$1$this->values["$2$3"]',
			'->'
		);
		
		$parts = explode(':', $input);
		
		$string = '<?php ';
		switch($parts[0]) { 
			case 'if':
			case 'switch':
				$string .= $parts[0] . '(' . preg_replace($from, $to, $parts[1]) . ') { ' . ($parts[0] == 'switch' ? 'default: ' : '');
				break;
			case 'foreach':
				$pieces = explode(',', $parts[1]);
				$string .= 'foreach(' . preg_replace($from, $to, $pieces[0]) . ' as ';
				$string .= preg_replace($from, $to, $pieces[1]);
				if(sizeof($pieces) == 3) 
					$string .= '=>' . preg_replace($from, $to, $pieces[2]);
				$string .= ') { ';
				break;
			case 'end':
			case 'endswitch':
				$string .= '}';
				break;
			case 'else':
				$string .= '} else {';
				break;
			case 'case':
    			$string .= 'break; case ' . preg_replace($from, $to, $parts[1]) . ':';
				break;
			case 'include':
				$string .= 'echo $this->output("' . $parts[1] . '");';
				break;
			default:
				$string .= 'echo ' . preg_replace($from, $to, $parts[0]) . ';';
				break;
		}
		$string .= ' ?>';
		return $string;
	}
	public function __call($FuncName,$arg)
	{
          Header("Location: /404.html");

	}
        }

	

?>
