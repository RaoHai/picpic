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
	<div id="group_back">
		<div id="group_offer">
		<?php echo $this->values["allteam"]; ?>
		<div id="take_take"></div>
		</div>		
		<div id="group_find">
			<div id='group_text'>
			<a href="/group/Addgroup">申请小组</a>
			</div>
		</div>
	</div>
	<button id='group_all_show' class='btn' style='width:620px;float:left;position: relative;left: 16px;' value=<?php echo $this->values["teamID"]; ?>>更多小组</button>
	
	<div id="group_welcomepicture">
	</div>
</div>



 


<script src="/jquery.min.js"></script>
<script src="/application1.js"></script>
<script src="/jquery.scrollTo.js"></script> 
  <script>
  $(document).ready(function(){
  $("#group_all_show").click(function(){
	  $.ajax({
	  type: 'POST',
	  url: '/group/comment-index',
	  data:"group_all_show="+$("#group_all_show").val(),
	  success: function(msg){ 
			//$("<div></div>").html(msg).animate({height:"320px"},"slow").prependTo($("#group_offer"));
			//$(msg).prependTo($("#group_offer")).animate({height:"160px"},"slow");
			$("#group_offer").append(msg)
			$("#group_all_show").val(parseInt($("#group_all_show").val())+4);
			// $.scrollTo('#take_take',1000);
				}
	  });
	  
  });
  
  $("#123").click(function(){
 
  })
  });
  </script>
  
  <script>
    $('img').ajaxtip({
html:$('#group_welcomepicture'),
datasource:'/group/welcome'
        });
	$('img').bind('mouseout',function()
		{
		$('#group_welcomepicture').css(
            {
              display:"none",
            })
		$('#group_welcomepicture').bind('mouseover',function()
			{
          $('#group_welcomepicture').css(
            {
              display:"block",
            })
        });
	});
	$('#group_welcomepicture').bind('mouseleave',function()
			{
          $('#group_welcomepicture').css(
            {
              display:"none",
            })
        });
  </script>
<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE8+ -->
<!--[if gte IE 8]><script src="cors/jquery.xdr-transport.js"></script><![endif]-->
</body> 
</html>