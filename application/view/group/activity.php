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
<body > 
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
					<form action="index.php" class="clearfix" id="search_box" method="get">
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
	
<div id="groupoffer" value="<?php echo $this->values["commentindex"]; ?>">
<?php echo $this->values["commentshow"]; ?>
</div>
<div id="comment-numbers">
<?php echo $this->values["commentnumber"]; ?>
</div>	
<?php if($this->values["permissions"]>=0 && $this->values["permissions"]!=null) {  ?>
<div>
	<div style="width:640px;height:110px;">
	<div id="recive">
	<div>
	<textarea id="activityrecive"></textarea></br>
	<button id="groupactivity" class='btn primary start' style='float:right;margin-top:2px;' value=<?php echo $this->values["groupactivity"]; ?> >发布</button>
	</div>
	<div style='margin-left:40px;'>
	</div>
</div>
<?php } ?>


<script src="/jquery.min.js"></script>
<script src="/application1.js"></script>
  <script>
    $('img').ajaxtip({
html:$('#showup'),
datasource:'/group/welcome'
        });
  </script>
  
  <script>
  
  $(document).ready(function(){  
  $("#groupactivity").click(function(){
  var date=new Date();
	  $.ajax({
	  type: 'POST',
	  url: '/group/activityshow',
	  data:"activityrecive="+$("#activityrecive").val()+"&groupactivity="+$("#groupactivity").val(),
	  success: function(msg){ 
			$("#groupoffer").append(msg); 
			$("#activityrecive").val("");
				}
	  });
  });
  });
  </script>

<script>
var _move;
var mouse;
  
  $("#groupoffer").mousedown(function(e){
  mouse=e.pageX;
  _move=true;
  }).mousemove(function(e){
  if(_move)
  {
  if(e.pageX-mouse>10)
  index=parseInt($("#groupoffer").attr("value"))-10;
  if(e.pageX-mouse<-10)
  index=parseInt($("#groupoffer").attr("value"))+10;
  if(e.pageX-mouse<-10 || e.pageX-mouse>10)
  $.ajax({
	type: 'POST',
	  url: '/group/commentindex',
	  data:"comment_index="+index,
	  success: function(msg){ 
	  if(msg!='false')
	  {
		$("#groupoffer").empty();
			$("#groupoffer").append(msg); 
			$("#groupoffer").attr("value",index);
			}
			_move=false;
				}
	});  
	 
  
  }
    
	}).mouseup(function(e){_move=false});
	
</script>
<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE8+ -->
<!--[if gte IE 8]><script src="cors/jquery.xdr-transport.js"></script><![endif]-->

</body> 
</html>