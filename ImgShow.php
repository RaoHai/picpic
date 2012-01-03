<?php
	/* Group.php */
	/* Display one image;*/
	require_once('handler.php');
	session_start();
	$img=$imgGroupView->GetImgByID($_GET["id"]);
	$values=array(
		"title"=>"AcgPic",
		"user"=>$imgView->GetLogin(),
		"showimg"=>$img,
	);
	$imgView->LoadTemplate("show");
	$imgView->Instance($values);
	$imgView->RenderTemplate();
?>