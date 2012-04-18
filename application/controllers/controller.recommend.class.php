<?php

	require_once("controller.base.class.php");
	class recommend extends ControllerBase
	{
		public function  __construct()
		{
			parent::__construct();
		}
		
		public function _index()//自定义你的action方法
		{
	        $id = $_SESSION['USERID'];
            $image = new image();
            $image->model->lockMutiQuery();

            $recommender = recommender::getInstance();
            //$recommender->set_rating();
            $recommenduser=$recommender->get_user_similar($id);
            $usr = new user();
            foreach($recommenduser as $user)
            {
                $username = $usr->getuserbyid($user['member_id']);
                $recmduser .= '<div style="width:180px;float:left;"><div style="float:left"><a href="/user/'.$user['member_id'].'" title="'.$username.'"><img src="/upload/avatar_small/'.$user['member_id'].'_small.jpg"/></a></div><a href="/user/'.$user['member_id'].'" title="'.$username.'"><h4 style="color:#09F;">'.$username.'</h4></a>喜好相似度：'.$user['sim'].'%</div>';

            }
            $rec = $recommender->get_item_recommend($id);
            foreach($rec as $re)
            {
                $image->model->Get_By_ImageId($re['product_id']);
            }
            $image->model->MultiQuery();
            $imgs = $image->model->getresult();
            $favor = new favourite();
            foreach($imgs as $img)
            {
                $url =rawurlencode($img->imgurl);
                $desc = $img->Description;
                $like= $favor->islikeimg($_SESSION['USERID'],$r2->ImageId);
               // $recimg.='<img class="imginfo" src="/medium/'.rawurlencode($img->imgurl).'"/>';
                $recimg.="<img class='imginfo' src='/medium/".$url."' data-url='/files/".$url."' data-id='".$img->ImageId."' title='".$desc."' data-desc='".$desc."' data-like='".$like."' data-like-num='".$img->Original."' data-tags='".$img->feature."'data-author='".$img->user->NickName."' >";

            }
            $this->values=array('recommenduser'=>$recmduser,
                                "title"=>"ACGPIC向你推荐：",
                                "recommendimg"=>$recimg);
            $this->RenderTemplate('index');
		}
        public function _test()
        {
              $recommender = recommender::getInstance();
              $recommender->auto_test(); 
        }
	}
?>
