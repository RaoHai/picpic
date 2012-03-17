<?php

	require_once("controller.base.class.php");
	class user extends ControllerBase
	{
		public function  __construct()
		{
		
			parent::__construct();
		}
		
		public function _index()
		{
				$imagegroup = new imagegroup();
				$imagegroup ->model->Get_By_author($_SESSION["USERID"]);
				$re =$imagegroup ->model->getresult();
				
				foreach($re as $r)
				{
					$groupselect .="<option value='".$r->ImagegroupId."'>".$r->GroupName."</option>";
				}
				$this->values = array("user"=>$_SESSION["USER"],
												"title"=>"我的Pic-ACGPIC",
												"nickname"=>$_SESSION['NICK'],
												"groupselect"=>$groupselect,
												);
				$this->RenderTemplate("index");
				
		}	
		public function _logout()
		{
			session_destroy();
			header("Location:"."/");
		}
		public function _loginpage()
		{
			$this->RenderTemplate("login");
		}
		public function _login()
		{
		
			$username= $_GET["username"];
			$password= $_GET["password"];
			$this->model->Get_By_username($username);
			$re =$this->model->getresult();
			if(empty($re))
			{
				echo "0";
				return;
			}
			foreach ($re as $v)
			{
				$key = $v->salt;
				$word = $password."wibble".$key;
				//$word1= $v['password']."wibble".$key;
				if (sha1($word)==$v->password) 
				{
					$_SESSION["USER"]=$v->UserName;
					$_SESSION["USERID"]=$v->UserId;
					$_SESSION["NICK"]=$v->NickName;
					$_SESSION["permission"]=$v->permission;
					
					echo 1;
					return ;
				}
				else 
				{
					echo "0";
					return ;
				}
			}
		}
		public function _checkemail($param)
		{
			$this->model->Get_UserName_By_email($param);
			$re =$this->model->getresult();
			if(!empty($re)) echo "false";
			else echo "true";
		}
		public function _checkname($param)
		{
			$this->model->Get_UserName_By_UserName($param);
			$re =$this->model->getresult();
			if(!empty($re)) echo "false";
			else echo "true";
		}
		public function _register()
		{
				$this->RenderTemplate("register");
		}
		public function _new()
		{
			$email = $_GET['email'];
			$username = $_GET['username'];
			$nickname = $_GET['nickname'];
			$password = $_GET['password'];
			$pattern = '1234567890abcdefghijklmnopqrstuvwxyz
                   ABCDEFGHIJKLOMNOPQRSTUVWXYZ,./&amp;l
                  t;&gt;?;#:@~[]{}-_=+)(*&amp;^%$£!';    //字符池
			  for($i=0; $i<32; $i++)
			   {
				   $key .= $pattern{mt_rand(0,35)};    //生成php随机数
			   }
			$word = $password."wibble".$key;
			$hased = sha1($word);
			//"UserName","NickName","email","password","salt","permission"
			$newone = array($username,$nickname,$email,$hased,$key,"user");
			$this->model->New($newone);
			$id=mysql_insert_id();
			$_SESSION["USER"]=$username;
			$_SESSION["USERID"]=$id;
			$_SESSION["NICK"]=$nickname;
			$_SESSION["permission"]="user";
			$profile = new profile;
			$profile->model->New(array($id,0,0,0,0,0,0,0));
			echo "true";
		}
		public function _loader()
		{
				$upload_handler = new UploadHandler();
				header('Pragma: no-cache');
				header('Cache-Control: private, no-cache');
				header('Content-Disposition: inline; filename="files.json"');
				header('X-Content-Type-Options: nosniff');
				header('Access-Control-Allow-Origin: *');
				header('Access-Control-Allow-Methods: OPTIONS, HEAD, GET, POST, PUT, DELETE');
				header('Access-Control-Allow-Headers: X-File-Name, X-File-Type, X-File-Size');
				//$fp=fopen("log.txt","w");
				//fwrite($fp,"QUEST:".$_POST["upselect"]); 
				//fclose($fp);
				switch ($_SERVER['REQUEST_METHOD']) {
					case 'OPTIONS':
						break;
					case 'HEAD':
					case 'GET':
						/*$fp=fopen("log.txt","w");
						fwrite($fp,"QUEST:".$_GET["name"]); 
						fclose($fp);*/
						$upload_handler->get($_GET["name"]);
						break;
					case 'POST':
						$upload_handler->post();
						//写入数据库。其中imagegroupID从$_POST["upselect"]得到，imageurl从$upload_handler->filepathout得到。
						if(!$upload_handler->error){
							$name = $upload_handler->name;
							$url = $upload_handler->filepathout;
							$fp=fopen("log.txt","a");
							fwrite($fp,"NEW:". $url."\r\n"); 
							fclose($fp);
							$groupID = $_POST["upselect"];
							$imgmd = new image();
							$data = array($name,"",$_SESSION["USERID"], date("Y-m-d"),$url,$groupID);
							$imgmd->model->New($data);
						}
						break;
					case 'DELETE':
						$upload_handler->delete();
						  $file_name = isset($_REQUEST['file']) ? basename(stripslashes($_REQUEST['file'])) : null;
						//$url = $upload_handler->filepathout;
					
						$imgmd = new image();
						$imgmd->model->Del_By_imgurl($file_name);
						break;
					default:
						header('HTTP/1.1 405 Method Not Allowed');
				}

		}
		public function _test()
		{
			$this->values = array("user"=>"hello");
			$this->RenderTemplate("test");
		}
		public function _getuser()
		{
		
			$this->model->Get_By_UserId($_SESSION["USERID"]);
			$re=$this->model->getresult();
			$showuser=array();
		
			foreach($re as $r)
			{
				$showuser['username']=$r->UserName;
				$showuser['email']=$r->email;
			}
			return $showuser;
		}
		
//-----------------------------------------------------------		
		public function _getusername($id)
		{
			$this->model->Get_By_UserId($id);
			$re=$this->model->getresult();
		
			foreach($re as $r)
			{
				$showuser=$r->UserName;
			}
			return $showuser;
		}
		
	}
?>