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
  <script src="jquery-1.6.1.min.js" type="text/javascript"></script>
		</head><body>
EOD;
	}
}
class ImgView extends PublicView
{
	function ImgView(& $model)
	{
		PublicView::PublicView();
		$this->model = & $model;
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
	function RemoveImg($ImgId)
	{
		$this->model->RemoveImg($ImgId,$_SESSION["user"]);
	}
	function CheckImgGroup($id)
	{
		$this->model->FindAllGroups($id);
		$ImgGroupCount=0;
		$result="<select name='imagegroup id='imagegroup' onchange='ImgGroupChange(this.options[this.options.selectedIndex].value)'>";
		while($list=$this->model->getdata()) 
		{
			$ImgGroupCount++;
			/* TODO: ImgGroup Read&Show*/
			$result.="<option value='".$list['GroupID']."' >".$list["GroupName"]."</option>";
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