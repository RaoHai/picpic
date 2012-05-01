<?php

	require_once("controller.base.class.php");
	class search extends ControllerBase
	{
		public function  __construct()
		{
			parent::__construct();
		}
		
		public function _index()//自定义你的action方法
		{
	        $search =  $_GET['search_field'];
            if(empty($search) || $search=="图片/作者/画集")
                echo "<script>history.back(-1);</script>";
           //查找用户
           $user = new user();
           $usersearch = $user->model->Get('all',array("NickName` LIKE '%$search%"),array(0,5));
           if(empty($usersearch))
            $searchuser="<h3>没有找到相关用户</h3>";
            foreach($usersearch as $userresult)
            {
                $username = $userresult->NickName;
                $userid = $userresult->UserId;
                $searchuser .= '<div style="width:180px;float:left;"><div style="float:left"><a href="/user/'.$userid.'" title="'.$username.'"><img src="/upload/avatar_small/'.$userid.'_small.jpg"/></a></div><a href="/user/'.$userid.'" title="'.$username.'"><h4 style="color:#09F;">'.$username.'</h4></a></div>';

            }
            //查找标签
            $mem =  Cache::getInstance();
            $tagdef = new tagdefine();
            $tags = $tagdef->model->Get('all',array("TagName` LIKE '%$search%"),array(0,5));
            if(empty($tags))
                $tagline = "<h3>没有找到相关标签</h3>";
            foreach($tags as $tag)
            {
                $tagname = $tag->TagName;
                $postings = $mem->get($tagname);
	      //var_dump($postings);
                $image = new image();
                $image->model->lockMutiQuery();
                foreach($postings as $key=>$value)
                {
                     $image->model->Get_By_ImageId($key); 
                }
                $image->model->MultiQuery();
                $imgs = $image->model->getresult();
                $favor = new favourite();
                $tagline.='<div class="tagsinput"><a href="/tag/'.$tagname.'"><span class="tag"><span>'.$tagname.'&nbsp;&nbsp;</span></span></a>';
                foreach($imgs as $r2)
                {
                   //var_dump($r2);
                    $tagline.='<div style="margin:8px;"><div><a href="/files/'.$r2->imgurl.' "><img src="/thumbnails/'.$r2->imgurl.'"/></a></div><div><a href="/user/'.$r2->author.'">'.$r2->user->NickName.'</a></br>描述：'.$r2->Description.'</div></div>';
                }
            }
            //查找画集
            $imggroup = new imagegroup();
            $searchgroup = $imggroup->model->Get('all',array("GroupName` LIKE '%$search%"),array(0,5));
            if(empty($searchgroup)) $groupline = "<h3>没有相关的画集</h3>";
            $image=new image();
            foreach($searchgroup as $groups)
            {
                $id = $groups->ImagegroupId;
                $imgs = $image->model->Get('all',array("GroupId=$id"),array(0,1));
                foreach($imgs as $img)
                    $imgurl = rawurlencode($img->imgurl);
                $groupline.='<div><div><a href="/imagegroup/'.$id.'"><img src="/thumbnails/'.$imgurl.'"/></a></div><div><b>'.$groups->GroupName.'</b></br>'.$groups->user->NickName.'</div></div>';
            }
            $this->values=array("searchuser"=>$searchuser,
                                "title"=>"搜索：$search",
                                "searchtext"=>$search,
                                "searchtag"=>$tagline,
                                "searchgroup"=>$groupline);
           $this->RenderTemplate('index');
		}
	}
?>
