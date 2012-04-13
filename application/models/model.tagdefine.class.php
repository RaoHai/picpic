<?php

	require_once("model.base.class.php");
	class tagdefine_model extends ModelBase
	{
		public function  __construct($instance)
		{
			$this->IsDbObj = true;
			parent::__construct($instance);
			//echo "index->index";
		}
		
		
	}
?>
