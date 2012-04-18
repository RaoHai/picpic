<?php

	require_once("controller.base.class.php");
	class favourite extends ControllerBase
	{
		public function  __construct()
		{
			parent::__construct();
		}
		
		public function _index()//自定义你的action方法
		{
		
			
		}
        public function _likeImg($id)
        {
              $mem = new Memcache;
              $mem->connect("127.0.0.1", 11211);
              $like = $mem->get("f_".$_SESSION['USERID']);
              $like[$id]=time();
              $mem->set("f_".$_SESSION['USERID'],$like,0,0); 

              $recommender = recommender::getInstance();
              $recommender->set_rating($_SESSION['USERID'],$id,0.5);

              echo json_encode("true");
              $this->UserId = $_SESSION['USERID'];
              $this->ImageId=$id;
              $this->save();
              $img = new image();
              $img->addtofavor($id);
                
        }
        public function _unlikeImg($id)
        {
             $mem = new Memcache;
             $mem->connect("127.0.0.1", 11211);
             $like = $mem->get("f_".$_SESSION['USERID']);
             $like[$id]=NULL;
             $mem->set("f_".$_SESSION['USERID'],$like,0,0);

             $recommender = recommender::getInstance();
             $recommender->set_rating($_SESSION['USERID'],$id,0);

             echo json_encode("true");
             $this->model->Del_By_ImageId($id);
             $img = new image();
             $img->removefromfavor($id);

        }
        public function islikeImg($uid,$imgid)
        {
            //$uid=$_GET['userid'];
            //$imgid=$_GET['imgid'];
            $mem = new Memcache;
            $mem->connect("127.0.0.1", 11211);
            $like = $mem->get("f_".$uid);
            //echo $like[$imgid];
            if (isset($like[$imgid])) return true;
            else return false;
        }
       	}
?>
