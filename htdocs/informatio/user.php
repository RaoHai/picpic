<?php
require_once('..\handler.php');
session_start();

$sex=$_POST['sex'];
$blood=$_POST['blood'];
$birthday=$_POST['birthyear'].'/'.$_POST['birthmonth'].'/'.$_POST['birthday'];	
$profile=$imgView->getprofile($_SESSION['user']);
$user=$imgView->GetUserID($_SESSION['user']);
$click1=$_GET['click1'];
$imgView->showinformation();
$file="upload\avatar_small\\".$_SESSION['user']."_small.jpg";

if($birthday && $sex && $blood)
$imgView->updateprofile($profile['UserId'],$birthday,$sex,$blood);	

$profile=$imgView->getprofile($_SESSION['user']);
$user=$imgView->GetUserID($_SESSION['user']);

if(file_exists($file))
	$file="upload\avatar_small\\".$_SESSION['user']."_small.jpg";
	else
	$file="upload\avatar_small\_small.jpg";
	
//定义在屏幕上显示的东西
$show1=' <input type="radio" name="sex" value="1" /> 男
					 <input type="radio" name="sex" value="2" /> 女
					 <input type="radio" name="sex" value="3" /> 无性别？';	
if($profile['sex']==1)
$show1=' <input type="radio" name="sex" value="1" checked/> 男
					 <input type="radio" name="sex" value="2" /> 女
					 <input type="radio" name="sex" value="3" /> 无性别？';
if($profile['sex']==2)
$show1=' <input type="radio" name="sex" value="1" /> 男
					 <input type="radio" name="sex" value="2" checked/> 女
					 <input type="radio" name="sex" value="3" /> 无性别？';
if($profile['sex']==3)
$show1=' <input type="radio" name="sex" value="1" /> 男
					 <input type="radio" name="sex" value="2" /> 女
					 <input type="radio" name="sex" value="3" checked/> 无性别？';

$show2='
	    <option value="">血型</option>
		<option value="1">A</option>
		<option value="2">B</option>
		<option value="3">AB</option>
		<option value="4">O</option>';
if($profile['blood']==1)	
$show2='
	    <option value="">血型</option>
		<option value="1" selected>A</option>
		<option value="2">B</option>
		<option value="3">AB</option>
		<option value="4">O</option>';
if($profile['blood']==2)	
$show2='
	    <option value="">血型</option>
		<option value="1">A</option>
		<option value="2" selected>B</option>
		<option value="3">AB</option>
		<option value="4">O</option>';
if($profile['blood']==3)	
$show2='
	    <option value="">血型</option>
		<option value="1">A</option>
		<option value="2">B</option>
		<option value="3" selected>AB</option>
		<option value="4">O</option>';
if($profile['blood']==4)	
$show2='
	    <option value="">血型</option>
		<option value="1">A</option>
		<option value="2">B</option>
		<option value="3">AB</option>
		<option value="4" selected>O</option>';
	
$show3='<option value="">年</option>';
for($i=2011;$i>=1935;$i--)
{
if($i==intval(substr($profile['Birthday'],0,(strcspn ($profile['Birthday'],"/") ) ) ) )
$show3=$show3.'<option value="'.$i.'" selected>'.$i.'</option>';
else
$show3=$show3.'<option value="'.$i.'">'.$i.'</option>';
}

$show4='<option value="">月</option>';
$a=substr($profile['Birthday'],(strcspn ($profile['Birthday'],"/") +1) ) ;
for($i=1;$i<=12;$i++)
{
if($i==intval( substr($a,0,(strcspn($a,"/")) )))
$show4=$show4.'<option value="'.$i.'" selected>'.$i.'</option>';
else
$show4=$show4.'<option value="'.$i.'">'.$i.'</option>';
}

$show5='<option value="">日</option>';
$b=substr($a,(strcspn($a,"/")+1) ) ;
for($i=1;$i<=31;$i++)
{
if($i==intval( substr($b,0,(strcspn($b,"/")) )))
$show5=$show5.'<option value="'.$i.'" selected>'.$i.'</option>';
else
$show5=$show5.'<option value="'.$i.'">'.$i.'</option>';
}
					 
if($_GET['update']==1)
	$show='
	<script language="javascript" type="text/javascript">
	function showbirthday()
	{
		var number=parseInt(document.forms["user"].elements["birthyear"].value);
		var dayoption1=new Option("29","29");
		var dayoption2=new Option("30","30");
		var dayoption2=new Option("31","31");
		if(document.forms["user"].elements["birthmonth"].value=="2")
		{
		document.getElementById("birthday").remove(31);
		document.getElementById("birthday").remove(30);
		document.getElementById("birthday").remove(29);
		if(number%4==0)
		{
		document.getElementById("birthday").add(dayoption1,29);
		}
		}
		else
		{
	
			if(document.getElementById("birthday").length==29)
			document.getElementById("birthday").add(dayoption1,29);
			if(document.getElementById("birthday").length==30)
			document.getElementById("birthday").add(dayoption2,30);
			if(document.getElementById("birthday").length==31)
			document.getElementById("birthday").add(dayoption3,31);
			if(document.forms["user"].elements["birthmonth"].value=="4" || document.forms["user"].elements["birthmonth"].value=="6" || document.forms["user"].elements["birthmonth"].value=="9" || document.forms["user"].elements["birthmonth"].value=="11" )
			document.getElementById("birthday").remove(31);
		}
	}
	</script>
	<div>
	<img src="'.$file.'" />
	<p><a  href="../information/upload/index.php"  onclick= "" >照片</a></p>
	<form name="user" action="user.php" method="post" >
		<p>性别：	'.$show1.'</p>
	<p><select name="blood" id="blood" >'.$show2.'
		</select></p>
	<select name="birthyear" id="birthyear" tabindex="1" onchange="showbirthday();">
		'.$show3.'
		</select>
		<select name="birthmonth" id="birthmonth" onchange="showbirthday();" tabindex="1">
		'.$show4.'
		</select>
		<select name="birthday" id="birthday"  tabindex="1">
		'.$show5.'
		</select>
		<span id="password"></span> 		
	<p><input type=submit name="click2" value="确定"/>
	<input type=reset name="click1" vlaue="重置"/></p>
	</form>';
else
{
	$showsex='';
	if($profile['sex']==1)
	$showsex='男';
	if($profile['sex']==2)
	$showsex='女';
	if($profile['sex']==3)
	$showsex='无性别？';
	$showblood='';
	if($profile['blood']==1)
	$showblood='A';
	if($profile['blood']==2)
	$showblood='B';
	if($profile['blood']==3)
	$showblood='AB';
	if($profile['blood']==4)
	$showblood='O';
	$show='	
	<img src="'.$file.'" />
	<p>用户名：  '.$user['UserName'].'</p>
	<a  href="user.php?update=1"  onclick= "" >编辑资料</a>
	<p>性别：	 '.$showsex.'</p>
	<p>血型：	 '.$showblood.'</p>
	<p>邮箱：    '.$user['email'].'</p>
	<p>生日：    '.$profile['Birthday'].'</p>
	';
}
	
echo $show;
?>