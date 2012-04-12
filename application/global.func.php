<?php
	function getmicrotime(){ 
		list($usec, $sec) = explode(" ",microtime()); 
		return ((float)$usec + (float)$sec); 
    } 
	function loadser()
	{
			$fp = fopen (APPLICATION_PATH."/lib/aclserialize.ser","r");
			$content = fread ($fp,filesize (APPLICATION_PATH."/lib/aclserialize.ser"));
			fclose($fp);
			$obj = unserialize($content);
			return $obj;
	}
	function __autoload($classname)
	{
			require_once(APPLICATION_PATH."/controllers/controller.{$classname}.class.php");
	}
	static $_Struct=array("user" => array("UserName","NickName","email","password","salt","permission"),
							"imagegroup"=>array("GroupName","Description","GroupCatalog","author","updates","likes","coverid"),
							"image"=>array("ImageName","Description","author","Date","imgurl","GroupID"),
							"comments"=>array("UserId","ImgId","SharedId","ImgGroupId","CommentText","QuoteID","ReplyID","Time","activityID"),
							"profile"=>array("UserId","avatar","Birthday","FavoriteHash","FriendId","Shared","Blood","Sex","Desc"),
							"friend"=>array("User","OtherUserId"),
							"active"=>array("UserId","ActionType","content"),
					    	"message"=>array("senderId","reciverId","messageText","readMark","senderDel","Title","reciverDel","Time"),
							"teaminformation"=>array("teamname","teamremarks","teamtake","teammader","teammadetime"),
							"activity"=>array("takeID","title","text","permissions","teamID"),
							"teamuser"=>array("userID","usertake","userinformation","offerteamID","time"),						
							);
?>
