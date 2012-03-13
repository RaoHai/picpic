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
	}
?>