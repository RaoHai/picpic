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
	
		public function _activity()
		{
			$Activity=new activity();
			if($_POST['title']!=null && $_POST['text']!=null &&$_POST['take1']!=null)
			$Activity-> _add($_SESSION["USERID"],$_POST['title'],$_POST['text'],$_POST['take1']);
			
			$show="<form name='showmessage' action='activity' method='post' >
				<p>
				<input type='text' name='title' />
				<input type='text' name='text' />
				<input type='text' name='take1' />
				<input type=submit name='click2' value='确定'/>
				<input type=reset name='click1' vlaue='重置'/></p>";
			echo $show;
			
			$showactivity=$Activity->_showinformation(1);
		
			foreach($showactivity as $info)
			{
				echo $info->takeID." ".$info->title." ".$info->text." ".$info->time."</br >";
			}
		}
		
		public function _team()
		{
		$Teaminformation= new teaminformation();
		$User=new user();
		$Teamuser=new teamuser();
		if($_GET['teamid']==null)
		{
			$show="<a href='/information/teamadd'>添加群</a></br>";
			echo $show;
			$Teaminformation->_showallteam();
		}
		else
		{
		$Information=$Teaminformation->_show($_GET['teamid']);		
		foreach($Information as $r)
			{
				echo $r->teamname." ".$r->teamremarks." ".$User->_getusername($r->teammader)." ".$r->teammadetime."</br>";
			}
			echo "<a  href='/information/teamuseradd'> 加入</a> ";
			echo "<a href='/information/teamupdate'>修改</a> ";
			echo "<a href='/information/teamimage'>画集</a> ";
			echo "</br>";
			$Teamuser->_showall();
			/*
			echo<<<EOD
			<script language="javascript" type="text/javascript">  
				var xmlHttp=null;
			    function checkon(){
					xmlHttp=new XMLHttpRequest();
					xmlHttp.onreadystatechange=stateChanged;	
					xmlHttp.open("get","/information/teamuseradd",true);
					xmlHttp.send(null)		
					}
				function stateChanged() 
					{
					return true;
					}';
			</script> 
			<a  href=#  onclick= "checkon()"> 加入</a> 
EOD;
*/
		}
		}
		
		public function _teamadd()
		{
		$Teaminformation= new teaminformation();
			if($_POST['teamname']==null )
			$show="<form name='teamadd' action='teamadd' method='post'>
				<p>
				<input type='text' name='teamname' />
				<input type='text' name='teamremarks'/>
				<input type=submit name='click2' value='确定'/>
				<input type=reset name='click1' vlaue='重置'/></p>";
			else
			{
				$Teaminformation->_add($_POST['teamname'],$_POST['teamremarks'],$_SESSION["USERID"],0);
				$show="<a href='/information/team'>123</a>";
			}
			echo $show;
		}
		
		public function _teamuseradd()
		{
			$Teamuser=new teamuser();
			$add=$Teamuser->_add($_SESSION["USERID"],$_SESSION["TEAMID"],-1);
			echo $add;
		}
		
		public function _teamupdate()
		{
		$Teaminformation=new teaminformation();
		echo	$Teaminformation->_updateteamname($_SESSION["TEAMID"],$_POST['teamname'],$_SESSION["USERID"]);
		echo 	$Teaminformation->_updateteamremarks($_SESSION["TEAMID"],$_POST['marks'],$_SESSION["USERID"]);
			
			$information=$Teaminformation->_show($_SESSION["TEAMID"]);
			foreach($information as $r)
			{
			$Teamname=$r->teamname;
			$Marks=$r->teamremarks;
			}
			
			$show="<form name='update' action='teamupdate' method='post'>
			<p>
			<input type='text' name='teamname' value='".$Teamname."'>
			<input type='text' name='marks' value='".$Marks."'>
			<input type=submit name='click2' value='确定'/>
			<input type=reset name='click1' vlaue='重置'/>
			</p>";
			echo $show;
			
		}
		
		public function _teamimage()
		{
			echo "<a href='/information/teamimageadd'>新建</a>";
		}
		
		public function _teamimageadd()
		{
		$Imagegroup=new imagegroup();
		if($_POST['name']!=null)
		{
			echo $Imagegroup->_add($_POST['name'],$_POST['description'],0,$_SESSION["TEAMID"]);
		}
			$show="<form name='update' action='teamimageadd' method='post'>
			<p>
			<input type='text' name='name'>
			<input type='text' name='description'>
			<input type=submit name='click2' value='确定'/>
			<input type=reset name='click1' vlaue='重置'/>
			</p>
			</form>";
			echo $show;
			
		}
		
		
		
	
	}
?>
