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
