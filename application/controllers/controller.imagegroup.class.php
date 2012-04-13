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
					$img->model->Get_imgurl_Description_Original_feature_By_GroupID($id);
					$re2 =$img ->model->getresult();
                    $favor = new favourite();
					foreach($re2 as $r2)
					{
                        //echo $r2['imgurl'];
						$url = rawurlencode($r2->imgurl);
						$desc = $r2->Description;
                        $like= $favor->islikeimg($_SESSION['USERID'],$r2->ImageId);
						//$images.="<a href='/files/".$url."' rel='gallery'  title='".$url ."'><img class='imginfo' src='/medium/".$url."' title='".$desc."'></img></a>\n";
                        $images.="<img class='imginfo' src='/medium/".$url."' data-url='/files/".$url."' data-id='".$r2->ImageId."' title='".$desc."' data-desc='".$desc."' data-like='".$like."' data-like-num='".$r2->Original."' data-tags='".$r2->feature."'data-author='".$r2->user->NickName."' >";
					}
					$edit =($_SESSION['USERID']==$groupauthor);
					
					
					$this->values = array(	"title"=>"画集-".$groupname,
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
        public function getNameById($id)
        {
            $this->model->Get_groupname_By_ImagegroupID($id);
            foreach($this->model->getresult() as $group)
            {
                return $group->groupname;
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
        public function getPublicImgs()
        {
            $this->model->Get('all',array(),array(0,5),"likes DESC");
            $imggroups = $this->model->getresult();
            $img = new image();
            $returnCover=array();
            foreach($imggroups as $groups)
            {
                $cover = new stdClass();
                $gid = $groups->ImagegroupId;
                $cover->GroupId = $gid;
                $cover->GroupName = $groups->GroupName;
                $cover->Desc = $groups->Description;
                $img->model->Get(array('imgurl'),array("GroupId={$gid}"),array(0,4));
                $imgs = $img->model->getresult();
                foreach($imgs as $i)
                {
                    $cover->img[] = rawurlencode($i->imgurl);
                }
                $returnCover[] = $cover;
            }
            //echo "<pre>";
            //var_dump($returnCover);
            //echo "</pre>";
            return $returnCover;
        }
        public function getCoverByID($id)
        {
            $this->model->Get_By_Author($id);
            $imggroups = $this->model->getresult();
            $img = new image();
            $returnCover=array();
            foreach($imggroups as $groups)
            {
                $cover = new stdClass();
                $gid = $groups->ImagegroupId;
                $cover->GroupId = $gid;
                $cover->GroupName = $groups->GroupName;
                $cover->Desc = $groups->Description;
                $img->model->Get(array('imgurl'),array("GroupId={$gid}"),array(0,4));
                $imgs = $img->model->getresult();
                foreach($imgs as $i)
                {
                    $cover->img[] = rawurlencode($i->imgurl);
                }
                $returnCover[] = $cover;
            }
            //echo "<pre>";
            //var_dump($returnCover);
            //echo "</pre>";
            return $returnCover;
        }
		public function _showcomments($groupid)
		{
			$comment = new comments();
			$comment->model->Get_By_ImgGroupId($groupid);
			$re = $comment->model->getresult();
		    $mem = new Memcache;
            $mem->connect("127.0.0.1",11211);
	
			foreach ($re as $r)
			{
				    $saved = $mem->get('_C'.$r->CommentsId);
                    if($saved!=false) $jsarr[]= $saved;
                    else
                        	$jsarr[] = array("id"=>$r->CommentsId,
                                           "userid"=>$r->UserId,
										   "username"=>$r->user->NickName,
										   "time"=>$r->Time,
										   "text" =>$r->CommentText,
										   );
			}
               // echo "<pre>";
                //var_dump($jsarr);
                //echo "</pre>";
				echo json_encode($jsarr);
		}
		public function _savecomments($groupid)
		{
			$comment = new comments();
            $comment->UserId = $_SESSION['USERID'];
            $comment->ImgGroupId= $_GET['Groupid'];
            $comment->Time =  date("Y-m-d H:i:s",time());
            $comment->CommentText = $_GET['str'];
		    $comment->presave();		
			echo json_encode(array("success"));
		}
        public function _replyto($id)
        {
            $comment = new comments();
            $comment->UserId = $_SESSION["USERID"];
            $comment->Time = date("Y-m-d H:i:s",time());
            $comment->CommentText = $_GET['str'];
            $comment->ReplyID = $id;
            $comment->saveToReply();
            echo json_encode(array("success"));
        }
		//---------------------------------------------------------
		//以下为群组画集函数
		//---------------------------------------------------------
		
		//群组的画集添加，基本参照用户的画集添加,需要权限管理
		public function _add($groupname,$description,$catalog)
		{
			$Teamuser=new teamuser();
		//	if($Teamuser->_permissions()!=0)
			{
			$this->model->New(array($groupname,$description,$catalog,$_SESSION['USERID'],date("Y-m-d"),0,$_SESSION['TEAMID']));
			return 'true';
			}
			/*
			else
			return 'false';
			*/
			
		}
		
		//更新有关画集的相关信息
		public function _updategroupname($groupID,$groupname)
		{
			if($Teamuser->_permissions()!=0);
			{
				$this->model->Set(array("GroupName"=>$groupname,"updates"=>date("Y-m-d")),array("ImagegroupId"=>$grouID));
				return true;
				}
		}		
		public function _updatedescription($groupID,$description)
		{
			if($Teamuser->_permissions()!=0);
			{
				$this->model->Set(array("Description"=>$description,"updates"=>date("Y-m-d")),array("ImagegroupId"=>$grouID));
				return true;
				}
		}
		
		//显示有关画集的相关信息
		public function _showteamimagegroup($id)
		{
			$this->model->Get_By_ImagegroupId($id);
			$re=$this->model->getresult();
			return $re;
		}
		
		public function _allgroup($teamid)
		{
			if(empty($teamid)) $teamid=$_SESSION["TEAMID"];
		//	$this->model->Get_GroupName_Description_author_By_author( $userid);
			$this->model->Get(array("ImagegroupId","GroupName","Description","author"),array("coverid={$teamid}"));
			$re1 = $this->model->getresult();
			$img = new image();

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
													"nickname"=>$_SESSION['NICK'],
													"images"=>$images,
													"groupname"=>$authorname."的画集",
													"authorname"=>$authorname,
													"authorid"=>$userid,
													"groupid"=>$id,
													);
		}
		
	}
?>
