<?php
	/* home.php */
	/* user home page view and user control;*/
	require_once('handler.php');
	session_start();
	$group= $imgGroupView->CheckImgGroup($_SESSION["user"]);
	$imgCatalog=$imgGroupView->GetImgGroupByUser($_SESSION["user"]);
	$values=array(
		"title"=>"AcgPic",
		"user"=>$imgView->GetLogin(),
		"userinfo"=>"userinfohere",
		"uploadphoto"=>"photoloadhere",
		"photocatalog"=>$imgCatalog,
		"imggroup"=>$group,
	);
	$imgView->LoadTemplate("home");
	$imgView->Instance($values);
	$imgView->RenderTemplate();
?>