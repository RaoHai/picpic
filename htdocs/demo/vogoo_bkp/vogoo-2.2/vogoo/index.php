<?php
	include_once("vogoo.php");
	echo "hello world";
	echo $vogoo->connected;
	$vogoo->set_rating(1,1,1,1);
?>