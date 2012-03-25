<?php

	require_once("controller.base.class.php");
	class group extends ControllerBase
	{
		public function  __construct()
		{
			parent::__construct();
		}
		
		public function _index($id)//自定义你的action方法
		{
		if($id==null)
		{
			$Teaminformation = new teaminformation();
			$re=$Teaminformation->_showallteam(); 
			foreach($re as $r)
				{
				$allteam .="<div id='group_show'><img class='group_picture' src='/1.jpg' ><div id='group_information'><a href='/group/".$r->TeaminformationId."'>".$r->teamname."</a></div><div id='group_information'>".$r->teamremarks."</div></div>";
					$i++;
				}
			$this->values = array("user"=>$_SESSION["USER"],
													"title"=>"我的Pic-ACGPIC",
													"nickname"=>$_SESSION['NICK'],
													"allteam"=>$allteam,
													);
			$this->RenderTemplate("index");		
		}
		else
		{	
			$_SESSION["TEAMID"]=$id;
			$Teaminformation = new teaminformation();
			$re=$Teaminformation->_show($id);
			$Teamuser = new teamuser();
			foreach($re as $r)
			{
			$information ="<img class='group_picture' src='/1.jpg'>".$r->teamremarks;
			}
			$Permissions=$Teamuser->_permissions();
			$this->values = array("user"=>$_SESSION["USER"],
													"title"=>"我的Pic-ACGPIC",
													"nickname"=>$_SESSION['NICK'],
													"information"=>$information,
													"permissions"=>$Permissions
													);
			$this->RenderTemplate("groupid");
		}
		}
		
		public function _add()
		{			
			$Teamuser = new teamuser();
			$Teaminformation = new teaminformation();
			$re=$Teamuser->_showoffergroup();
			
			foreach($re as $r)
			{
			$re1=$Teaminformation->_show($r->offerteamID);
			foreach($re1 as $r1)
				{
					$allteam .="<div id='group_show'><img class='group_picture' src='../2.jpg' data-id='".$r1->TeaminformationId."'><div id='group_information'><a href='/group/".$r1->TeaminformationId."'>".$r1->teamname."</a></div><div id='group_information'>".$r1->teamremarks."</div></div>";
				}
				
			}
			$this->values = array("user"=>$_SESSION["USER"],
													"title"=>"我的Pic-ACGPIC",
													"nickname"=>$_SESSION['NICK'],
													"allteam"=>$allteam,
													);
			$this->RenderTemplate("index");		
		}
		
		public function _welcome()
		{
		//	echo   json_encode("hello!".$_GET['id']);
		echo json_encode("<a href='/group/add/'>加群</a>");
		}
		
		public function _Addgroup()
		{
			$this->values = array("user"=>$_SESSION["USER"],
													"title"=>"我的Pic-ACGPIC",
													"nickname"=>$_SESSION['NICK'],
													"allteam"=>$allteam,
													);
			$this->RenderTemplate("Addgroup");		
		}
		
		public function _imagegroup()
		{
		$imagegroup = new imagegroup();
				$imagegroup ->model->Get_By_coverid($_SESSION["TEAMID"]);
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
			$this->RenderTemplate("imagegroup");		
		}
		
		public function _imagegroupadd()
		{
			$Imagegroup= new imagegroup();
		    $Imagegroup->_add($_POST['groupname'],$_POST['groupdescription'],$_POST['groupcatalog']);
		}
	
		
	}
?>