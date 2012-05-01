<?php

	require_once("controller.base.class.php");
	class teaminformation extends ControllerBase
	{
		public function  __construct()
		{
			parent::__construct();
		}
		
		public function _index()//自定义你的action方法
		{
					
		}
		
		//$teamname为群名，不能为空
		//$teammakers群注释，可以为空
		//$mader群创建者，一般为$_SESSION["USERID"]的值
		//$teamtake群类型，0为公开群，1为非开群......（建议选择的时候默认为0）
		//返回值为错误信息
		public function add($teamname,$teammakers,$mader,$teamtake)
		{
		$Teamuser=new teamuser();
		
			if($teamname!=NULL )
			{
			$this->model->New(array($teamname,$teammakers,$teamtake,$mader,date("Y-m-d")));
			$id=mysql_insert_id();
			$Teamuser->_add($_SESSION["USERID"],$id,2);
			}
			if($teamname==NULL)
			return "群名不能为空";
		}
		
		
		//分别为修改群名，群备注，群开放性
		//修改前要进行权限验证，群开放性只有群主能修改
		public function _updateteamname($teamID,$newname,$userid)
		{
		$Teamuser=new teamuser();
		//	if($Teamuser->_all("permissions")=='2')
			{
			if($newname!=null)
				$this->model->Set_teamname_By_teaminformationId($teamID,$newname);
		//		return "true";
			}
			/*
			else
			{
			 return "false";
			}
*/			
		}
		public function _updateteamremarks($teamID,$teamremarks,$userid)
		{
		$Teamuser=new teamuser();
		//	if($Teamuser->_all("permissions")=='2')
			{
			if($teamremarks!=null)
				$this->model->Set_teamremarks_By_teaminformationId($teamID,$teamremarks);
		//		return "true";
			}
			/*
			else
			{
			 return "false";
			}	
*/			
		}
		public function _updateteamtake($teamID,$teamtake,$userid)
		{
		$Teamuser=new teamuser();
			if($Teamuser->_all("permissions")=='2')
			{
			if($teamtake!=null)
				$this->model->Set_teamtake_By_teaminformationId($teamID,$teamtake);
				return true;
			}
			else
			{
			 return false;
			}			
		}
		
		//群删除，要进行权限认证
		public function _del($teamID,$userid)
		{
		$Teamuser=new teamuser();
			if($Teamuser->_all("permissions")=='2')
			{
				$this->model->Del_By_teaminformationId($teamID);
				return true;
			}
			else
			{
			 return false;
			}	
		}
		
		//显示群内容
		public function _show($ID)
		{
			$_SESSION["TEAMID"]=$ID;
			$this->model->Get_By_TeaminformationId($ID);
			$re=$this->model->getresult();
			return $re;
		}
		
		//输出所有群（以后增加群分类后也调用这个）
		public function _showallteam($teamID=0)
		{
		$User=new user;
		
			$this->model->Get('all',0,array($teamID,4));
			$re=$this->model->getresult();
			return $re;
			
		}
		
		
		
	}
?>