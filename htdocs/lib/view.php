﻿<?php
session_start();
class PublicView{
	var $model;
	var $output;
	function PublicView()
	{
	}
	function GetHead()
	{
			return<<<EOD
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> 
<meta property="og:site_name" content="UiClub"/>
<META HTTP-EQUIV="pragma” CONTENT="cache” />
<META HTTP-EQUIV="Cache-Control” CONTENT="public” />
<META HTTP-EQUIV="expires” CONTENT="Thu, 1 Sep 2011 20:00:00 GMT” />
	<link href="fileuploader.css" rel="stylesheet" type="text/css">	
	<link rel="stylesheet" href="style.css">
<style>
            body { padding: 20px 10px; color:#333; font: normal 12px sans-serif; }
            #devcontainer { margin: 0 auto; width: 940px; }
        </style>
  <script src="jquery-1.6.1.min.js" type="text/javascript"></script>
		</head><body>
EOD;
	}
	function LoadTemplate($TemplateName)
	{
			$fp = fopen ("template/".$TemplateName.".rhtml","r");
			$content = fread ($fp,filesize ("template/".$TemplateName.".rhtml"));
			$this->output=$content;
	}
	function GetLogin()
	{
		if($_SESSION["user"])
		{
			return <<<EOD
				您已经登陆！<a href="/logout.php">[退出]</a>
EOD;
		}
		else
		{
			return <<<EOD
				<a href="login" onclick='showWin(); return false;'>[登录]</a>
			<a href="register.html">[注册]</a>
EOD;
		}
	}
	function Instance($values)
	{
		$content=$this->output;
		  foreach ($values as $index => $value) 
		  {
			$content = str_replace ("{@".$index."}", $value,$content);
		  }
		 $this->output=$content;
	}
	function RenderTemplate()
	{
		echo $this->output;
	}
}
class ImgView extends PublicView
{
	function ImgView(& $model)
	{
		PublicView::PublicView();
		$this->model = & $model;
	}
	function GetUser($user)
	{
		$this->model->GetUser($user);		
		while($list=$this->model->getdata()) 
		{
			if($user==$list["UserName"])
				return $list;			
		}
		return false;
	}
	function GetUserID($user)
	{
		$this->model->GetUser($user);		
		while($list=$this->model->getdata()) 
		{
			if($user==$list["UserID"])
				return $list;			
		}
		return false;
	}
	function GetFriend($user)
	{
		$i=0;
		$this->model->GetFriend($user);		
		while($list=$this->model->getdata()) 
		{
			if($user==$list["UserId"])
			{
				$a[$i]=$list["OtherUserId"];
				$i++;
			}				
		}
		return $a;
	}
	function GetFriendID($user)
	{
		$i=0;
		$this->model->GetFriend($user);		
		while($list=$this->model->getdata()) 
		{
			if($user==$list["UserId"])
			{
				$a[$i]=$list["FriendId"];
				$i++;
			}				
		}
		return $a;
	}
	function getprofile($userid)
	{
		$this->model->getprofile($userid);		
		while($list=$this->model->getdata()) 
		{
			if($userid==$list["UserId"])
			return $list;			
		}
		return false;
	}
	function Registeruser($username,$password1,$email,$key)
	{
		$this->model->Registeruser($username,$password1,$email,$key);
		if(!$list=$this->model->getdata())
			return false;
		return true;
	}
	function registerprofile($usernameid)
	{
		$this->model->registerprofile($usernameid);
		if(!$list=$this->model->getdata())
			return false;
		return true;
	}
	function ShowPopImg()
	{
		echo "PopImg";
		$this->model->GetPopImg();
		while($list=$this->model->getdata())
		{
			echo "<img src='thumbnails/".$list["img_url"]."'>";
		}
	}
	function updateprofile($userid,$birthday,$sex,$blood)
	{
		$this->model->updateprofile($userid,$birthday,$sex,$blood);
		if(!$list=$this->model->getdata())
			return false;
		return true;
	}
	function addfriend($userid,$friend)
	{
		$this->model->addfriend($userid,$friend);
		if(!$list=$this->model->getdata())
			return false;
		return true;
	}
	function deletefriend($friendid)
	{
		$this->model->deletefriend($friendid);
		if(!$list=$this->model->getdata())
			return false;
		return true;
	}
	function showinformation()
	{
		echo<<<EOD
		<p><a href=# onClick="top.location.href='user.php'"/>用户</a>
		   <a href=# onClick="top.location.href='friend.php'"/>好友</a>
		   <a href=# onClick="top.location.href='other.php'"/>其他</a></p>
EOD;
	}
}


class ImgGroupView extends PublicView
{
	var $CurrentGroupId;
	function ImgGroupView(& $model)
	{
		PublicView::PublicView();
		$this->model = & $model;
	}
	function InsertNewImage($GroupId,$author,$img_url)
	{
		$this->model->InsertNewImage($GroupId,$author,$img_url);
		
	}
	
	function CheckImgGroup($id)
	{
		$this->model->FindAllGroups($id);
		$ImgGroupCount=0;
		$result=<<<EOD
		<script type='text/javascript'>
		function ImgGroupChange(val){
			if (window.XMLHttpRequest)
			  {// code for IE7+, Firefox, Chrome, Opera, Safari
			  xmlhttp=new XMLHttpRequest();
			  }
			else
			  {// code for IE6, IE5
			  xmlhttp=new ActiveXObject('Microsoft.XMLHTTP');
			  }
			
			  xmlhttp.open("GET","Variable.php?CurrentGroupId="+val,true);
				xmlhttp.send();
		}
		function UploadImgByButton(val)
		{
			alert(val);
		}
		</script>
EOD;
		$result.="<select name='imagegroup id='imagegroup' onchange='ImgGroupChange(this.options[this.options.selectedIndex].value)'>";
		$_SESSION['CurrentGroupId']=0;
		while($list=$this->model->getdata()) 
		{
			$ImgGroupCount++;
			/* TODO: ImgGroup Read&Show*/
			$result.="<option value='".$list['GroupID']."' >".$list["GroupName"]."</option>";
			$_SESSION['CurrentGroupId']=$list['GroupID'];
		}
		$result.="</select>";
		return $result;
		if($ImgGroupCount==0) return "0";
	}
	function CreateNewGroup($name,$GroupCatalog,$time,$like,$coverid)
	{
		$this->model->CreateNewGroup($name,$GroupCatalog,$time,$like,$coverid);
	}
}
?>