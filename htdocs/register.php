<?php
	require_once('handler.php');
	session_start();
	$username=$_GET['username'];
	$password=$_GET["word"];
	$password1=$_GET["word1"];
	$email=$_GET["mail"];
	$validate=$_GET["validate"];
	
	$pattern = '1234567890abcdefghijklmnopqrstuvwxyz
                   ABCDEFGHIJKLOMNOPQRSTUVWXYZ,./&amp;l
                  t;&gt;?;#:@~[]{}-_=+)(*&amp;^%$£!';    //字符池
		  for($i=0; $i<32; $i++)
		   {
			   $key .= $pattern{mt_rand(0,35)};    //生成php随机数
		   }
	$word = $_POST["word"]."wibble".$key;
	$hased = sha1($word);
	
	if($username!=NULL)
	if($imgView->GetUser($username))
	$response="0";
	else
	$response="1";
	
	if($password!=NULL )
	if(strlen($password)<6 || strlen($password)>20)
	$response="2";
	else
	$response="3";
	
	if($password1!=NULL)
	if($password1!=$password)
	$response="4";
	else
	$response="5";
	
	if($email!=NULL)
	if(strstr($email,"@"))
		if(strstr(strrchr($email,"@"),"."))
		$response="6";
		else
		$response="7";
	else
	$response="7";
	
	if($validate!=NULL)
	if($validate!=$_SESSION['code'])
	$response="8";
	else
	$response="9";
	
	if($_POST['username']!=NULL || $_POST['word']!=NULL || $_POST['word1']!=NULL || $_POST['mail']!=NULL ||$_POST['validate']!=NULL )
	{
//		echo $_POST['word'].$_POST['word1'];
		if($imgView->GetUser($_POST['username']))
		echo   "<a href='register.html'>用户名存在</a>";
			else
			{
			if($_POST['word']==$_POST['word1'] )
			{	
			$imgView->Registeruser($_POST['username'],$hased,$_POST['mail'],$key);
			$use=$imgView->GetUser($_POST['username']);
			$imgView->registerprofile($use['UserID']);
			echo "<a href='login.php'>注册成功</a>";		
			}
				else
				{
				echo  "<a href='register.html'>密码不相同</a>"; 
				}
			}
	}
	else
	echo $response;
?>
