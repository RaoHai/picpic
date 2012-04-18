<?php

	require_once("controller.base.class.php");
	class friend extends ControllerBase
	{
		public function  __construct()
		{
			parent::__construct();
		}
		public function _getfriend($id)
		{
			$this->model->Get("all",array("User={$id}"),array(0,10));
			$re=$this->model->getresult();
			$count;
			$out="<b style='color:skyblue;font-size:16px;'>好友:</b></br>";
			foreach($re as $r)
			{	
				$count++;
				$friendID=$r->OtherUserId;	
				$name = $r->user->NickName;
				$out.=  "<a href='/user/{$friendID}' title='{$name}'><img style='margin:2px;width:30px;height:30px;' src='/upload/avatar_small/{$friendID}_small.jpg' /></a>";
				if($count==5) $out.= "</br>";
			}
		
			return $out;
		
		}
        public function _getfriendjson()
        {
            $this->model->Get("all",array("User={$_SESSION['USERID']}"));
            $friends = $this->model->getresult();
            foreach($friends as $friend)
            {
                $arr[]=$friend->user->NickName;
            }
            echo (json_encode($arr));
        }
        public function IsFriends($FriendID)
        {
            $this->model->Get("all",array("User={$_SESSION['USERID']}","OtherUserId={$FriendID}"));
            $focused = $this->model->getresult();
            $this->model->Get("all",array("User={$FriendID}","OtherUserId={$_SESSION['USERID']}"));
            $beingfocused = $this->model->getresult();
            $atob = 0;
            $btoa = 0;
            if(!empty($focused)) $atob=1;
            if(!empty($beingfocused)) $btoa=1;
            return $atob.$btoa;
                
        }
		public function _Addfriend($FriendID)
		{
			$this->model->New(array($_SESSION["USERID"],$FriendID));
            echo json_encode($this->IsFriends($FriendID));
			//$this->model->New(array($FriendID,$_SESSION["USERID"]));
		}
		public function _Del($FriendID)
		{
			$this->model->Del(array("User={$_SESSION['USERID']}","OtherUserId={$FriendID}"));
             echo json_encode($this->IsFriends($FriendID));

		}
				
	}
?>
