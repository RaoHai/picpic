<?php

	require_once("controller.base.class.php");
	class tags extends ControllerBase
	{
		public function  __construct()
		{
			parent::__construct();
		}
		
		public function _index($name)//自定义你的action方法
		{
		  $mem =  Cache::getInstance();
          $postings = $mem->get($name);
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

          foreach($imgs as $r2)
          {
              	$url = rawurlencode($r2->imgurl);
						$desc = $r2->Description;
                        $like= $favor->islikeimg($_SESSION['USERID'],$r2->ImageId);
						//$images.="<a href='/files/".$url."' rel='gallery'  title='".$url ."'><img class='imginfo' src='/medium/".$url."' title='".$desc."'></img></a>\n";
                        $images.="<img class='imginfo' src='/medium/".$url."' data-url='/files/".$url."' data-id='".$r2->ImageId."' title='".$desc."' data-desc='".$desc."' data-like='".$like."' data-like-num='".$r2->Original."' data-tags='".$r2->feature."'>";

          }
          if(empty($images))$images="<h1>还没有标签为：".$name."的图片！</h1>";
          $this->values=array("title"=>"标签:".$name,
                              "images"=>$images,
                              "groupname"=>"标签：".$name,
							  "groupdesc"=>"标签为：".$name."的图片：",);
          $this->RenderTemplate('view');     
		}
        /**
         * 在memcache中维护一个逆向索引序列
         *  |EVA|    -->(13,25,36,55,19)
         *  |和谐物| -->(13,22,42,36)
         * 在Image的feature字段中保存当前图片的标签组
         *  (EVA,和谐物)   
         *
         **/

        public function _addtag()
        {
            $tagname = $_GET['tagname'];
            $tags = $_GET['tags'];
            $imgid   = $_GET['imgid'];
            
            /*保存到tags表*/
            $this->TagName = $tagname;
            $this->ImageId = $imgid;
            $this->save();

            /*保存到memcache中*/
            $mem =  Cache::getInstance();
            $postings = $mem->get($tagname);
            if($postings==null) $postings = array();
            $postings[$imgid] = 1;
            $mem->set($tagname,$postings,0,0);
            /*保存到image表中*/

            $img = new image();
            $img->model->Set_feature_By_ImageId($imgid,$tags);

            $tagdef = new tagdefine();
            $tagdef->TagName=$tagname;
            $tagdef->save();

            $tagdef->model->Set_TagCount_By_TagName($tagname,"'+`Tagdefine`.`TagCount`+1+'");

        }
        public function _removetag()
        {
            $tagname = $_GET['tagname'];
            $tags= $_GET['tags'];
            $imgid  =   $_GET['imgid'];

            /*从tag表删除*/
            $this->model->Del(array("imageid={$imgid}","tagname={$tagname}"));

            /*清除逆向索引*/
            $mem =  Cache::getInstance();
            $postings = $mem->get($tagname);
            unset($postings[$imgid]);
            $mem->set($tagname,$postings,0,0);
            /*保存到image表*/
            $img = new image();
            $img->model->Set_feature_By_ImageId($imgid,$tags);
             $tagdef = new tagdefine();
            $tagdef->model->Set_TagCount_By_TagName($tagname,"'+`Tagdefine`.`TagCount`-1+'");

        }

        public function _get($name)
        {
            $mem = Cache::getInstance();
            $tags = $mem->get($name);
            var_dump($tags);
        }
         public function _recoverFromdb()
        {
            $this->model->Get("all");
            $tags = $this->model->getresult();
            $mem =  Cache::getInstance();
            foreach($tags as $tag)
            {
                $tagname = $tag->TagName;
                $imgid   = $tag->ImageId;
                $postings = $mem->get($tagname);
                if($postings==null) $postings = array();
                $postings[$imgid] = 1;
                $mem->set($tagname,$postings,0,0);
            }
        }

	}
?>
