<?php

	require_once("controller.base.class.php");
	class cover extends ControllerBase
	{
		public function  __construct()
		{
			parent::__construct();
		}
		
		public function _index()//自定义你的action方法
		{
            $img = new image();
		   	$imgs = $img->model->Get("all",0,array(0,11),"Original desc");
            //获取最受欢迎的图片
            $favor = new favourite();
            foreach($imgs as $r2)
            {
               	$url = rawurlencode($r2->imgurl);
				$desc = $r2->Description;
                $like= $favor->islikeimg($_SESSION['USERID'],$r2->ImageId);
						//$images.="<a href='/files/".$url."' rel='gallery'  title='".$url ."'><img class='imginfo' src='/medium/".$url."' title='".$desc."'></img></a>\n";
                        $images.="<img class='imginfo' src='/medium/".$url."' data-url='/files/".$url."' data-id='".$r2->ImageId."' title='".$desc."' data-desc='".$desc."' data-like='".$like."' data-like-num='".$r2->Original."' data-tags='".$r2->feature."' data-author='".$r2->user->NickName."'>";
            }

            //获取最受欢迎的标签
            $tags = new tagdefine();
            $tag = $tags->model->Get('all',0,array(0,30),"TagCount desc");
            $tagoutput;
            foreach($tag as $t)
            {
                 $tagoutput.='<a href="/tag/'.$t->TagName.'"><span class="tag"><span>'.$t->TagName.'&nbsp;&nbsp;</span></span></a>';
            }
            $this->values = array("title"=>"发现-".$authorname,
								  "images"=>$images,
                                  "tags"=>$tagoutput);

            $this->RenderTemplate('index');	
		}
	}
?>
