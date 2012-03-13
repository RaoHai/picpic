<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/indexstyle.css">
<title><?php echo $this->values["title"]; ?></title>
</head>
<body>
	<div class="header" style="background-color:black;">
				<a href="/home"><img src="/logo.png" title="主页" style="width:120px;margin-left:10px;"/></a>
				<span class="right_ab">
						<?php if($this->values["user"]) {  ?>
							欢迎回来，<a href="/home" ><b><?php echo $this->values["nickname"]; ?></b></a> <a href="/user/logout">[退出]</a> 
						<?php } else { ?>
							<a href="/user/loginpage?/" >[登录]</a>
							<a href="register.html">[注册]</a>
						<?php } ?>
				</span>
			</div>
			<div style="text-align: right;display: block;position: absolute;float: left;left:50px;">
			<h1 style="width:220px"><?php echo $this->values["groupname"]; ?></h1>
			
			<p>图集作者:<a href='/user/<?php echo $this->values["authorid"]; ?>'>| <?php echo $this->values["authorname"]; ?> |</a></p>
			</div>
			
			<div style="width:60%;min-width:800px;height:600px; margin:10px auto;">
				<div class="am-container" id="am-container">
				<?php echo $this->values["images"]; ?>
				</div>
			</div>
				<div>
				评论：
				</div>
		</div>
		<script src="/jquery.min.js"></script>
	
</body>
</html>