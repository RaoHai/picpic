<?php
	require_once('handler.php');
	session_start();
	$use=$imgView->GetUser($_POST['username']);
	if(!$use)
	echo "<a href='login.html'>用户名不存在";
	else
	if($_POST['password']!=$use['password'])
		echo "<a href='login.html'>密码错误";
		else
		echo $use['UserName'].'<br>'.$use['password'];	
?>