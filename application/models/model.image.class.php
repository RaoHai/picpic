<?php

	require_once("model.base.class.php");
	class image_model extends ModelBase
	{
        public $verify;
		public function  __construct($instance)
		{
			$this->IsDbObj = true;
			//$this->DataStruct = array("ImageName","Description","author","Date","imgurl","GroupID");
			$this->verify = "author";
			parent::__construct($instance);
            $this->has_one("author","user","UserId");//参数1，本表外键；参数2，连接表名；参数3，外表外键

		}
		public function show()
		{
			echo "yes";
		}
		
		
	}
?>
