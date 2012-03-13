<?php

	require_once("controller.base.class.php");
	class imagegroup extends ControllerBase
	{
		public function  __construct()
		{
			parent::__construct();
		}
	
		public function _index()//自定义你的action方法
		{
			$this->model->Get_By_author(4);
			$re =$this->model->getresult();
			foreach($re as $r)
			{
				echo $r->GroupName;
			}
		}
		public function _new()
		{
			
			$data = array($_POST['groupname'],$_POST['groupdescription'],$_POST['groupcatalog'],$_SESSION['USERID'],date("Y-m-d"),0,0);
			$this->model->New($data);
			$id=mysql_insert_id();
			$this->model->Get_By_author($_SESSION["USERID"]);
			$re =$this ->model->getresult();
			foreach($re as $r)
			{
				if($r->ImagegroupId==$id) $selected = "selected"; else $selected="";
				$groupselect .="<option value='".$r->ImagegroupId."' ".$selected.">".$r->GroupName."</option>";
			}
			echo $groupselect;
		}
		public function _show()
		{
				header('Pragma: no-cache');
				header('Cache-Control: private, no-cache');
				header('Content-Disposition: inline; filename="files.json"');
				header('X-Content-Type-Options: nosniff');
				header('Access-Control-Allow-Origin: *');
				header('Access-Control-Allow-Methods: OPTIONS, HEAD, GET, POST, PUT, DELETE');
				header('Access-Control-Allow-Headers: X-File-Name, X-File-Type, X-File-Size');
				header('Content-type: application/json');
				$id = $_GET['id'];
				
				$this->model->Get("all","magegroupId={$id}");
				$re =$this ->model->getresult();
				$group = new stdClass();
				
				foreach($re as $r )
				{
					$group->id=$r->ImagegroupId;
					$group->name=$r->GroupName;
					$group->desc=$r->Description;
					$group->cata=$r->GroupCatalog;
				}
				echo json_encode($group);
		}
		public function _edit()
		{
				$id = $_POST['groupid'];
				$this->model->Set_GroupName_By_GroupId($id,$_POST['groupname']);
				$this->model->Set_Description_By_GroupId($id,$_POST['groupdescription']);
				$this->model->Set_GroupCatalog_By_GroupId($id,$_POST['groupcatalog']);
				$this->model->Get_By_author($_SESSION["USERID"]);
				$re =$this ->model->getresult();
				foreach($re as $r)
				{
					if($r->ImagegroupId==$id) $selected = "selected"; else $selected="";
					$groupselect .="<option value='".$r->ImagegroupId."' ".$selected.">".$r->GroupName."</option>";
				}
				echo $groupselect;
		}
		public function _view($param)
		{
				//echo $param;
				if($param)
				{
					$this->model->Get_GroupName_Description_author_By_ImagegroupID($param);
					$re =$this ->model->getresult();
					//var_dump($re)
					foreach($re as $r)
					{
						$groupname = $r->GroupName;
						$groupdesc = $r->Description;
						$groupauthor = $r->author;
					}
					$author = new user();
					$author->model->Get_NickName_By_UserID($groupauthor);
					$ren = $author->model->getresult();
					
					foreach($ren as $rn)
						$authorname= $rn->NickName;
					$img = new image();
					$id = $param;
					$img->model->Get_imgurl_Description_By_GroupID($id);
					$re2 =$img ->model->getresult();
					foreach($re2 as $r2)
					{
						//echo $r2['imgurl'];
						$url = rawurlencode($r2->imgurl);
						$desc = $r2->Description;
						$images.="<a href='/files/".$url."' rel='gallery' title='".$url ."'><img src='/medium/".$url."' title='".$desc."'></img></a>\n";
					}
					$edit =($_SESSION['USERID']==$groupauthor);
					
					
					$this->values = array("user"=>$_SESSION["USER"],
													"title"=>"画集-".$groupname,
													"nickname"=>$_SESSION['NICK'],
													"images"=>$images,
													"groupname"=>$groupname,
													"groupdesc"=>$groupdesc,
													"authorname"=>$authorname,
													"authorid"=>$groupauthor,
													"userisauthor"=>$edit,
													"groupid"=>$param,
													);
				$this->RenderTemplate("view");
			}
			else
			{
				Header("Location:/404.html");
			}
		}
		public function _all($userid)
		{
			if(empty($userid)) $userid=$_SESSION["USERID"];
		//	$this->model->Get_GroupName_Description_author_By_author( $userid);
			$this->model->Get(array("ImagegroupId","GroupName","Description","author"),array("author={$userid}"));
			$re1 = $this->model->getresult();
			$img = new image();
			$author = new user();
			$author->model->Get_NickName_By_UserID($userid);
			$ren = $author->model->getresult();

			foreach($ren as $rn)
				$authorname= $rn->NickName;
			foreach($re1 as $r)
			{
				$id = $r->ImagegroupId;
				$img->model->Get_imgurl_By_GroupID($id);
				$re2 =$img->model->getresult();
				foreach($re2 as $ra)
				{
					$str = $ra->imgurl;
					$src = rawurlencode($str);
					break;
				}
				if($src)
					$images.="<div style='width:360px;float:left;height:100px;overflow:hidden;margin-left:10px;'>"
					."<h3 style='display: inline;float:left;position: absolute;color:#09f;margin-top:11px;margin-left:1px;'>".$r->GroupName."</h3>"
					."<h3 style='display: inline;float:left;position: absolute;color:white;margin-top:10px;'>".$r->GroupName."</h3>"
					."<a href ='/imagegroup/".$id."' title='".$r->Description."' >"
					."<img style='display: inline; width: 360px; left: 0px; top: 0px;margin-top:10px; ' src='/medium/".$src."' /></a></div>";
			
			}
				
				
			$this->values = array("user"=>$_SESSION["USER"],
													"title"=>"画集-".$authorname,
													"nickname"=>$_SESSION['NICK'],
													"images"=>$images,
													"groupname"=>$authorname."的画集",
													"authorname"=>$authorname,
													"authorid"=>$userid,
													"groupid"=>$id,
													);
			$this->RenderTemplate("all");
		}
		public function _showcomments($groupid)
		{
			$comment = new comments();
			$comment->model->Get_By_ImgGroupId($groupid);
			$re = $comment->model->getresult();
			
			foreach ($re as $r)
			{
				
			
					$jsarr[] = array("userid"=>$r->UserId,
										   "username"=>$r->user->NickName,
										   "time"=>$r->Time,
										   "text" =>$r->CommentText,
										   );
				
			}
				echo json_encode($jsarr);
		}
		public function _savecomments($groupid)
		{
			$groupid =$_GET['Groupid']; 
			$time = date("Y-m-d H:i:s", time()) ; 
			$userid = $_SESSION['USERID'];
			$str = $_GET['str'];
			$comment = new comments();
			$data = array($userid,0,0,$groupid,$str,0,0,$time);
			$comment->model->New($data);
		
			echo json_encode(array("success"));
		}
	}
?>