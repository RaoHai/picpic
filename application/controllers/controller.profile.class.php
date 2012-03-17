<?php

	require_once("controller.base.class.php");
	class profile extends ControllerBase
	{
		public function  __construct()
		{
			parent::__construct();
		}
		
		public function _updatesex($Sex)
		{
			$this->model->Set_Sex_By_UserId($_SESSION["USERID"],$Sex);
		}
		public function _updateblood($Blood)
		{
			$Profile->model->Set_Blood_By_UserId($_SESSION["USERID"],$Blood);
		}
		public function _updatebirthday($Birthday,$Birthmonth,$Birthyear)
		{
			$birthday=$Birthyear.'/'.$Birthmonth.'/'.$Birthday;
			$Profile->model->Set_Birthday_By_UserId($_SESSION["USERID"],$birthday);
		}
		public function _getprofile()
		{
			$this->model->Get_By_UserId($_SESSION["USERID"]);
			$re1=$this->model->getresult();
			$profile=array();
			foreach($re1 as $r1)
			{
				$profile['birthday']=$r1->Birthday;
				$profile['sex']=$r1->Sex;
				$profile['blood']=$r1->Blood;
			}
			return $profile;
		}
				
	}	
?>
