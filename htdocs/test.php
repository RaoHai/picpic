<?php
    require_once("/vogoo/vogoo.php");
    require_once("/vogoo/items.php");
    require_once("/vogoo/users.php");
    require_once("/vogoo/cronlinks.php");
  /*  $vogoo->set_rating(1,1,0.9,1);
    $vogoo->set_rating(1,2,0.9,1);
    $vogoo->set_rating(1,3,0.9,1);
    $vogoo->set_rating(1,4,0.9,1);
    $vogoo->set_rating(1,5,0.9,1);
    $vogoo->set_rating(1,6,0.9,1);
    $vogoo->set_rating(1,7,0.9,1);
    $vogoo->set_rating(1,8,0.9,1);
    $vogoo->set_rating(1,9,0.9,1);
    $vogoo->set_rating(2,1,0.9,1);
    $vogoo->set_rating(2,2,0.9,1);
    $vogoo->set_rating(2,3,0.9,1);
    $vogoo->set_rating(2,4,0.9,1);
    $vogoo->set_rating(2,5,0.9,1);
    $vogoo->set_rating(2,6,0.9,1);
    $vogoo->set_rating(2,7,0.9,1);

  /* 
    $vogoo->set_rating(1,1,0.9,1);
    $vogoo->set_rating(2,1,0.8,1);
    $vogoo->set_rating(3,1,0.7,1);
    $vogoo->set_rating(4,1,0.6,1);
    $vogoo->set_rating(5,1,0.5,1);
    $vogoo->set_rating(1,2,0.4,1);
    $vogoo->set_rating(1,3,0.3,1);
    $vogoo->set_rating(2,2,0.1,1);
    $vogoo->set_rating(2,4,0.2,1);
    $vogoo->set_rating(3,2,0.3,1);
    $vogoo->set_rating(4,4,0.4,1);
    $vogoo->set_rating(5,2,0.5,1);
   */
//    echo "<pre>";
//    var_dump($vogoo->member_ratings(1));
//    var_dump($vogoo->member_ratings(2));
//    var_dump($vogoo->member_ratings(3));
//    echo "</pre>";
   // */
    echo "相似度：".$vogoo_users->member_similarity(1,2,$cat = 1);
    echo "<pre>";
    //var_dump($vogoo->product_ratings(1));
    var_dump($vogoo_items->get_linked_items(1));
    echo "</pre>";
   // $vogoo_items->get_linked_items(1);
   //$member_id,$k,&$similarities,$cat = 1
    /**
     *返回与该用户相似的其他用户
     * 注意：这个结果应当在memcached或者DB中缓存。
     * 更新频率控制在每天一次 
     *
     */
     $similarities=array();
    $recommendations;
    $vogoo_users->member_k_similarities(2,5,&$similarities,1);
    echo "<pre>";
    var_dump($similarities);
   echo "--------------\n";
    $vogoo_users->member_k_recommendations(2,5,&$similarities, &$recommendations,1,false);
    var_dump($recommendations);
    echo "</pre>";

    /**
      *推荐给2的物品～
      *需要 require_once("/vogoo/cronlinks.php");后进行整理
      */
    echo "---------------------------------\n";
    var_dump($vogoo_items->member_get_recommended_items(2,1, false, 1000000));
    //var_dump($vogoo_items->member_get_recommended_items(4,1,false, 1000000));
    //var_dump($vogoo_items->member_predict_all(2,1,false));
    //var_dump($vogoo_items->member_predict_all(1,1,false));
    //$recommendations;
    //$vogoo_users->member_k_recommendations(1,5,array(0.5,0.8), &$recommendations,1,false);
?>
