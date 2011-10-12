<?php
	require_once('handler.php');
	session_start();
	$password=$_POST['word'];	
	$use=$imgView->GetUser($_POST['username']);
	$key=$use['salt'];
	$pattern = '1234567890abcdefghijklmnopqrstuvwxyz
                   ABCDEFGHIJKLOMNOPQRSTUVWXYZ,./&amp;l
                  t;&gt;?;#:@~[]{}-_=+)(*&amp;^%$£!';
	$word = $_POST["word"]."wibble".$key;
	$word1= $user['password']."wibble".$key;
	$hased = sha1($word);
	$hased1 = sha1($word1);
	if(!$use)
	echo "<a href='login.html'>用户名不存在";
	else
	if($hased!=$hased1)
	{
		echo "<a href='login.html'>密码错误";
	}
	else
	{
		$_SESSION["user"]=$use["UserID"];
		echo "hello";
	}
		 
?>