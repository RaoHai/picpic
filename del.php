<?php
	include_once('index.php');
	session_start();
	
	$ImgId= $_GET['n'];
	$imgGroupView->RemoveImg($ImgId);
	$fp = fopen('log.txt', 'a');
	fwrite($fp, $ImgId);
	fclose($fp);
?>