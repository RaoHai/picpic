<?php

	require_once("model.base.class.php");
	class user_model extends ModelBase
	{
		public function  __construct($instance)
		{
			$this->IsDbObj = true;
			//$this->DataStruct = array("UserName","NickName","email","password","salt","permission");
			parent::__construct($instance);
			//$this->has_many("image","author");
			//$this->has_many("friend","User");
		}
		
		
	}
?>