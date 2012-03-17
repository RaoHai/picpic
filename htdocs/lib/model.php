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
			$this->dao->fetch("INSERT INTO image(GroupID,img_url,author,Date) VALUES('".$GroupId."','".$img_url."','".$author."','".$time."') ");
			$log= "INSERT INTO image(GroupID,img_url,author,Date) VALUES('".$GroupId."','".$img_url."','".$author."','".$time."') ";
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
	function GetUser($user)
	{
		$this->dao->fetch("SELECT * FROM user");
	}
	function GetFriend($user)
	{
		$this->dao->fetch("SELECT * FROM friend");
	}
	function GetPopImg()
	{
		$this->dao->fetch("SELECT * FROM image limit 0,10");
	}
	function Registeruser($username,$password1,$email,$key)
	{
		$sql="INSERT INTO user (UserName, password,email,salt) VALUES ('".$username."', '".$password1."','".$email."','".$key."')";
		$this->dao->fetch($sql);
	}
	function registerprofile($usernameid)
	{
		$sql="INSERT INTO profile (UserId) VALUES ('".$usernameid."')";
		$this->dao->fetch($sql);
	}
	function getprofile($userid)
	{
		$this->dao->fetch("SELECT * FROM profile");
	}
	function updateprofile($userid,$birthday,$sex,$blood)
	{
		$sql="UPDATE profile SET Birthday = '".$birthday."', sex='".$sex."' , blood='".$blood."' WHERE UserId = '".$userid."' ";
		$this->dao->fetch($sql);
	}
	function addfriend($userid,$friend)
	{
		$sql="INSERT INTO friend (UserId,OtherUserId) VALUES ('".$userid."','".$friend."')";
		$this->dao->fetch($sql);
	}
	function deletefriend($friendid)
	{
		$sql="DELETE FROM friend WHERE FriendId='".$friendid."'";
		$this->dao->fetch($sql);
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
		echo "INSERT INTO imagegroup(GroupName,GroupCatalog,author,updates,likes,coverid) VALUES('".$name."','".$GroupCatalog."','".$_SESSION[user]."','".$time."','".$like."','".$coverid."' )";
	}

}
?>
