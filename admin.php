<?php
	/*Upload.php*/
	require_once('index.php');
	session_start();
	if($_GET["action"]=='new' && $_POST['name']!="")
	{
		$GroupName=$_POST['name'];
		$time = date("Y-m-d-H:i:s");
		$imgGroupView->CreateNewGroup($GroupName,1,$time,0,0);
		$encoded_filename = urlencode($GroupName);
		$encoded_filename = str_replace("+", "%20", $encoded_filename);
		$str=mkdir(dirname(__FILE__).'/files/'.$encoded_filename);
	}
	else
	{
		$result='document.write("';
		$result.= $imgGroupView->CheckImgGroup('2').'");';
		echo $result;
	}
?>
