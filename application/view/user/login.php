<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login-ACGPIC</title>
<link rel="stylesheet" href="/bootstrap.min.css">
<link rel="stylesheet" href="/bootstrap-image-gallery.min.css">
<link rel="stylesheet" href="/indexstyle.css">
<script src="/jquery-1.6.1.min.js"></script>
<script src="/popup.js"></script>
</head>
<body style="background: url(/1.jpg) no-repeat">
<div id="index" style="height:0px;">
	<div id="header">
	<a href="/"><div class="img"></div></a>
	</div>
</div>
<div id="signin_dialog">

<div id="main">
			<div id="inner-left">
			<h1>登录</h1>
			 <p style="color:white">还没有帐号？<a href=# onClick='top.location.href="/user/register"'>点这里注册</a></p>
			</div>
			<div id="inner" class="inner">
				<form name="login" action="login.php" method="post" >
				  <div>
				  <p>
				  <label>
					用户名:</br>
						  <input type="text" name="username"/>
					</label></p>
					<p>
					<label>
					密码:</br>
						  <input type="password" name="password"/>
					</label>
					</p>
				  </div>
				<p id="password"></p>
				 </br>
				
				 <p><a  class="btn primary start" href=# onclick= "checkon()"> 登录 </a> <a href="/user/findback">呃，密码暂时想不起来了……</a> </p>
			
				  <input type="submit" style="display:none;"/>

				</form>
			</div>
		</div>
</div>
</div>
</body>
</html>