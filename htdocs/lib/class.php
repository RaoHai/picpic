<?php
	require_once('view.php');
	require_once('database.php');
	require_once('controller.php');
	require_once('model.php');
	session_start();
	$dao=& new database();
	$ImgCtrl=& new ImgController($dao);
	$imgView=$ImgCtrl->getview();
	$ImgGroupCtrl= & new ImgGroupCtrl($dao);
	$imgGroupView=$ImgGroupCtrl->getview();
	
	
?>