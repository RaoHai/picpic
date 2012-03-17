<?php

	require_once("controller.base.class.php");
	class comments extends ControllerBase
	{
		public function  __construct()
		{
			parent::__construct();
		}
		
		public function _index()//自定义你的action方法
		{
				$this->model->Get_CommentText_By_ImgGroupId(11);
				$comments =$this->model->getresult();//取得评论集
				foreach($comments as $comment)//分发到每一个评论
				{
					echo $comment->user->NickName;//获取评论的用户的昵称
					echo $comment->CommentText;//获取评论内容
					echo "</br>";
				}			
		}
		
		public function _add($commenttext,$activityID)
		{
			$this->model->New(array($_SESSION["USERID"],0,0,0,$commenttext,0,0,0,$activityID));
		}
		
		public function _recive($commenttext,$activityID,$replyid)
		{
			$this->model->New(array($_SESSION["USERID"],0,0,0,$commenttext,0,$replyid,0,$activityID));
		}
        public function presave()
        {
            $mem = new Memcache;
            $mem->connect("127.0.0.1",11211);
            $this->save();
            $commentid=mysql_insert_id();
            $saveToMemcache = new stdClass();
            $saveToMemcache->id = $commentid;
            $saveToMemcache->userid = $this->UserId;
            $saveToMemcache->text = $this->CommentText;
            $saveToMemcache->time = $this->Time;
            $saveToMemcache->username = $_SESSION['NICK'];
            $mem->set("_C".$commentid,$saveToMemcache,0,0);
        }
       public function savetoReply()
        {
            $mem = new Memcache;
            $mem->connect("127.0.0.1",11211);
            $this->save();
            $commentid = mysql_insert_id();
            $saveToMemcache = new stdClass();
            $saveToMemcache->id = $commentid;
            $saveToMemcache->userid = $this->UserId;
            $saveToMemcache->text = $this->CommentText;
            $saveToMemcache->time = $this->Time;
            $saveToMemcache->username = $_SESSION['NICK'];
            $saveToMemcache->replyid = $this->ReplyID;
            $parentComment = $mem->get("_C".$saveToMemcache->replyid);
            if(!isset($parentComment->replys)) $parentComment->replys=array();
            $parentComment->replys[] = $saveToMemcache;
            $mem->set('_C'.$commentid,$saveToMemcache,0,0);
            $mem->set('_C'.$saveToMemcache->replyid,$parentComment,0,0);
        }
	}
?>
