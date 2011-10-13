<?php
	require_once('handler.php');
	session_start();
	$username=$_GET['username'];
	$password=$_GET['password'];	
	$use=$imgView->GetUser($username);
	$key=$use['salt'];
	$pattern = '1234567890abcdefghijklmnopqrstuvwxyz
                   ABCDEFGHIJKLOMNOPQRSTUVWXYZ,./&amp;l
                  t;&gt;?;#:@~[]{}-_=+)(*&amp;^%$£!';
	$word = $password."wibble".$key;
	$word1= $use['password']."wibble".$key;
	$hased = sha1($word);
	$hased1 = sha1($word1);
	if(!$use)
	{
		echo "0";
	}
	else
	{
		if($hased!=$use['password'])
			echo "1";
		else
		{
			echo "2";
			$_SESSION['user']=$_GET['username'];
		}
	}
?>