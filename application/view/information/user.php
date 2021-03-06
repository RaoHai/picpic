<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo $this->values["title"]; ?></title>
<link rel="stylesheet" href="/bootstrap.new.css">
<link rel="stylesheet" href="/bootstrap-image-gallery.min.css">
<link rel="stylesheet" href="/indexstyle.css">
<link rel="stylesheet" href="/jquery.ui.datepicker.css">
<link rel="stylesheet" href="/jquery.ui.all.css">

</head>
<body>

<div id="index">
	<div id="header">
		<div id="hd-link">
						<?php if($this->values["user"]) {  ?>
							欢迎回来，<a href="/home" ><?php echo $this->values["nickname"]; ?></a>
                              <a href="/user/message"> <i class="icon-envelope" rel="tooltip" id="newmessage"></i></a>
                              <a href="/user/logout">[退出]</a>
						<?php } else { ?>
							<a href="/user/loginpage?/" >[登录]</a>
							<a href="/user/register">[注册]</a>
						<?php } ?>
						

		</div>

		<a href="/"><div class="img"></div></a>
		<div class="nav">
			<ul id="logonav">
				<li id="nv-hm">
					<a href="/home"  style="border-bottom: 4px solid #09f;color:#09f;">我的Pic</a>
				</li>
				<li id="nv-cv">
					<a href="/cover">发现</a>
				</li>
				<li id="nv-group">
					<a href="/group">小组</a>
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
	<div id="content">
    	<div id="welcome" style="float:left;height:190px;" >
        <h4 style="color:#09F;">更改个人信息</h4>
        </br>
        	<div id="myphoto" style="width:350px;border-bottom: 1px solid #D7EAFB;" ><a data-controls-modal="modal-from-avatar" data-backdrop="true" style="width:120px;overflow:hidden;"><img style="width:120px;max-height:140px;" src="/upload/avatar_big/<?php echo $this->values["userid"]; ?>_big.jpg" title="点击以更改头像"/></a>

			<div style="float:right;width:220px;">
			<p><h3><b style="color:#09F;"><?php echo $this->values["nickname"]; ?></b></h3></p>
上传头像让大家更快认识您。 
选择喜欢的图片作为您的头像：
            <a data-controls-modal="modal-from-avatar" data-backdrop="true" class="btn btn-primary" style="width:120px;overflow:hidden;">上传头像</a>
 
			</div>
            </div>
            </div>
            <div>
            <table id="usertable" class="tableform" cellspacing="0" cellpadding="0">
             <colgroup width="142"></colgroup>
              <colgroup width="600"></colgroup>
              <tr>
                <th><b>用户名: </b></th><td> <?php echo $this->values["nickname"]; ?> </td>
              </tr>
              <tr>
              <form action="/information/save/" method="POST">
               <th><b>性别：</b></th> 
               <td>  <input id="gender-0"  type="radio" name="gender" value="0"><label id="tabs" for="gender-0">女</label>
	  <input id="gender-1" type="radio" name="gender" value="1"><label id="tabs" for="gender-1">男</label> 
	  <input id="gender-2" type="radio" name="gender" value="2" checked=""><label id="tabs" for="gender-2">保密</label> 
              </td>
              </tr>
              <tr>
              <th><b>生日：</b></th>
              <td>
                <input type="text" id="datepicker" name="birth" value="<?php echo $this->values["birth"]; ?>" />
              </td>
              </tr>
              <tr>
              <th><b>签名：</b></th>
              <td>
                <textarea name="desc"><?php echo $this->values["desc"]; ?></textarea>
              </td>
              </tr>
              <tr><th></th>
              <td><input type="submit" class="btn btn-primary"/></td></tr>
            </form>
            </table>
    </div>
	<div id="footer">
		<p>©Copyright by surgesoft, 2011,all rights reserved</p>
		<p>收集工具|关于我们|帮助</p>
	</div>
	</div>

<div id="modal-send-message" class="modal hide fade">
            <div class="modal-header">
              <a href="#" class="close">&times;</a>
              <h3>写信息</h3>
            </div>
			<div id="edgroupnotice" style="text-align:center;display:none;">    <h4 style="color:red;">设置成功</h4></div>
            <div class="modal-body">
				 <form id="msgsend" name="msgsend" action="/message/send" method="POST" enctype="multipart/form-data">
                <p>收信人：<input name="reciverid" id="reciverid" /></p></br>
				<p>标题：<input name="msgtitle" id="msgtitle"/></p></br>
				<p>内容：<textarea name="msgcontext" id="msgtext" style="width:400px;height:200px;"></textarea></p></br>
			  </form>
            </div>

            <div class="modal-footer">
              <a href="#" class="btn btn-primary" id="msgsendr" >发送</a>
           
            </div>
          </div>
    
		 <!--编辑头像 -->
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
			content +='&postUrl='+cameraPostUrl+'?&radom=1';
			content += '&saveUrl='+saveUrl+'?radom=1" ';
			content +='pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" ';
			content +='allowscriptaccess="always" quality="high" ';
			content +='src="'+editorFlaPath+'"/>';
			document.getElementById('avatar_editor').innerHTML = content;
		}
		function buildAvatarEditor(pic_id,pic_path,post_type)
		{
			var content = '<embed height="464" width="514"'; 
			content+='flashvars="type='+post_type;
			content+='&photoUrl='+pic_path;
			content+='&photoId='+pic_id;
			content+='&postUrl='+cameraPostUrl+'?&radom=1';
			content+='&saveUrl='+saveUrl+'?radom=1"';
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
    </div>
    <script src="/jquery.min.js"></script>
    <script src="/jquery.ui.core.js"></script>
	<script src="/jquery.montage.js"></script>
		<script src="/vendor/jquery.ui.widget.js"></script>
		<script src="/bootstrap-modal.min.js"></script>
        <script src="/bootstrap-tooltip.js"></script>
        <script src="/popup.js"></script>
        <script src="/jquery.ui.datepicker.js"></script>
<script>
	$(function() {
		$( "#datepicker" ).datepicker({
			changeMonth: true,
			changeYear: true
		});
        $('#gender-<?php echo $this->values["gender"]; ?>').attr("checked",1);
	});
	</script>
        
     </body>
</html>
