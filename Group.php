<?php
	/* Group.php */
	/* ImgGroup Show and Setting;*/
	require_once('handler.php');
	session_start();
	$imgShow=$imgGroupView->GetImgGroupById($_GET["id"]);
	if($imgGroupView->CheckPermissionForGroup($_SESSION["user"],$_GET["id"]))
	{
		$_SESSION['CurrentGroupId']=$_GET["id"];
	}
	$values=array(
		"title"=>"AcgPic",
		"user"=>$imgView->GetLogin(),
		"userinfo"=>"userinfohere",
		"uploadphoto"=>"photoloadhere",
		"photocatalog"=>$imgShow,
		"imggroup"=>"",
	);
	$imgView->LoadTemplate("home");
	$imgView->Instance($values);
	$imgView->RenderTemplate();
?>