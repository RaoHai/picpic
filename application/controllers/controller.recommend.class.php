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
            //var_dump($recommender->get_user_similar($id));
            $rec = $recommender->get_item_recommend($id);
            foreach($rec as $re)
            {
                $image->model->Get_By_ImageId($re['product_id']);
            }
            $image->model->MultiQuery();
            
		}
	}
?>
