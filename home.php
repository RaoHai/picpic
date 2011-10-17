<?php
	/* home.php */
	/* user home page view and user control;*/
	require_once('handler.php');
	session_start();
	$fp = fopen ("load/index.html","r");
	$content = fread ($fp,filesize ("load/index.html"));
	$group= $imgGroupView->CheckImgGroup($_SESSION["user"]);
	$values=array(
		"title"=>"AcgPic",
		"user"=>$imgView->GetLogin(),
		"dialog"=>$content,
		"imggroup"=>$group,
	);
	$imgView->LoadTemplate("home");
	$imgView->Instance($values);
	$imgView->RenderTemplate();
?>