<?php
    /** 推荐系统
     *  使用vogoo引擎。
     *  使用Memcached缓存部分结果
     */
  require_once(INDEX_PATH."/vogoo/vogoo.php");
  require_once(INDEX_PATH."/vogoo/users.php");

class recommender
{
	static private $_instance = NULL;
    static private $mem ;
    private function __construct()
    {
        self::$mem =  Cache::getInstance();
    }
    private function __clone()
    {
    }
    static public function getInstance() 
    {
        if (is_null(self::$_instance) || !isset(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    static public function set_rating($userid,$target,$rating)
    {
//       $target = $_GET['gid']; 
//       $rating = $_GET['rating'];
//       $userid = $_SESSION['USERID'];
       global $vogoo;
       $vogoo->set_rating($userid,$target,$rating,1);
    }
    static public function get_user_similar($userid)
    {
        $mem = self::$mem;
        $sim = $mem->get('_r'.$userid);
        if(time()-$sim['time']>86400||empty($sim))
        {
            $similarities=array();
            global $vogoo_users;
            $vogoo_users->member_k_similarities($userid,5,&$similarities,1);
            $arr=array('time'=>time(),'sim'=>$similarities);
            $mem->set('_r'.$userid,$arr,0,0);
        }
        else
            $similarities = $sim['sim'];
        return $similarities;
        //member_k_similarities
    }
    static public function get_item_recommend($userid)
    {
        $mem = self::$mem;
        $rec = $mem->get('_re'.$userid);
        if(time()-$rec['time']>86400||empty($rec))
        {
            $recommendations;
            global $vogoo_users;
            global $vogoo;
            $sim = self::get_user_similar($userid);
            //require_once("/vogoo/cronlinks.php");
            $vogoo_users->member_k_recommendations($userid,10,&$sim, &$recommendations,1,false);
            $arr = array('time'=>time(),'rec'=>$recommendations);
            $mem->set('_re'.$userid,$arr,0,0);
        }
        else
            $recommendations = $rec['rec'];
        return $recommendations;
    }
    static public function auto_test()
    {
        for($i=23;$i<28;$i++)
        {
            for($j=0;$j<20;$j++)
            {
                $image=rand(89,213);
                echo $i ." like ".$image."\n";
                self::set_rating($i,$image,0.5);
            }
        }
    }

}

?>
