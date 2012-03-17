<?php

	require_once("controller.base.class.php");
	class message extends ControllerBase
	{
		public function  __construct()
		{
			parent::__construct();
		}
		
		public function _index()//自定义你的action方法
		{
			
		}		
		
		//发消息
		public function _takemessage($senderID,$reciverID,$messageText,$title)
		{
			$this->model->New(array($senderID,$reciverID,$messageText,0,0,$title,0));
		}
		//浏览消息
		//返回所有message表中所有信息，readmark为1时为已读
		public function _showinformation($to)
		{
			$information=array();
			$this->model->Get_By_reciverID($to);
			$re=$this->model->getresult();
			//$i=0;
			
			
			return $re;
		}
		
		//对消息的处理
		//当take=0时为删除发件的，take=1时已读标记,take=2时删除收件
		public function _take($take)
		{
			if($take==0)
			$this->model->Set_senderDel_By_senderID($_SESSION["USERID"],1);
			if($take==1)
			$this->model->Set_readmark_By_reciverID($_SESSION["USERID"],1);
			if($take==2)
			$this->model->Set_reciverDel_By_reciverID($_SESSION["USERID"],1);
		}
		
		//回复，输入邮件ID，返回发信人ID
		public function _recive($ID)
		{
			$this->model->Get_By_reciverID($to);
			$re=$this->model->getresult();
			foreach($re as $r)
			{
				$reciver=$r->reciverID;
			}
			return $reciver;
		}
	}
?>