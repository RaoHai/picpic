<?php
		session_start();
		if($_GET['CurrentGroupId'])
		{
			$_SESSION['CurrentGroupId']=$_GET['CurrentGroupId'];
				echo "alert(".$_GET['CurrentGroupId'].")";
		}
			
?>