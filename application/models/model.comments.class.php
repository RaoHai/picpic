<?php

	require_once("model.base.class.php");
	class comments_model extends ModelBase
	{
		public function  __construct($instance)
		{
			$this->IsDbObj = true;
			//$this->DataStruct = array("UserId","ImgId","SharedId","ImgGroupId","CommentText","QuoteID","ReplyID","Time");
			parent::__construct($instance);
			$this->has_one("UserId","user","UserId");//参数1，本表外键；参数2，连接表名；参数3，外表外键
			//echo "index->index";
		}
		
		
	}
?>