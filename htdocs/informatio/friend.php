<?php
require_once('..\handler.php');
session_start();
$imgView->showinformation();

	$show="<form name='addfriend' action='friend.php' method='post' >
			<p><input type='text' name='friendid' />
			<input type=submit name='click2' value='确定'/>
			<input type=reset name='click1' vlaue='重置'/></p>";
	if($_POST['friendid'])
	if(!$imgView->GetUserID($_POST['friendid']))
	{
	$show=$show."不存在该用户";
	}
	else
	{
	$imgView->addfriend($_SESSION['user'],$_POST['friendid']);
	$show=$show."添加成功";
	}

	if($_GET['delete'])
	{
	$imgView->deletefriend($_GET['delete']);
	}

	$friend=$imgView->GetFriend($_SESSION['user']);
	$friendID=$imgView->GetFriendID($_SESSION['user']);
	for($i=0;$friend[$i]!=NULL;$i++)
	$user[$i]=$imgView->GetUserID($friend[$i]);
	for($i=0;$user[$i]['UserID']!=NULL;$i++)
	{
		echo $user[$i]['UserName'].'  '.$user[$i]['UserID'].' '.
		"<a href='friend.php?delete=".$friendID[$i]."'>删除</a></br>";
	}

echo $show;

	$show1="<a><form name='messagetake' action='friend.php' method='post' >
			<p>收件人：<input type='text' name='toID' /></p>
			<textarea name='message' ></textarea>
			<input type=submit name='click2' value='确定'/></p></a>";
	if($_POST['toID'])
	{
	}
echo $show1;
?>








