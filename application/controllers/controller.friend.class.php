<?php

	require_once("controller.base.class.php");
	class friend extends ControllerBase
	{
		public function  __construct()
		{
			parent::__construct();
		}
		public function _getfriend()
		{
			$this->model->Get_By_User($_SESSION["USERID"]);
			$re=$this->model->getresult();
			foreach($re as $r)
			{
				$friendID=$r->OtherUserId;				
				echo $friendID."<a href='friend?delete=".$friendID."'>ɾ��</a></br>";
			}
			
		}
		public function _Addfriend($FriendID)
		{
			$User = new user();
			$Profile = new profile();
				$User->model->Get_By_UserId($FriendID);
				$A=1;
				$this->model->Get_By_User($_SESSION["USERID"]);
				$re=$this->model->getresult();
				
				foreach($re as $r)
				{
					$friendID=$r->OtherUserId;	
					if($friendID==$FriendID)
					{
					$A=0;
					break;
					}
					
				}
			
				if(!$User->model->getresult())
					{
					$show="�����ڸ��û�";
					}
				else
					if($A==1)
					{
						$this->model->New(array($_SESSION["USERID"],$FriendID));
						$this->model->New(array($FriendID,$_SESSION["USERID"]));
						$show="��ӳɹ�";
					}
					else
					if($A==0)
					{
					$show="�����Ѵ���";
					}
			return $show;
			echo "123";
		}
				
	}
?>
