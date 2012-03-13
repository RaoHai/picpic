<?php
	class upload 
{ 
		public $_file; 

		public function __construct( $name =null) 
		{ 
			if(is_null($name) || !isset($_FILES[$name])) 
			$name = key($_FILES); 

			if(!isset($_FILES[$name])) 
			echo"并没有文件上传"; 

			$this->_file = $_FILES[$name]; 

			if(!is_uploaded_file($this->_file['tmp_name'])) 
			echo"异常情况"; 
			if($this->_file['error'] !== 0) 
			echo"错误代码:".$this->_file['error']; 
			} 
			public function moveTo( $new_dir) 
			{ 
			$real_dir = $this->checkDir($new_dir); 
			return move_uploaded_file($this->_file['tmp_name'], $real_dir.'/'.$_SESSION['USERID'].".jpg"); 
			} 
			private function checkDir($dir) 
			{ 
			$real_dir = realpath($dir); 
			if($real_dir === false) 
			echo"给定目录{$dir}不存在"; 
			if(!is_writable($real_dir)) 
			echo"给定目录{$dir}不可写"; 
			return $real_dir; 
		}} 

?>