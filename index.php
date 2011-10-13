<?php
	/* index.php */
	/* index page view and user control;*/
	require_once('handler.php');
	session_start();
		
	$values=array(
		"title"=>"AcgPic",
		"welcome"=>"欢迎光临",
		"user"=>$imgView->GetLogin(),
	);
	$imgView->LoadTemplate("index");
	$imgView->Instance($values);
	$imgView->RenderTemplate();
	echo $_GET["id"];
	
	
?>