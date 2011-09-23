<?php
class modelbase
{
	var $dao;
	function modelbase(& $dao)
	{
		$this->dao = & $dao;
	}
	function getdata()
	{
	if ( $data=$this->dao->getRow() )
            return $data;
        else
            return false;
	}
	function InsertNewImage($GroupId,$author,$img_url)
	{
		$time = date("Y-m-d H:i:s");
		//$this->dao->fetch("INSERT INTO image(GroupID,img_url,author,Date) VALUES('".$GroupId."','".$img_url."','".$author."','".$time."') ");
		$log= "INSERT INTO image(GroupID,img_url,author,Date) VALUES('".$GroupId."','".$img_url."','".$author."','".$time."') ";
		$fp = fopen('log.txt', 'a');
		fwrite($fp, $log);
		fclose($fp);
	}
	function RemoveImg($Img,$author)
	{
		//$this->dao->fetch("DELETE  FROM image where img_url='".$Img."' and  author='".$author."'");
		$log= "DELETE  FROM image where img_url='".$Img."' and  author='".$author."'";
		$fp = fopen('log.txt', 'a');
		fwrite($fp, $log);
		fclose($fp);
	}
}
class Imgs extends modelbase{
	function Imgs(& $dao)
	{
		modelbase::modelbase(& $dao);
	}
}
class ImgGroup extends modelbase{
	function ImgGroup(& $dao)
	{
		modelbase::modelbase(& $dao);
	}
	function FindAllGroups($id)
	{
		$this->dao->fetch("SELECT * FROM imagegroup where author='".$id."'");
	}
	function CreateNewGroup($name,$GroupCatalog,$time,$like,$coverid)
	{
		$this->dao->fetch("INSERT INTO imagegroup(GroupName,GroupCatalog,author,updates,likes,coverid) VALUES('".$name."','".$GroupCatalog."','".$_SESSION[user]."','".$time."','".$like."','".$coverid."' )");
		//echo "INSERT INTO imagegroup(GroupName,GroupCatalog,author,updates,likes,coverid) VALUES('".$name."','".$GroupCatalog."','".$_SESSION[user]."','".$time."','".$like."','".$coverid."' )";
	}

}
?>
