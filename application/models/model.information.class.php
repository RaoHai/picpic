<?php

	require_once("model.base.class.php");
	class information_model extends ModelBase
	{
		public function  __construct($instance)
		{
			$this->IsDbObj = false;
			parent::__construct($instance);
			//echo "index->index";
		}
		
		
	}
?>