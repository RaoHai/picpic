<?php
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
	function updateprofile($userid,$birthday)
	{
		$this->model->updateprofile($userid,$birthday);
		if(!$list=$this->model->getdata())
			return false;
		return true;
	}
	
	function showinformation()
	{
		echo<<<EOD
		<p><a href=# onClick="top.location.href='user.php'"/>用户</a>
		   <a href=# onClick="top.location.href='other.php'"/>其他</a></p>
EOD;
	}
	/*------------------------------------------
			img data read handler
	--------------------------------------------*/
	
}


class ImgGroupView extends PublicView
{
	var $CurrentGroupId;
	function ImgGroupView(& $model)
	{
		PublicView::PublicView();
		$this->model = & $model;
	}
	/*--------------------------------------
		ImgGroup控制函数
	-----------------------------------------*/
	function InsertNewImage($GroupId,$author,$img_url)
	{
		$this->model->InsertNewImage($GroupId,$author,$img_url);
		
	}
	function RemoveImg($img_url)
	{
		$this->model->RemoveImg($img_url);
	}
	function CheckImgGroup($id)
	{
		$this->model->FindAllGroups($id);
		$ImgGroupCount=0;
		
		$result="<div id='imggroupselect' style='float:left'>";
		
		$result.="<select name='imagegroup id='imagegroup' onchange='ImgGroupChange(this.options[this.options.selectedIndex].value)'>";
		$_SESSION['CurrentGroupId']=0;
		while($list=$this->model->getdata()) 
		{
			$ImgGroupCount++;
			/* TODO: ImgGroup Read&Show*/
			$result.="<option value='".$list['GroupID']."' >".$list["GroupName"]."</option>";
			$_SESSION['CurrentGroupId']=$list['GroupID'];
		}
		$result.="</select>	</div>
			<div >
				<input type='text' name='name' id='GroupName' />
				 <button type='create' class='start' onclick='CreateNewImgGroup();'>新建</button>
				 </div>";
		return $result;
		if($ImgGroupCount==0) return "0";
	}
	function FreshGroup($id)
	{
			$this->model->FindAllGroups($id);
			$result.="<select name='imagegroup id='imagegroup' onchange='ImgGroupChange(this.options[this.options.selectedIndex].value)'>";
			while($list=$this->model->getdata()) 
			{
				$result.="<option value='".$list['GroupID']."' >".$list["GroupName"]."</option>";
			}
			$result.="</select>";
			return $result;
	}
	function CreateNewGroup($name,$GroupCatalog,$time,$like,$coverid)
	{
		$this->model->CreateNewGroup($name,$GroupCatalog,$time,$like,$coverid);
	}
	/*-----------------------------------------------------
		imggroup 读取函数
	-----------------------------------------------------*/
	function GetImgGroupByUser($user_id)
	{
		$result="<div><p>我的专辑</p>";
		$arr=array();
		$this->model->ReadImgByUser($user_id);
		while($list=$this->model->getdata()) 
		{
				$result.="<div style='float:left;width:300px'>";
				$result.="<div>".$list["GroupName"]."|".$list["likes"]."喜欢</div>";
				if($list["img_url"])
					$result.="<div><a href='Group?id=".$list["GroupID"]."'><img src='load/thumbnails/".$list["img_url"]."'></a></div>";
				else
					$result.="<div><img src='logo.png'></div>";
				$result.="</div>";
		}
		
		$result.="</div>";
		return $result;
	}
	function GetImgGroupById($user_id)
	{
		$this->model->ReadImgByImgGroup($user_id);
		while($list=$this->model->getdata()) 
		{
			$result.="<div style='float:left;width:300px'>";
			$result.="<div>".$list["ImageName"]."|".$list["Date"]."</div>";
			$result.="<div><a href='ImgShow?id=".$list["ImageId"]."'><img src='load/thumbnails/".$list["img_url"]."'></a></div>";
			$result.="</div>";
		}
		return $result;
	}
	function CheckPermissionForGroup($user_id,$ImgGroupId)
	{
		$this->model->CheckPermissionForGroup($user_id,$ImgGroupId);
		if($list=$this->model->getdata()) return true;
		else return false;
	}
	function GetLoadCtrl()
	{
		return<<<EOD
		<div id="signin_upload">
	<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/themes/base/jquery-ui.css" id="theme">
	<link rel="stylesheet" href="../script/jquery.fileupload-ui.css">
	<div id="fileupload">
    <form action="load/upload.php" method="POST" enctype="multipart/form-data">
        <div class="fileupload-buttonbar">
            <label class="fileinput-button">
                <span>添加图片...</span>
                <input type="file" name="files[]" multiple>
            </label>
            <button type="submit" class="start">开始上传</button>
            <button type="reset" class="cancel">取消上传</button>
            <button type="button" class="delete">删除文件</button>
			<div class="fileupload-group" >
			<div id="imggroupselect" style="float:left">
				{@imggroup}
			</div>
			<div style="float:right">
				<input type='text' name='name' id='GroupName' />
				 <button type="create" class="start" onclick='CreateNewImgGroup();'>新建</button>
				 </div>
			 </div>
        </div>
	
    </form>

    <div class="fileupload-content" id="fileuploadmain">
        <table class="files"></table>
        <div class="fileupload-progressbar"></div>
    </div>
</div>
<script id="template-upload" type="text/x-jquery-tmpl">
    <tr class="template-upload{{if error}} ui-state-error{{/if}}">
        <td class="preview"></td>
        <td class="name">${name}</td>
        <td class="size">${sizef}</td>
        {{if error}}
            <td class="error" colspan="2">错误:
                {{if error === 'maxFileSize'}}文件过大
                {{else error === 'minFileSize'}}文件过小
                {{else error === 'acceptFileTypes'}}文件类型错误
                {{else error === 'maxNumberOfFiles'}}文件数量过多
                {{else}}${error}
                {{/if}}
            </td>
        {{else}}
            <td class="progress"><div></div></td>
            <td class="start"><button>Start</button></td>
        {{/if}}
        <td class="cancel"><button>Cancel</button></td>
    </tr>
</script>
<script id="template-download" type="text/x-jquery-tmpl">
    <tr class="template-download{{if error}} ui-state-error{{/if}}">
        {{if error}}
            <td></td>
            <td class="name">${name}</td>
            <td class="size">${sizef}</td>
            <td class="error" colspan="2">错误:
                {{if error === 1}}文件太大（error code=1）
                {{else error === 2}}文件太大（error code =2）
                {{else error === 3}}文件只有部分被上传
                {{else error === 4}}没有文件被上传
                {{else error === 5}}找不到临时文件夹
                {{else error === 6}}写入文件失败
                {{else error === 7}}文件上传异常停止
                {{else error === 'maxFileSize'}}文件太大
                {{else error === 'minFileSize'}}文件太小
                {{else error === 'acceptFileTypes'}}文件类型错误
                {{else error === 'maxNumberOfFiles'}}文件数量过多
                {{else error === 'uploadedBytes'}}上传的字节超过文件大小
                {{else error === 'emptyResult'}}空文件
                {{else}}${error}
                {{/if}}
            </td>
        {{else}}
            <td class="preview">
                {{if thumbnail_url}}
                    <a href="${url}" target="_blank"><img src="${thumbnail_url}"></a>
                {{/if}}
            </td>
            <td class="name">
                <a href="${url}"{{if thumbnail_url}} target="_blank"{{/if}}>${name}</a>
            </td>
            <td class="size">${sizef}</td>
            <td colspan="2"></td>
        {{/if}}
        <td class="delete">
            <button data-type="${delete_type}" data-url="${delete_url}">Delete</button>
        </td>
    </tr>
</script>
<script src="../jquery-1.6.1.min.js"></script>
<script src="../jquery-ui.min.js"></script>
<script src="../jquery.tmpl.min.js"></script>
<script src="../script/jquery.iframe-transport.js"></script>
<script src="../script/jquery.fileupload.js"></script>
<script src="../script/jquery.fileupload-ui.js"></script>
<script src="application.js"></script>
</div>
		
EOD;
	}
	function GetImgByID($id)
	{
		$this->model->GetImgById($id);
		while($list=$this->model->getdata())
		{
				return "<img src='load/files/".$list["img_url"]."'>";
		}
	}
}
?>