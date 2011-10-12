<?php
	/* index.php */
	/* index page view and user control;*/
	require_once('handler.php');
	session_start();
	echo $imgView->GetHead();
	if($_SESSION["user"])	echo "您已经登录";
	else echo"您尚未登录，<a href='login.html'>登录</a>";
	$imgView->ShowPopImg();
	
?>