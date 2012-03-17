<?php

	require_once("controller.base.class.php");
	class image extends ControllerBase
	{
		public function  __construct()
		{
			parent::__construct();
		}
		
		public function _index()
		{
			$this->model->Get("all",array("id=5","sex=男"));
			//$this->model->Set(array("Description"=>"123456","feature"=>"aaaaa"),array("ImageId=90","GroupID=11"));
		}	
		public function _show()
		{
			echo "调用show动作成功:参数";
			
			
		}
		public function _getdesc()
		{
			$url = urlencode(trim(basename(stripslashes($_GET['url'])), ".\x00..\x20"));
			$this->model->Get_Description_By_imgurl($url);
			$re = $this->model->getresult();
			foreach($re as $r)
			{
				echo $r->Description;
			}
		}
		public function _edit()
		{
			$desc = $_GET['desc'];
			$url = urlencode(trim(basename(stripslashes($_GET['url'])), ".\x00..\x20"));
			$this->model->Set_Description_By_imgurl($url,$desc);
		}
	}
?>