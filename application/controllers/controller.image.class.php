<?php

	require_once("controller.base.class.php");
	class image extends ControllerBase
	{
		public function  __construct()
		{
			parent::__construct();
		}
		
		public function _index($id)
		{
            var_dump($id);
		}
        public function _wholike($id)
        {
            $favor = new favourite();
            $favor->model->Get_By_ImageId($id);
            $users = $favor->model->getresult();
            foreach($users as $user)
            {
                $out.= '<a href="/user/'.$user->UserId.'" title="'.$user->user->NickName.'"><img src="/upload/avatar_small/'.$user->UserId.'_small.jpg" />';
            }
            echo $out;
        }
		public function _show()
		{
			echo "调用show动作成功:参数";
			
			
		}
        public function addtofavor($id)
        {
            $this->model->verify = "";
            $this->model->Set_Original_By_ImageId($id,"'+`Image`.`Original`+1+'");
        }
        public function removefromfavor($id)
        {
            $this->model->verify = "";
            $this->model->Set_Original_By_ImageId($id,"'+`Image`.`Original`-1+'");
        }
		public function _getdesc()
		{
			$url = urlencode(trim(basename(stripslashes($_GET['url'])), ".\x00..\x20"));
			$this->model->Get_Description_By_imgurl($url);
			$re = $this->model->getresult();
			foreach($re as $r)
			{
				echo $r->Description;
			}
		}
		public function _edit()
		{
			$desc = $_GET['desc'];
			$url = urlencode(trim(basename(stripslashes($_GET['url'])), ".\x00..\x20"));
			$this->model->Set_Description_By_imgurl($url,$desc);
		}
	}
?>
