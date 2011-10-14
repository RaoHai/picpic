<?php
	/* home.php */
	/* user home page view and user control;*/
	require_once('handler.php');
	session_start();
	$fp = fopen ("index.html","r");
	$content = fread ($fp,filesize ("index.html"));
	$values=array(
		"title"=>"AcgPic",
		"user"=>$imgView->GetLogin(),
		"dialog"=>$content,
	);
	$imgView->LoadTemplate("home");
	$imgView->Instance($values);
	$imgView->RenderTemplate();
?>