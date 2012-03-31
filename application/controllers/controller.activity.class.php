<?php

	require_once("controller.base.class.php");
	class activity extends ControllerBase
	{
		public function  __construct()
		{
			parent::__construct();
		}
		
		public function _index()//自定义你的action方法
		{
		
		}
		
		//添加消息
		public function _add($takeid,$title,$text,$permissions,$teamid)
		{
			$this->model->New(array($takeid,$title,$text,$permissions,$teamid));
		}
		
		//浏览消息
		public function _showinformation($activityID)
		{
			$this->model->Get_By_activityId($activityID);
			$re=$this->model->getresult();
			return $re;
		}
		
		//修改
		public function _updatetitle($id,$title)
		{
			$this->model->Set(array("title"=>$title,"time"=>date("Y-m-d")),array("Activity"=>$id));
		}
		
		
	}
?>