<?php
	/*Upload.php*/
	require_once('index.php');
	session_start();
	if($_GET["action"]=='new' && $_POST['name']!="")
	{
		$GroupName=$_POST['name'];
		$time = date("Y-m-d H:i:s");
		$imgGroupView->CreateNewGroup($GroupName,1,$time,0,0);
	}
	else
	{
		$result='document.write("';
		$result.= $imgGroupView->CheckImgGroup('2').'");';
		echo $result;
	}
?>
