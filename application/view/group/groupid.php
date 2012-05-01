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
	<?php echo $this->values["picture"]; ?>
	<div id="group_information">
	<?php echo $this->values["groupname"]; ?>
	</div>
	<div id="group_information">
	<?php echo $this->values["groupdescription"]; ?>
	</div>
	<?php if($this->values["permissions"]<0 || $this->values["permissions"]==null) {  ?>
	<button class="btn" id="group_add">
	加入
	</button>
	<div id="addpass" style="text-align:center;display:none;">    <h4 style="color:red;">成功加入</h4></div>
	<?php } ?>
	</div>
	<div>
	<?php if($this->values["permissions"]>=0 && $this->values["permissions"]!=null) {  ?>
	<a href='/group/imagegroup'>群画集</a>
	<button data-controls-modal="modal-from-dom-update" data-backdrop="true" data-keyboard="true" class="btn"style="margin-top: 4px;margin-left:20px;">修改信息</button>
	<button data-controls-modal="modal-from-dom-activity" data-backdrop="true" data-keyboard="true" class="btn"style="margin-top: 4px;margin-left:20px;">添加活动</button>
	<button class="btn" id="group_out">
	退出
	</button>
	<div id="outpass" style="text-align:center;display:none;">    <h4 style="color:red;">成功退出</h4></div>
	<?php } ?>
	</div>
</div>



<div id="">
	<div id="">
	<?php echo $this->values["activity"]; ?>
	</div>
</div>


</div>	

<div id="modal-from-dom-update" class="modal hide fade" style="width:650px;margin-top:-300px;">
			<div class="modal-header" style="background-color:#339BB9;">
              <a href="#" class="close">&times;</a>
              <h3 style="color:white;">修改信息</h3>
            </div>
			<div id="groupnotice1" style="text-align:center;display:none;">    <h4 style="color:red;">修改成功</h4></div>
			<div class="modal-body">
				 <form id="imggroupnew" name="imggroupnew" action="/group/imagegroupadd" method="POST" enctype="multipart/form-data">
				<p>名称：<input name="groupnewname" id="groupnewname" value="<?php echo $this->values["groupname"]; ?>"/></p></br>
				<p>描述：<textarea name="groupnewdescription" id="groupnewdescription" value="<?php echo $this->values["groupdescription"]; ?>"><?php echo $this->values["groupdescription"]; ?></textarea></p></br>
			  </form>
            </div>
			<div class="modal-footer">
              <a href="#" class="btn primary" id="group_information_submit" >修改</a>
              
            </div>
			
</div>

<div id="modal-from-dom-activity" class="modal hide fade" style="width:650px;margin-top:-300px;">
			<div class="modal-header" style="background-color:#339BB9;">
              <a href="#" class="close">&times;</a>
              <h3 style="color:white;">添加活动</h3>
            </div>
			<div id="groupnotice2" style="text-align:center;display:none;">    <h4 style="color:red;">添加成功</h4></div>
			<div class="modal-body">
				 <form id="imggroupnew" name="imggroupnew" action="/group/activityadd" method="POST" enctype="multipart/form-data">
				<p>名称：<input name="activityname" id="activityname" /></p></br>
				<p>描述：<textarea name="activitydescription" id="activitydescription"></textarea></p></br>
			  </form>
            </div>
			<div class="modal-footer">
              <a href="#" class="btn primary" id="group_activity_submit" >添加</a>
              
            </div>
			
</div>

<div id="modal-from-avatar" class="modal hide fade" style="width:650px;margin-top:-300px;">
            <div class="modal-header" style="background-color:#339BB9;">
              <a href="#" class="close">&times;</a>
              <h3 style="color:white;">更改头像</h3>
            </div>
			<div id="groupnotice" style="text-align:center;display:none;">    <h4 style="color:red;">修改成功！</h4></div>
            <div class="modal-body" style="float:left;">

		<div style="padding:10px 0;color:#666;">
		上传一张图片，或者  <a style="color:#cc3300;" href="javascript:void(0);" onclick="useCamera()">使用摄像头</a>
		</div>
		<form enctype="multipart/form-data" method="post" name="upform" target="upload_target" action="/upload/upload.php">
		<input type="file" name="Filedata" id="Filedata"/>
		<input style="margin-right:20px;" type="submit" name="" value="上传形象照" onclick="return checkFile();" /><span style="visibility:hidden;" id="loading_gif"><img src="/upload/loading.gif" align="absmiddle" />上传中，请稍侯......</span>
		</form>
		<iframe src="about:blank" name="upload_target" style="display:none;"></iframe>
		<div id="avatar_editor"></div>
		
		
		
		
		
		<script type="text/javascript">
		//允许上传的图片类型
		var extensions = 'jpg,jpeg,gif,png';
		//保存缩略图的地址.
		var saveUrl = '/upload/save_avatar.php';
		//保存摄象头白摄图片的地址.
		var cameraPostUrl = '/upload/camera.php';
		//头像编辑器flash的地址.
		var editorFlaPath = '/upload/AvatarEditor.swf';

		function useCamera()
		{
			var content = '<embed height="464" width="514" ';
			content +='flashvars="type=camera';
			content +='&postUrl='+cameraPostUrl+'?&radom=2';
			content += '&saveUrl='+saveUrl+'?radom=2" ';
			content +='pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" ';
			content +='allowscriptaccess="always" quality="high" ';
			content +='src="'+editorFlaPath+'"/>';
			document.getElementById('avatar_editor').innerHTML = content;
		}
		function buildAvatarEditor(pic_id,pic_path,post_type)
		{
			var content = '<embed height="464" width="514"'; 
			content+='flashvars="type='+post_type;
			content+='&group=1';
			content+='&photoUrl='+pic_path;
			content+='&photoId='+pic_id;
			content+='&postUrl='+cameraPostUrl+'?&radom=2';
			content+='&saveUrl='+saveUrl+'?radom=2"';
			content+=' pluginspage="http://www.macromedia.com/go/getflashplayer"';
			content+=' type="application/x-shockwave-flash"';
			content+=' allowscriptaccess="always" quality="high" src="'+editorFlaPath+'"/>';
			document.getElementById('avatar_editor').innerHTML = content;
		}
		
			/**
			  * 提供给FLASH的接口 ： 没有摄像头时的回调方法
			  */
			 function noCamera(){
				 alert("未找到摄像头");
			 }
					
			/**
			 * 提供给FLASH的接口：编辑头像保存成功后的回调方法
			 */
			function avatarSaved(){
				alert('保存成功.');
				$('#avatarshow').html();
				$('#avatarshow').html("<img src='/upload/avatar_small/<?php echo $this->values["users"]; ?>_small.jpg' />");
				$('#dialogclose').click();
				window.location.reload();
				//window.location.href = '/profile.do';
			}
			
			 /**
			  * 提供给FLASH的接口：编辑头像保存失败的回调方法, msg 是失败信息，可以不返回给用户, 仅作调试使用.
			  */
			 function avatarError(msg){
				 alert("上传失败了呀，哈哈");
			 }

			 function checkFile()
			 {
				 var path = document.getElementById('Filedata').value;
				 var ext = getExt(path);
				 
				 var re = new RegExp("(^|\\s|,)" + ext + "($|\\s|,)", "ig");
				  if(extensions != '' && (re.exec(extensions) == null || ext == '')) {
				 alert('对不起，只能上传jpg, gif, png类型的图片');
				 return false;
				 }

				 showLoading();
				 return true;
			 }

			 function getExt(path) {
				return path.lastIndexOf('.') == -1 ? '' : path.substr(path.lastIndexOf('.') + 1, path.length).toLowerCase();
			}
              function	showLoading()
			  {
				  document.getElementById('loading_gif').style.visibility = 'visible';
			  }
			  function hideLoading()
			  {
				document.getElementById('loading_gif').style.visibility = 'hidden';
			  }
</script>

	</div>

				

			

            <div class="modal-footer">
              <a href="#" class="btn primary close" id="dialogclose" style="display:none;">完成</a>


</div>	  
</div>



<script src="/jquery.min.js"></script>
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="/vendor/jquery.ui.widget.js"></script>
<!-- The Templates and Load Image plugins are included for the FileUpload user interface -->
<script src="/tmpl.min.js"></script>
<script src="/load-image.min.js"></script>
<!-- Bootstrap Modal and Image Gallery are not required, but included for the demo -->
<script src="/bootstrap-modal.min.js"></script>
<script src="/bootstrap-image-gallery.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="/jquery.iframe-transport.js"></script>
<script src="/jquery.fileupload.js"></script>
<script src="/jquery.fileupload-ui.js"></script>
<script src="/application1.js"></script>
  
  <script>
  $(document).ready(function(){
  $("#group_add").click(function(){
  $.ajax({
	  type: 'POST',
	  url: '/group/group_add',
	  success: function(msg){ 
	  $('#group_add').css({
              display:"none",
            });
		$("#addpass").show("fast");
		setTimeout(function(){window.location.reload();},1000);
				}
		});
  });
  });
  </script>
  <script>
  
    $(document).ready(function(){
  $("#group_out").click(function(){
  $.ajax({
	  type: 'POST',
	  url: '/group/group_out',
	  data: "groupuserid="+<?php echo $this->values["groupuserid"]; ?>,
	  success: function(msg){ 
	  $('#group_out').css({
              display:"none",
            });
		$("#outpass").show("fast");
		setTimeout(function(){window.location.reload();},1000);
				}
		});
  });
  });
  
  </script>
  
<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE8+ -->
<!--[if gte IE 8]><script src="cors/jquery.xdr-transport.js"></script><![endif]-->
</body> 
</html>