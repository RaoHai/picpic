<?php

	require_once("controller.base.class.php");
	class information extends ControllerBase
	{
		public function  __construct()
		{
			parent::__construct();
		

		}
		
		function showinformation()
		{
			echo<<<EOD
			<p><a href='/information/index'/>用户</a>
			   <a href='/information/friend'/>好友</a>
			   <a href='/information/other'/>其他</a></p>
EOD;
		}
		
	    public function _index()
        {
                 
                $infor = new profile();
                $pro=$infor->_getprofile();
				$this->values = array("user"=>$_SESSION["USER"],
                                    "birth"=>$pro->Birthday,
                                    "desc"=>$pro->Desc,
                                    "gender"=>$pro->Sex,
									"userid"=>$_SESSION["USERID"],
                                    "nickname"=>$_SESSION['NICK'],
									"title"=>"我的Pic-ACGPIC",);

            $this->RenderTemplate('user');
        }
        public function _save()
        {
            //echo $_POST['gender'];
            //echo $_POST['birth'];
            //echo $_POST['desc'];
            $id = $_SESSION['USERID'];
            $prof = new profile();
            $prof->model->Set(array("BirthDay"=>$_POST['birth'],"Sex"=>$_POST['gender'],"Desc"=>$_POST['desc']),array("UserId={$id}"));
            Header("Location: /information");
 
        }
	}
?>
