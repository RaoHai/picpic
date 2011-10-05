<?php
require_once('handler.php');
session_start();
$username=$_GET['username'];
$birthday=$_POST['birthday'];
$user=$imgView->GetUser($username);
$profile=$imgView->getprofile($user[UserID]);
$click1=$_GET['click1'];	
	echo<<<EOD
<div>
<form name="login" action="loginin.php" method="get" >
	<input type=submit name='click1' value='用户'/>  
</form>
</div>
EOD;
if($click1=='用户' || $_POST['click2']=='确定')
	$show="
	<div>
	<form name='user' action='loginin.php?user=user1' method='post'>
	<p>生日：<input type='text' name='birthday'/></p>
	<p><input type=submit name='click2' value='确定'/></p>
	</form>
	</div>";
//if($birthday!=NULL)
	$imgView->updateprofile($profile['UserId'],$birthday);
echo $show.$profile['UserId'].$birthday;
?>