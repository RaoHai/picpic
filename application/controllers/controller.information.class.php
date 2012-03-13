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
		
		public function _index()//自定义你的action方法
		{
		$User = new user();
		$Profile = new profile();		
		$this->showinformation();
		
		if($_POST["sex"]!=null)
		{
			$Profile->_updatesex($_POST['sex']);
		}
		if($_POST["blood"]!=null)
		{
			$Profile->_updateblood($_POST['blood']);
		}
		if($_POST['birthyear']!=null&&$_POST['birthmonth']!=null&&$_POST['birthday']!=null)
		{
			$Profile->_updatebirthday($_POST['birthday'],$_POST['birthmonth'],$_POST['birthyear']);
		}
			$file="..\upload\avatar_small\\".$_SESSION["USERID"]."_small.jpg";
			if(file_exists($file))
				$file="..\upload\avatar_small\_small.jpg";	

			$showuser=$User->_getuser();
			$showprofile=$Profile->_getprofile();
			$showsex='';
			if($showprofile['sex']==1)
			$showsex='男';
			if($showprofile['sex']==2)
			$showsex='女';
			if($showprofile['sex']==3)
			$showsex='无性别？';
			
			$showblood='';
			if($showprofile['blood']==1)
			$showblood='A';
			if($showprofile['blood']==2)
			$showblood='B';
			if($showprofile['blood']==3)
			$showblood='AB';
			if($showprofile['blood']==4)
			$showblood='O';
			
			$show='	
			<a href="../upload/index.php"><img src="'.$file.'"/></a>
			<p>用户名：  '.$showuser['username'].'</p>
			<a  href="/information/update"  onclick= "" >编辑资料</a>
			<p>性别：	 '.$showsex.'</p>
			<p>血型：	 '.$showblood.'</p>
			<p>邮箱：    '.$showuser['email'].'</p>
			<p>生日：    '.$showprofile['birthday'].'</p>
			';
			//echo '<link rel="stylesheet" href="/bootstrap.min.css">';

			echo $show;
					
		}
		
		public function _update()
		{
		$User = new user();
		$Profile = new profile();
		
		$User->model->Get_By_UserId($_SESSION["USERID"]);
		$re=$User->model->getresult();
		foreach($re as $r)
		{
			$username=$r->UserName;
			$showemail=$r->email;
		}
		
		$showprofile=$Profile->_getprofile();
		
			$file="..\upload\avatar_small\\".$_SESSION["USERID"]."_small.jpg";
			if(file_exists($file))
				$file="..\upload\avatar_small\_small.jpg";		
				
			$show1=' <input type="radio" name="sex" value="1" /> 男
					 <input type="radio" name="sex" value="2" /> 女
					 <input type="radio" name="sex" value="3" /> 无性别？';	
			if($showprofile['sex']==1)
			$show1=' <input type="radio" name="sex" value="1" checked/> 男
								 <input type="radio" name="sex" value="2" /> 女
								 <input type="radio" name="sex" value="3" /> 无性别？';
			if($showprofile['sex']==2)
			$show1=' <input type="radio" name="sex" value="1" /> 男
								 <input type="radio" name="sex" value="2" checked/> 女
								 <input type="radio" name="sex" value="3" /> 无性别？';
			if($showprofile['sex']==3)
			$show1=' <input type="radio" name="sex" value="1" /> 男
								 <input type="radio" name="sex" value="2" /> 女
								 <input type="radio" name="sex" value="3" checked/> 无性别？';

			$show2='
					<option value="">血型</option>
					<option value="1">A</option>
					<option value="2">B</option>
					<option value="3">AB</option>
					<option value="4">O</option>';
			if($showprofile['blood']==1)	
			$show2='
					<option value="">血型</option>
					<option value="1" selected>A</option>
					<option value="2">B</option>
					<option value="3">AB</option>
					<option value="4">O</option>';
			if($showprofile['blood']==2)	
			$show2='
					<option value="">血型</option>
					<option value="1">A</option>
					<option value="2" selected>B</option>
					<option value="3">AB</option>
					<option value="4">O</option>';
			if($showprofile['blood']==3)	
			$show2='
					<option value="">血型</option>
					<option value="1">A</option>
					<option value="2">B</option>
					<option value="3" selected>AB</option>
					<option value="4">O</option>';
			if($showprofile['blood']==4)	
			$show2='
					<option value="">血型</option>
					<option value="1">A</option>
					<option value="2">B</option>
					<option value="3">AB</option>
					<option value="4" selected>O</option>';
				
			$show3='<option value="">年</option>';
			for($i=2011;$i>=1935;$i--)
			{
			if($i==intval(substr($showprofile['birthday'],0,(strcspn ($showprofile['birthday'],"/") ) ) ) )
			$show3=$show3.'<option value="'.$i.'" selected>'.$i.'</option>';
			else
			$show3=$show3.'<option value="'.$i.'">'.$i.'</option>';
			}

			$show4='<option value="">月</option>';
			$a=substr($showprofile['birthday'],(strcspn ($showprofile['birthday'],"/") +1) ) ;
			for($i=1;$i<=12;$i++)
			{
			if($i==intval( substr($a,0,(strcspn($a,"/")) )))
			$show4=$show4.'<option value="'.$i.'" selected>'.$i.'</option>';
			else
			$show4=$show4.'<option value="'.$i.'">'.$i.'</option>';
			}

			$show5='<option value="">日</option>';
			$b=substr($a,(strcspn($a,"/")+1) ) ;
			for($i=1;$i<=31;$i++)
			{
			if($i==intval( substr($b,0,(strcspn($b,"/")) )))
			$show5=$show5.'<option value="'.$i.'" selected>'.$i.'</option>';
			else
			$show5=$show5.'<option value="'.$i.'">'.$i.'</option>';
			}


			$show='
			<script language="javascript" type="text/javascript">
			function showbirthday()
			{
				var number=parseInt(document.forms["user"].elements["birthyear"].value);
				var dayoption1=new Option("29","29");
				var dayoption2=new Option("30","30");
				var dayoption2=new Option("31","31");
				if(document.forms["user"].elements["birthmonth"].value=="2")
				{
				document.getElementById("birthday").remove(31);
				document.getElementById("birthday").remove(30);
				document.getElementById("birthday").remove(29);
				if(number%4==0)
				{
				document.getElementById("birthday").add(dayoption1,29);
				}
				}
				else
				{
			
					if(document.getElementById("birthday").length==29)
					document.getElementById("birthday").add(dayoption1,29);
					if(document.getElementById("birthday").length==30)
					document.getElementById("birthday").add(dayoption2,30);
					if(document.getElementById("birthday").length==31)
					document.getElementById("birthday").add(dayoption3,31);
					if(document.forms["user"].elements["birthmonth"].value=="4" || document.forms["user"].elements["birthmonth"].value=="6" || document.forms["user"].elements["birthmonth"].value=="9" || document.forms["user"].elements["birthmonth"].value=="11" )
					document.getElementById("birthday").remove(31);
				}
			}
			</script>
			<div>
			<a href="../upload/index.php"><img src="'.$file.'"/></a>
			<form name="user" action="index" method="post" >
				<p>性别：	'.$show1.'</p>
			<p><select name="blood" id="blood" >'.$show2.'</select></p>
			<select name="birthyear" id="birthyear" tabindex="1" onchange="showbirthday();">'.$show3.'</select>
				<select name="birthmonth" id="birthmonth" onchange="showbirthday();" tabindex="1">
				'.$show4.'
				</select>
				<select name="birthday" id="birthday"  tabindex="1">
				'.$show5.'
				</select>
				<span id="password"></span> 		
			<p><input type=submit name="click2" value="确定"/>
			<input type=reset name="click1" vlaue="重置"/></p>
			</form>';
			
			
			
			echo $show;
		}
		
		public function _friend()
		{
		$User = new user();
		$Profile = new profile();	
		$Friend = new friend();
		
		$this->showinformation();
		
		$show="<form name='addfriend' action='friend' method='post' >
				<p><input type='text' name='friendid' />
				<input type=submit name='click2' value='确定'/>
				<input type=reset name='click1' vlaue='重置'/></p>";			
			
				
				if($_POST['friendid']!=null)
				$show=$show.$Friend->_Addfriend($_POST['friendid']);
				/*
				if($_GET['delete'])
				{
				$imgView->deletefriend($_GET['delete']);
				}*/
				
				
		$Friend->_getfriend();
			echo $show;
		}
		
	}
?>