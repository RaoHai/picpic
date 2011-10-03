<?php
require_once('handler.php');
session_start();
$userid=$_POST['userid'];
$birthday=$_POST['birthday'];
$profile=$imgView->Getprofile($userid);
$click1=$_GET['click1'];
	echo<<<EOD
<div>
<form name="login" action="loginin.php" method="get" >
	<input type=submit name='click1' value='用户'/>  
</form>
</div>

EOD;
if($click1=='用户')
	echo<<<EOD
<div>
<form name="user" action="loginin.php" method="post">
	<span>添加图片...</span>
	<p>昵称：<input type="text" name='userid' ></p>
	<p>生日：<input type="text" name='birthday'></p>
EOD;
?>