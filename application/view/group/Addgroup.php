<!DOCTYPE HTML>
<!--
/*
 * jQuery File Upload Plugin Demo 6.0.4
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */
-->

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->values["title"]; ?></title>
<!--
    The Bootstrap CSS is not required, but included for the demo.
    However, the FileUpload user interface waits for CSS transition events in several callbacks,
    if a "fade" class is present. These CSS transitions are defined by the Bootstrap CSS.
    If it is not included, either remove the "fade" class from the upload/download templates,
    or define your own "fade" class with CSS transitions.
-->
<link rel="stylesheet" href="/bootstrap.min.css">
<link rel="stylesheet" href="/bootstrap-image-gallery.min.css">
<link rel="stylesheet" href="/indexstyle.css">
<!--[if lt IE 7]><link rel="stylesheet" href="http://blueimp.github.com/Bootstrap-Image-Gallery/bootstrap-ie6.min.css"><![endif]-->
<link rel="stylesheet" href="/jquery.fileupload-ui.css">
</head>
<body>
<div id="index">
<div id="header">
		<div id="hd-link">
						<?php if($this->values["user"]) {  ?>
							欢迎回来，<a href="/home" ><?php echo $this->values["nickname"]; ?></a> <a href="/user/logout">[退出]</a>
						<?php } else { ?>
							<a href="/user/loginpage?/" >[登录]</a>
							<a href="/user/register">[注册]</a>
						<?php } ?>
						

		</div>

		<a href="/"><div class="img"></div></a>
		<div class="nav">
			<ul id="logonav">
				<li id="nv-hm">
					<a href="/home"  >我的Pic</a>
				</li>
				<li id="nv-cv">
					<a href="/cover">发现</a>
				</li>
				<li id="nv-group">
					<a href="/group"  style="border-bottom: 4px solid #09f;color:#09f;">小组</a>
				</li>	
				<li id="nv-recom">
					<a href="/recommend">推荐</a>
				</li>
				<li id="nv-search">
				<a>
					<form action="/search" class="clearfix" id="search_box" method="get">
					  <label> 
						<input id="search_field" name="search_field" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;" size="40" type="text" value="图片/作者/画集" /> 
						  <button class="topsearch-sub" type="submit">找一找</button>
					  </label>
					</form> 
				</a>
				</li>
			</ul>
		</div>
	</div>
	</br>
	
	<form action="index.php" method="post">
		<p>群名<input id="groupname" name="groupname"size="40" type="text" /> </p>
		
		<p>备注<textarea name="groupremarks" id="groupremarks" ></textarea></p>
	</form>	
		<p><button id="groupadd">确定</button></p>
	 
	
	<div id="addpass" style="text-align:center;display:none;">    <h4 style="color:red;">成功加入</h4></div>
</div>	

<script src="/jquery.min.js"></script>
<script src="/application1.js"></script>

<script>
  $(document).ready(function(){
  $("#groupadd").click(function(){
  $.ajax({
	  type: 'POST',
	  url: '/group/Add_groups',
	  data: "groupname="+$("#groupname").val()+"&groupremarks="+$("#groupremarks").val(), 
	  success: function(msg){
		$("#addpass").show("fast");
				}
		});
  });
  });
  
</script>
<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE8+ -->
<!--[if gte IE 8]><script src="cors/jquery.xdr-transport.js"></script><![endif]-->
</body> 
</html>