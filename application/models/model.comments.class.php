<?php

	require_once("model.base.class.php");
	class comments_model extends ModelBase
	{
		public function  __construct($instance)
		{
			$this->IsDbObj = true;
			//$this->DataStruct = array("UserId","ImgId","SharedId","ImgGroupId","CommentText","QuoteID","ReplyID","Time");
			parent::__construct($instance);
			$this->has_one("UserId","user","UserId");//����1���������������2�����ӱ���������3��������
			//echo "index->index";
		}
		
		
	}
?>