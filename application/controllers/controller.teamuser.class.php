<?php

	require_once("controller.base.class.php");
	class teamuser extends ControllerBase
	{
	
		public function  __construct()
		{
			parent::__construct();
		}
		
		public function _index()//自定义你的action方法
		{
					
		}
		
		//增加群员
		public function _add($userID,$teamID,$permissions)
		{
			$this->model->New(array($userID,$permissions,"",$teamID,date("Y-m-d")));
			
		}
		
		//重复性验证
		public function _checkid($userid,$teamid)
		{
			$this->model->Get(array("TeamuserId"),array("userID=".$userid,"offerteamID=".$teamid));
			$re=$this->model->getresult();
			if($re!=NULL)
			return true;
			else
			return false;
		}
		
		//修改群员信息
		//注意：这里的userid为teamuser表中的TeamuserId
		//在修改前都要进行权限认证
		public function _updateuserinformation($userid,$information)
		{
			$this->model->Get_By_TeamuserId($userid);
			$re=$this->model->getresult();
			foreach($re as $r)
			{
				$userid=$r->userID;
			}
			
			if($this->_permissions()==2 || $this->_permissions()==1 || $_SESSION["USERID"]==$userid)
			{
				$this->model->Set_userinformation_By_TeamuserId($userid,$information);
				return true;
				}
			else
			return false;
		}
		public function _updateusertake($userid,$usertake)
		{
			if($this->_permissions()==2)
			{
			$this->model->Set_usertake_By_TeamuserId($userid,$usertake);
			return true;
			}
			else
			return false;
		}
		
		//权限管理，返回权限值
		public function _permissions()
		{
			$this->model->Get(array("usertake"),array("userID=".$_SESSION["USERID"],"offerteamID=".$_SESSION["TEAMID"]));

			$re=$this->model->getresult();
			foreach($re as $r)
			{
				$permissions=$r->usertake;
			}
			return $permissions;
		}
		
		//群员删除，删除前要进行权限控制
		public function _del($userid)
		{
			if($this->_permissions()==0)
			{
			$this->model->Del_By_TeamuserId($userid);
			return true;
			}
			else
			return false;
		}
		
		//输出群员内容
		public function _show($userid)
		{
			$this->model->Get_By_TeamuserId($userid);
			$re=$this->model->getresult();
			return $re;
		}
		
		//输出所有群员
		public function _showall( )
		{
		$User= new user();
			$this->model->Get_By_offerteamID($_SESSION["TEAMID"]);
			$re=$this->model->getresult();
			foreach($re as $r)
			{
				$UserID=$r->userID;
				echo "<a href='/information/user?id=".$UserID."'>".$User->_getusername($UserID)."</a></br>";
			}

		}
		
		public function _showoffergroup()
		{
			$this->model->Get("all",array("userID=".$_SESSION["USERID"],"usertake>-1"));
			//$this->model->Get_By_userID($_SESSION["USERID"]);
			$re=$this->model->getresult();
			return $re;			
		}
	}
?>