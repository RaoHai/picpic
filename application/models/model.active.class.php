<?php

	require_once("model.base.class.php");
	class active_model extends ModelBase
	{
		public function  __construct($instance)
		{
			$this->IsDbObj = true;
			parent::__construct($instance);
			//echo "index->index";
			//Active 的content存储完整的JSON格式
		}
		
		
	}
?>