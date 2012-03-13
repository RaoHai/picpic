<?php

	require_once("model.base.class.php");
	class imagegroup_model extends ModelBase
	{
		public function  __construct($instance)
		{
			$this->IsDbObj = true;
			//$this->DataStruct = array("GroupName","Description","GroupCatalog","author","updates","likes","coverid");
			$this->verify = "author";
			
			parent::__construct($instance);
		}
		
		
	}
?>