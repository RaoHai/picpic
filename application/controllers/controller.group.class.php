<?php

	require_once("controller.base.class.php");
	class group extends ControllerBase
	{
		public function  __construct()
		{
			parent::__construct();
		}
		
		public function _index($id)//自定义你的action方法
		{
		if($id==null)
		{
			$Teaminformation = new teaminformation();
			$re=$Teaminformation->_showallteam(); 
			foreach($re as $r)
				{
				if(file_exists("upload/avatar_big/group_".$r->TeaminformationId."_big.jpg"))				
				$file="/upload/avatar_big/group_".$r->TeaminformationId."_big.jpg";	
				else
				$file="/upload/avatar_big/_big.jpg";			
				$allteam .="<div id='group_show'><img class='group_picture' src='".$file."' ><div id='group_information'><a href='/group/".$r->TeaminformationId."'>".$r->teamname."</a></div><div id='group_information'>".$r->teamremarks."</div></div>";
					$i++;
				$TeamID=$r->TeaminformationId;
				}
			
			$this->values = array("user"=>$_SESSION["USER"],
													"title"=>"我的Pic-ACGPIC",
													"nickname"=>$_SESSION['NICK'],
													"allteam"=>$allteam,
													"teamID"=>$TeamID,
													);
			$this->RenderTemplate("index");		
		}
		else
		{	
			$_SESSION["TEAMID"]=$id;
			$Teaminformation = new teaminformation();
			$re=$Teaminformation->_show($id);
			$Teamuser = new teamuser();
			foreach($re as $r)
			{
			$information ="<a data-controls-modal='modal-from-avatar' data-backdrop='true' style='width:120px;overflow:hidden;'><img style='width:120px;max-height:140px;' src='/upload/avatar_big/group_".$id."_big.jpg' title='点击以更改头像'/></a>".$r->teamremarks;
			$groupname=$r->teamname;
			$groupdescription=$r->teamremarks;
			}
			$Permissions=$Teamuser->_permissions();
			
			$Activity=new activity();
			$re1=$Activity->_showall($id);
			foreach($re1 as $r1)
			{
				$activityinformation .="<p><a href='/group/activity/".$r1->ActivityId."'>".$r1->title." ".$r1->text."</a></p>";
			}
			
			$this->values = array("user"=>$_SESSION["USER"],
													"title"=>"我的Pic-ACGPIC",
													"nickname"=>$_SESSION['NICK'],
													"information"=>$information,
													"permissions"=>$Permissions,
													"groupname"=>$groupname,
													"groupdescription"=>$groupdescription,
													"activity"=>$activityinformation,
													);
			$this->RenderTemplate("groupid");
		}
		}
		
		public function _add()
		{			
			$Teamuser = new teamuser();
			$Teaminformation = new teaminformation();
			$re=$Teamuser->_showoffergroup();
			
			foreach($re as $r)
			{
			$re1=$Teaminformation->_show($r->offerteamID);
			foreach($re1 as $r1)
				{
					$allteam .="<div id='group_show'><img class='group_picture' src='../2.jpg' data-id='".$r1->TeaminformationId."'><div id='group_information'><a href='/group/".$r1->TeaminformationId."'>".$r1->teamname."</a></div><div id='group_information'>".$r1->teamremarks."</div></div>";
				}
				
			}
			$this->values = array("user"=>$_SESSION["USER"],
													"title"=>"我的Pic-ACGPIC",
													"nickname"=>$_SESSION['NICK'],
													"allteam"=>$allteam,
													);
			$this->RenderTemplate("index");		
		}
		
		public function _welcome()
		{
		//	echo   json_encode("hello!".$_GET['id']);
		echo json_encode("<a href='/group/add/'>加群</a>");
		}
		
		public function _Addgroup()
		{
			$this->values = array("user"=>$_SESSION["USER"],
													"title"=>"我的Pic-ACGPIC",
													"nickname"=>$_SESSION['NICK'],
													"allteam"=>$allteam,
													);
			$this->RenderTemplate("Addgroup");		
		}
		
		public function _imagegroup()
		{
		$imagegroup = new imagegroup();
				$imagegroup ->model->Get_By_coverid($_SESSION["TEAMID"]);
				$re =$imagegroup ->model->getresult();
				
				foreach($re as $r)
				{
					$groupselect .="<option value='".$r->ImagegroupId."'>".$r->GroupName."</option>";
				}
			$this->values = array("user"=>$_SESSION["USER"],
													"title"=>"我的Pic-ACGPIC",
													"nickname"=>$_SESSION['NICK'],
													"groupselect"=>$groupselect,
													);
			$this->RenderTemplate("imagegroup");		
		}
		
		public function _imagegroupadd()
		{
			$Imagegroup= new imagegroup();
		    $Imagegroup->_add($_POST['groupname'],$_POST['groupdescription'],$_POST['groupcatalog']);
		}
		
		public function _group_picture_change()
		{
			echo "123";
		}
		
		public function _informationupdate()
		{
			$Teaminformation= new teaminformation();
			$Teaminformation->_updateteamname($_SESSION["TEAMID"],$_POST["groupnewname"],$_SESSION['USERID']);
			$Teaminformation->_updateteamremarks($_SESSION["TEAMID"],$_POST["groupnewdescription"],$_SESSION['USERID']);
		}
		
		public function _activityadd()
		{	
			$Activity = new activity();
			$Activity->_add($_SESSION["USERID"],$_POST['activityname'],$_POST['activitydescription'],0,$_SESSION["TEAMID"]);
		}
		
		public function _group_allshow()
		{
			$Teaminformation = new teaminformation();
			$re=$Teaminformation->_showallteam($_POST['group_all_show']); 
			foreach($re as $r)
				{
				if(file_exists("upload/avatar_big/group_".$r->TeaminformationId."_big.jpg"))				
				$file="/upload/avatar_big/group_".$r->TeaminformationId."_big.jpg";	
				else
				$file="/upload/avatar_big/_big.jpg";			
				$allteam .="<div id='group_show'><img class='group_picture' src='".$file."' ><div id='group_information'><a href='/group/".$r->TeaminformationId."'>".$r->teamname."</a></div><div id='group_information'>".$r->teamremarks."</div></div>";
					$i++;
				$TeamID=$r->TeaminformationId;
				}
			echo $allteam;
			if($Teaminformation->_showallteam($TeamID)==null)
			{
			echo ("<script>$('#group_all_show').css({
          display:'none'
        })</script>");
			}
		}
		
		public function _activity($id)
		{
		$_SESSION["ACTIVITYID"]=$id;
		$Comments=new comments();
		$re=$Comments->show($_SESSION["ACTIVITYID"],1);
		foreach($re as $r)
		{
			$commentshow .="<div>".$r->CommentText."</div>";
			$groupactivity=$r->CommentsId;
		}
			$this->values = array("user"=>$_SESSION["USER"],
													"title"=>"我的Pic-ACGPIC",
													"nickname"=>$_SESSION['NICK'],
													"groupselect"=>$groupselect,
													"commentshow"=>$commentshow,
													"groupactivity"=>$groupactivity,
													);
			$this->RenderTemplate("activity");	
		}
		
		public function _activityshow()
		{
			$Comments=new comments();
			$Comments->add($_SESSION["USERID"],$_POST['activityrecive'],$_SESSION["ACTIVITYID"]);
			$re=$Comments->show($_SESSION["ACTIVITYID"],$_POST['groupactivity']);
			foreach($re as $r)
			{
				$commentshow .="<div>".$r->CommentText."</div>";
				$groupactivity=$r->CommentsId;
			}
			$commentshow .="<script>$('#groupactivity').val(".$groupactivity.");</script>";
			echo $commentshow;		
		}
		
		public function _group_add()
		{
			$Teamuser=new teamuser();
			$Teamuser->_add($_SESSION["USERID"],$_SESSION["TEAMID"],0);
			echo json_encode("成功加入");
		}

		
	}
?>