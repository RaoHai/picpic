<?php
	require_once('handler.php');
	session_start();
	if($_SESSION["user"] && $_GET["new"])
	{
		
		$time = date("Y-m-d-H-i-s");
		$imgGroupView->CreateNewGroup($_GET["new"],0,$time,0,0);
		echo $imgGroupView->FreshGroup($_SESSION["user"]);
	}

?>