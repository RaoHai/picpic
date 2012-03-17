<?php
/**
 * 友邻广播显示
 *	采用Memcache与数据库结合的做法
 *	1-所有的数据在Active表，id号递增，时间排序
 *	2-对于每个人，在memcache中维护他最近[1天]的动态（id，type) 列表（合并/过滤都在这个列表上进行）
 *	3- 当需要查看1天前的广播时，直接查db（这个[1天]根据用户数量进行调整）
 *	4-单条广播在memcache中单独为一个key
 *	5-查看友邻广播时，首先拿到所有友邻的广播(id,type)列表，按id排序合并，去掉不能看到的type,然后过滤，合并。
 *	同种action的合并（关注了同一个画集，同加入了一个小组）
 *   同一个人的同种行为合并（消除刷屏的危险）
 *      o 合并一个人当天所有的同类型行为（收藏，照片）
 *     o 合并一个人连续的同类型行为（推荐）
 *
 *	以上 参考自豆瓣。
 *	新增/删除的列表使用差集维护。。
 *
 * @ debug 2012-03-01
 *   新建微薄后删除字段混乱。
 *   IE浏览器对中文的微薄正文处理错误，JSON处理错误//2012-03-02 13:07 解决。
 *   2012-03-03 完全解决   
 */
require_once("controller.base.class.php");
class active extends ControllerBase
{
    public function  __construct()
    {
        parent::__construct();

    }

    public function _index()
    {
        /* /// 上传图片动作
        $img = new stdClass();
        $img->gid = 12;
        $img->gn = "xxxx";
        $img->d = "11_20120126034234_4a.jpg";
        $img->ti = time();
        $this->_new(3,1,$img);
        // */
        /* //测试用例2
           $img->id = 90;
           $img->imgurl = "11_20120126034234_4a.jpg";
           $this->_new(3,1,$img);
        // */
        $weibo = new stdClass();
        $weibo->ti=time();
        $weibo->d = "好无聊！！！";
        $this->_new(4,6,$weibo);

    }

    /**
     *	动态添加
     *
     *	参数格式
     *	$userid					用户ID，标识动态。
     *	$type		 				动态类型，每个用户一天只能有一条一个类型的动态（6类型的除外），
     *									相同类型的时间相近的动态会在读出时被合并
     *									提交重复的动态不会被写入。					
     *					 				动态取值：1，上传， 2，删除，3，新增图集   4，删除图集  5，关注操作	6，回复操作（评论等）
     *	$targetmessage		消息帧，1～5类型动态传递完整的相关数据帧，6类型带完整的回复JSON。
     *									类型1，2：imagegroupId,GroupName,Time,ImageUrl
     *
     *
     *
     *	动态列表维护在Memcache中
     * 	Memcache字段缩写：
     *  字段名					含义
     *		n						username
     *		uid					userid
     *		t						type
     *		ti						time
     *		gid					imagegroupId
     *		gn					imagegroupname
     *		d						datas
     */
    public function _new($userid,$type,$targetmessage,$recovermode)
    {
        if($recovermode==0)
        {
            $this->model->New(array($userid,$type,addslashes(json_encode($targetmessage))));
            $targetmessage->id = mysql_insert_id();
        }
        $mem = new Memcache;
        $mem->connect("127.0.0.1", 11211);
        $time = time();
        //$mem->flush();
        //$arr = array("type"=>$type,"msg"=>$targetmessage,"time"=>$time);
        //$mem->set($userid, $arr, 0, 0);
        //echo "<pre>";
        $val = $mem->get($userid);
        //var_dump($val);
        if(!empty($val))
        {
            if(!empty($val[$type]))
            {
                $val[$type][]=$targetmessage;
                $val['t']=time();
                $mem->set($userid, $val, 0, 0);

            }
            else
            {
                $val[$type]=array($targetmessage);
                $val['t']=time();
                $mem->set($userid, $val, 0, 0);
                //var_dump($val);
            }
        }
        else
        {
            //	echo "save";
            if($userid==$_SESSION['USERID']||$recovermode==1)
                $content=array('t'=>time(),"n"=>$_SESSION["NICK"],"uid"=>$_SESSION['USERID'],$type=>array($targetmessage));
            
            //$msg = array($targetmessage->id=>$targetmessage->imgurl);
            //$content[$type]=array("time"=>$time,"message"=>$msg);
            //var_dump($content);
            $mem->set($userid, $content, 0, 0);

        }
        //	echo "</pre>";
        $mem->close();
    }
    public function _test()
    {
      $mem = new Memcache;
      $mem->connect("127.0.0.1",11211);
      $arr = $mem->get('_4');
       echo '<pre>';
       var_dump($arr);
       echo '</pre>';
    }
    public function _del($userid,$targetmessage)
    {
        $mem = new Memcache;
        $mem->connect("127.0.0.1",11211);
        $arr = $mem->get($userid);
        
        echo "<pre>";
        foreach($arr[1] as $key=>$del)
        {
            if($del->d==$targetmessage->d)
            {
                $arr[1][$key]=null;
                break;
            }
        }
        var_dump($arr);
        echo '</pre>';
      
    }
    public function _delweibo($id)
    {
        $this->_delbyid($id);
        $this->model->Del_By_ActiveId($id);	

    }
    public function _delbyid($id)
    {
        $mem = new Memcache;
        $mem->connect("127.0.0.1",11211);
       // $mem->flush();
       // $mem->set('4', array(), 0, 0);
        $arr = $mem->get($_SESSION['USERID']);
        echo "<pre>";
        foreach($arr as $k=>$a)
        {
            if(is_array($a))
            {
                foreach($a as $k1=>$a2)
                {
                    echo $a2->d;
                    if($a2->id==$id)
                        unset($arr[$k][$k1]);
                }
            
            }
            
        }
        $arr['t'] = time();
        var_dump($arr);
        $mem->set($_SESSION['USERID'],$arr,0,0);
        echo "</pre>";

    }
    public function _reset()
    {
        $mem = new Memcache;
        $mem->connect("127.0.0.1",11211);
       // $mem->flush();
       // $mem->set('4', array(), 0, 0);
        $arr = $mem->get(23);
        echo "<pre>";
        foreach($arr as $k=>$a)
        {
            if(is_array($a))
            {
                foreach($a as $k1=>$a2)
                {
                    echo $a2->d;
                    if(empty($a2->id))
                        unset($arr[$k][$k1]);
                }
            
            }
            
        }
        var_dump($arr);
        $mem->set('23',$arr,0,0);
        echo "</pre>";


    }
    public function _loadfromdb()
    {
        //$mem = new Memcache;
       // $mem->connect("127.0.0.1",11211);
      // $mem->set('4',array(),0,0);
        $this->model->Get_By_UserId($_SESSION['USERID']);
        $result = $this->model->getresult();
        foreach($result as $re)
        {
            $obj = json_decode($re->content);
            $obj->id = $re->ActiveId;
            echo $obj->id."</br>";
            $this->_new($re->UserId,$re->ActionType,$obj,1);
        } 
    }
    public function _repo()
    {
       $msg = $_POST['text'];
       if(mb_strlen($msg)==0) $msg="转发：";
       $weibo = new stdClass();
       $weibo->ti = time();
       $weibo->d = addslashes($msg);
       $weibo->repo = $_POST['repo'];
       //var_dump($weibo);
       $this->_new($_SESSION['USERID'],6,$weibo);


    }
    public function _weibo()
    {
        $msg = $_POST['text'];
        if(mb_strlen($msg)>720)
        {
            echo json_encode("long");
            return;
        }
        elseif(mb_strlen($msg)<5)
        {
            echo json_encode('short');
            return;
        }
        $weibo = new stdClass();
        $weibo->ti=time();
        $weibo->d = addslashes($msg);
        $this->_new($_SESSION['USERID'],6,$weibo);
        $weibo->id=mysql_insert_id();
        // $this->_show();
        echo json_encode(array(array('id'=>$weiboid,'time'=>date('Y-m-d h:i:s',time()),'type'=>6,'username'=>$_SESSION['NICK'],'userid'=>$_SESSION['USERID'],'gid'=>"",'data'=>array(array('d'=>$weibo->d,'id'=>$weibo->id)))));
    }

    /**
     * 把memcache中缓存的active信息进行合并
     * 合并规则参照前文。
     *
     */
    public function _getActionById($id)
    {
        $this->model->Get_By_ActiveId($id);
        $acts = $this->model->getresult();
        $weibouser = new user();
        foreach($acts as $a)
        {
            $a->username = $weibouser->getuserbyid($a->UserId);
            $a->content = json_decode($a->content);
            echo json_encode($a);
        }
    }
    public function _show($page)
    {
        $mem = new Memcache;
        $mem->connect("127.0.0.1", 11211);
        $friends = new friend();
        $id=$_SESSION['USERID'];
        $friends->model->Get("all",array("User={$id}"),array(0,10));
        $re=$friends->model->getresult();
        // echo "<pre>";
        $msgarr=array();
        foreach($re as $r){
            $val2 = $mem->get('_'.$r->OtherUserId);
            $val= $mem->get($r->OtherUserId);
            if(empty($val))continue;
            //  $mem->set('_'.$r->OtherUserId, array(), 0, 0);
            //  die();
            $savedtime = $val['t'];
            if(empty($val2)|| $val['t']!=$val2['t'])
            {  
                // echo "更改缓存";
                $val = $mem->get($r->OtherUserId);
                //      echo $val['t']."</br>";
                //  echo time()-$val['t']."</br>";
                $username = $val['n'];
                $userid		=$val['uid'];
                $i=0;
                $cachearr = array();
                while($i<7)
                {
                    $imgarr= array();
                    if(!empty($val[$i]))
                    {
                        //var_dump($val[$i]);
                        $time=array();
                        foreach($val[$i] as $img)
                        {
                            //合并相近时间
                            //$time=$img->ti;
                            $curtime = $img->ti;
                            if(empty($time)||$i==6)
                            {
                                $time[]=$curtime;

                            }
                            else
                            {
                                foreach($time as $t)
                                {
                                    if(abs($t-$curtime)<1000)
                                    {
                                        // echo "合并".date('Y-m-d h:i:s',$t).":".date('Y-m-d h:i:s',$curtime)."</br>";
                                        $curtime = $t;
                                        break;
                                    }
                                    else
                                    {
                                        // echo "添加新时间段：".date('Y-m-d h:i:s',$curtime)."</br>";
                                        $time[]=$curtime;
                                    }
                                }
                            }
                            if($_SESSION['USERID']==$r->OtherUserId)
                                $imgarr[$curtime][$img->gid][]=array('d'=>$img->d,'id'=>$img->id,'repo'=>$img->repo);
                            else
                                $imgarr[$curtime][$img->gid][]=array('d'=>$img->d,'repo'=>$img->repo);
                           




                            //合并相同组
                            //$imgarr[$curtime][$img->gid][]=array('d'=>$img->d,'t'=>date('Y-m-d h:i:s',$img->ti));

                        }
                        //  var_dump($imgarr);
                        //   $dataarr=array();
                        // $cachearr = $mem->get('_'.$r->OtherUserId);
                        //if(!$cachearr) $cachearr=array();
                        foreach($imgarr as $ti=>$ar)
                        {
                            foreach($ar as $gid=>$li)
                            {
                                $msgarr[]=array("time"=>date('Y-m-d,H:i:s',$ti),"type"=>$i,"gid"=>$gid,"username"=>$username,"userid"=>$userid,"data"=>$li);
                                $cachearr[]=array('time'=>date('Y-m-d,H:i:s',$ti),"type"=>$i,'gid'=>$gid,"username"=>$username,"userid"=>$userid,"data"=>$li);

                            }
                        }

                    }

                    $i++;
                }
                $savearr = array('t'=>$savedtime,'data'=>$cachearr);
                //var_dump($savearr);
                $mem->set('_'.$r->OtherUserId, $savearr, 0, 0);


            }
            else
            {
                foreach($val2['data'] as $d)
                {
                    $msgarr[]=$d;
                }
            }
        }
        sort($msgarr);
        $chunked = array_chunk($msgarr,5,TRUE);
        if(!isset($page)||empty($page)) $page = 0;
        //echo '<pre>';
        // var_dump($chunked[$page]);
        //  echo "</pre>";
        echo json_encode($chunked[$page]);
    }

}
?>
