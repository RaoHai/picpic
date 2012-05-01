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
				$allteam .="<div id='group-show-".$r->TeaminformationId."'><div id='group_show'><img class='group_picture' src='".$file."' ><div id='group_information'><a href='/group/".$r->TeaminformationId."'>".$r->teamname."</a></div><div id='group_information'>".$r->teamremarks."</div></div></div>";
					$i++;
				$TeamID=$TeamID+1;
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
			$re2=$Teamuser->_all();
			foreach($re2 as $r2)
			{
			$Permissions=$r2->usertake;
			$groupuerid=$r2->TeamuserId;
			}
			
			foreach($re as $r)
			{
			if($Permissions>0)
				{
					$picture ="<a data-controls-modal='modal-from-avatar' data-backdrop='true' style='width:120px;overflow:hidden;'><img id='group_picture' style='width:120px;max-height:140px;' src='/upload/avatar_big/group_".$id."_big.jpg' title='点击以更改头像'/></a>";
					$groupname=$r->teamname;
					$groupdescription=$r->teamremarks;
				}
			else
				{
					$picture ="<img id='group_picture' style='width:120px;max-height:140px;' src='/upload/avatar_big/group_".$id."_big.jpg' title='点击以更改头像'/>";
					$groupname=$r->teamname;
					$groupdescription=$r->teamremarks;
				}
			}
			
			
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
													"picture"=>$picture,
													"groupuserid"=>$groupuerid,
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
				if(file_exists("upload/avatar_big/group_".$r1->TeaminformationId."_big.jpg"))				
				$file="/upload/avatar_big/group_".$r1->TeaminformationId."_big.jpg";	
				else
				$file="/upload/avatar_big/_big.jpg";
					$allteam .="<div id='group_show'><img class='group_picture' src='".$file."' data-id='".$r1->TeaminformationId."'><div id='group_information'><a href='/group/".$r1->TeaminformationId."'>".$r1->teamname."</a></div><div id='group_information'>".$r1->teamremarks."</div></div>";
					$i++;
				}
				
			}
			$this->values = array("user"=>$_SESSION["USER"],
													"title"=>"我的Pic-ACGPIC",
													"nickname"=>$_SESSION['NICK'],
													"allteam"=>$allteam,
													);
			$this->RenderTemplate("index");	
			echo ("<script>$('#group_all_show').css({
          display:'none'
        })</script>");
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
		
		public function _imagegroup($id)
		{
		if($id==null)
		{
		$Imagegroup=new imagegroup();
		$re=$Imagegroup->showimagegroup($_SESSION['TEAMID']);
		foreach($re as $r)
		{
			$imagegroupshow .="<a href='/group/imagegroup/".$r->ImagegroupId."'><div id='imagegroup'>".$r->GroupName."</div></a>";
		}
			$this->values = array("user"=>$_SESSION["USER"],
													"title"=>"我的Pic-ACGPIC",
													"nickname"=>$_SESSION['NICK'],
													"groupselect"=>$groupselect,
													"imagegroupshow"=>$imagegroupshow,
													);
			
		}
		else
		{
		
		$imagegroup = new imagegroup();
		$imagegroup ->model->Get_By_coverid($_SESSION["TEAMID"]);
		$re =$imagegroup ->model->getresult();
		foreach($re as $r)
		{
			$groupselect.="<option value='".$r->ImagegroupId."'>".$r->GroupName."</option>";
		}
		//var_dump($re);
		$image = new image();
		$image->model->Get_By_GroupID($id);
		$re1=$image->model->getresult();
		foreach($re1 as $r1)
		{
			
						//echo $r2['imgurl'];
						$url = rawurlencode($r1->imgurl);
						$desc = $r1->Description;
						$imageshow.="<a href='/files/".$url."' rel='gallery' title='".$url ."'><img src='/medium/".$url."' title='".$desc."'></img></a>\n";
		}
		$_SESSION["IMAGEGROUP"]=$id;
			$imagegroupshow='<button data-controls-modal="modal-from-image" data-backdrop="true" data-keyboard="true" class="btn"style="margin-top: 4px;margin-left:20px;">图片上传</button>';
			$this->values = array("user"=>$_SESSION["USER"],
													"title"=>"我的Pic-ACGPIC",
													"nickname"=>$_SESSION['NICK'],
													"groupselect"=>$groupselect,
													"imagegroupshow"=>$imagegroupshow,
													"imageshow"=>$imageshow,
													);
													
		}
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
			$TeamID=$_POST['group_all_show'];
			foreach($re as $r)
				{
				if(file_exists("upload/avatar_big/group_".$r->TeaminformationId."_big.jpg"))				
				$file="/upload/avatar_big/group_".$r->TeaminformationId."_big.jpg";	
				else
				$file="/upload/avatar_big/_big.jpg";			
				$allteam .="<div id='group-show-".$r->TeaminformationId."' style='display:none;'><div id='group_show'><img class='group_picture' src='".$file."' ><div id='group_information'><a href='/group/".$r->TeaminformationId."'>".$r->teamname."</a></div><div id='group_information'>".$r->teamremarks."</div></div></div>";
				$TeamID++;
				$allteam .="<script>$('#group-show-".$r->TeaminformationId."').show('slow');</script>";
				}
			echo $allteam;
			if($Teaminformation->_showallteam($TeamID)==null)
			{
			echo ("<script>$('#group_all_show').css({          display:'none'        })</script>");
			}
		}
		
		public function _activity($id)
		{
		$Teamuser = new teamuser();
		$Permissions=$Teamuser->_all("permissions");
		$i=0;
		$_SESSION["ACTIVITYID"]=$id;
		$Comments=new comments();
		$re=$Comments->show($_SESSION["ACTIVITYID"],$i);
		foreach($re as $r)
		{
			$commentshow .="<div id='comment-".$r->CommentsId."'><div id='comment_recive'>
				<div id='user_picture'><img src='/upload/avatar_small/".$r->UserId."_small.jpg' style='float:left'>
				</div>
				<div id='comment_text'>
				".htmlspecialchars($r->CommentText)."
				</div>
				</div>
				</div>";
			$i++;
		}
		
		
		$Comments->model->Get('count',array("activityID=".$_SESSION["ACTIVITYID"]));
		$commentcounts=$Comments->model->getresult();
		if($commentcounts>=10)
		{
		$commentnumber .="<a href='/group/group/activity/".$id."/1'>1</a>";
		$j=1;
		for(;$commentcounts>10;$commentcounts=$commentcounts-10)
		{
		$j++;
		$commentnumber .="<a href='/group/group/activity/".$id."/".$j."'>".$j."</a>";	
		}
		}

		echo $index;
			$this->values = array("user"=>$_SESSION["USER"],
													"title"=>"我的Pic-ACGPIC",
													"nickname"=>$_SESSION['NICK'],
													"groupselect"=>$groupselect,
													"commentshow"=>$commentshow,
													"groupactivity"=>$i,
													"permissions"=>$Permissions,
													"commentnumber"=>$commentnumber,
													"commentindex"=>0
													);
													
			$this->RenderTemplate("activity");	
			
			if($Comments->show($_SESSION["ACTIVITYID"],$i)!=null)
			echo "<script></script>";
		}
		
		public function _commentindex()
		{
			$Comments=new comments();
			$re=$Comments->show($_SESSION["ACTIVITYID"],$_POST['comment_index']);
			foreach($re as $r)
			{
				$commentshow .="<div id='comment-".$r->CommentsId."' >
				<div id='comment_recive'>
				<div id='user_picture'><img src='/upload/avatar_small/".$r->UserId."_small.jpg' style='float:left'>
				</div>
				<div id='comment_text'>
				".htmlspecialchars($r->CommentText)."
				</div>
				</div>
				</div>";
				
			}			
			if($re==null)
			echo "false";

			//if()
			//$commentshow .= '<script>$("#groupoffer").empty();</script>';
			//$commentshow .= '<script>$("#groupoffer").append(msg); </script>';
			echo $commentshow;		
		
		}
		
		public function _activityshow()
		{
			$Comments=new comments();
			$Comments->add($_SESSION["USERID"],$_POST['activityrecive'],$_SESSION["ACTIVITYID"]);
			$re=$Comments->show($_SESSION["ACTIVITYID"],$_POST['groupactivity']);
			$i=$_POST['groupactivity'];
			foreach($re as $r)
			{
				$commentshow .="<div id='comment-".$r->CommentsId."' style='display:none'>
				<div id='comment_recive'>
				<div id='user_picture'><img src='/upload/avatar_small/".$r->UserId."_small.jpg' style='float:left'>
				</div>
				<div id='comment_text'>
				".htmlspecialchars($r->CommentText)."
				</div>
				</div>
				</div>";
				$i++;
				$commentshow .="<script>$('#comment-".$r->CommentsId."').show('slow')</script>";
			}
			$commentshow .="<script>$('#groupactivity').val(".$i.");</script>";
			
			echo $commentshow;		
		}
		
		public function _group_add()
		{
			$Teamuser=new teamuser();
			$Teamuser->_add($_SESSION["USERID"],$_SESSION["TEAMID"],1);
			echo json_encode("成功加入");
		}
		
		public function _group_out()
		{
			$Teamuser=new teamuser();
			$Teamuser->_out($_POST['groupuserid']);
			echo json_encode("成功退出");
		}
		
		public function _Add_groups()
		{
			$Teaminformation = new teaminformation();
			$Teaminformation->add($_POST['groupname'],$_POST['groupremarks'],$_SESSION["USERID"],0);
		}

		
	}
?>