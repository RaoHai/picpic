<?php

	require_once("model.base.class.php");
	class favourite_model extends ModelBase
	{
		public function  __construct($instance)
		{
			$this->IsDbObj = true;
			parent::__construct($instance);
			//echo "index->index";
            $this->has_one("UserId","user","UserId");//参数1，本表外键；参数2，连接表名；参数3，外表外键

		}
		
		
	}
?>
