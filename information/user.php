<?php
require_once('..\handler.php');
session_start();
$_SESSION=$_POST['username'];
$birthday=$_POST['birthday'];
$user=$imgView->GetUser($_SESSION['user']);
$profile=$imgView->getprofile($user['UserID']);
$click1=$_GET['click1'];
$imgView->showinformation();
	$show="
	<div>
	<form name='user' action='loginin.php' method='post'>
	<p>生日：<input type='text' name='birthday'/></p>
	<p><input type=submit name='click2' value='确定'/></p>
	</form>
	</div>";
if($birthday!=NULL)
	$imgView->updateprofile($profile['UserId'],$birthday);
echo $show;
?>