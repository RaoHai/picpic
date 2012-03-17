<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/bootstrap.min.css">
<link rel="stylesheet" href="/bootstrap-image-gallery.min.css">
<link rel="stylesheet" href="/indexstyle.css">

<title><?php echo $this->values["title"]; ?></title>
</head>
<body>
	<div class="header" style="background-color:black;">
				<a href="/home"><img src="/logo.png" title="主页" style="width:120px;margin-left:10px;"/></a>
				<span class="right_ab">
						<?php if($this->values["user"]) {  ?>
							<a href="/home" ><b><?php echo $this->values["nickname"]; ?></b></a> <a href="/user/logout">[退出]</a> 
						<?php } else { ?>
							<a href="/user/loginpage?/" >[登录]</a>
							<a href="register.html">[注册]</a>
						<?php } ?>
				</span>
	</div>
			<div >
			<div style="text-align: right;display: block;position: absolute;float: left;left:50px;top:50px;">
			<input id="currentgroupid" style="display:none;" value='<?php echo $this->values["groupid"]; ?>'></input>
			<h1><?php echo $this->values["groupname"]; ?></h1>
			<div style="margin-top:-20px;width:220px;"><?php echo $this->values["groupdesc"]; ?></div>
			<p>图集作者:<a href='/user/<?php echo $this->values["authorid"]; ?>'>| <?php echo $this->values["authorname"]; ?> |</a></p>
			</div>
			
			<div style="width:60%;min-width:800px; margin:10px auto;">
				<div class="am-container" id="am-container">
				<?php echo $this->values["images"]; ?>
				</div>
			</div>
				<div  style="width:60%;min-width:800px;margin:10px auto;">
				评论：
				<div id="comments_text"></div>
				<!--<link rel="stylesheet" type="text/css" href="/markitup/markitup/skins/markitup/style.css" /> <!--  -->
				<!--<link rel="stylesheet" type="text/css" href="/markitup/markitup/sets/bbcode/style.css" /><!-- -->

				<form id="comments_form"action="/imagegroup/savecomments?Groupid=<?php echo $this->values["groupid"]; ?>" method="post">
					<textarea id="cmeditor" name="comments" cols="80" rows="20" style="width:800px;"></textarea>
			
				<button id="comments_bt1" type="button" class="btn primary start" >提交评论</button>
			</form>
			
				</div>
				</div>

		<div id="gallery-loader"></div>
<!-- gallery-modal is the modal dialog used for the image gallery -->
<div id="gallery-modal" class="modal hide fade">
    <div class="modal-header">
        <a href="#" class="close">&times;</a>
        <h3 class="title"></h3>
		<input class = "imgname" id="edimgname" name="edimgname" style="display:none"/>
    </div>
    <div class="modal-body"></div>
    <div class="modal-footer">
		<p id="imgdesc" style="float:left;width:auto;"></p>
        <a class="btn primary next">下一张</a>
        <a class="btn info prev">上一张</a>
        <a class="btn success download" target="_blank">下载</a>
    </div>
</div>
		<script src="/jquery.min.js"></script>
		<script type="text/javascript" src="/jquery.montage.js"></script>
		<script src="/vendor/jquery.ui.widget.js"></script>
		<script src="/load-image.min.js"></script>
		<script src="/bootstrap-modal.min.js"></script>
		<script src="/bootstrap-image-gallery.min.js"></script>
		<script charset="utf-8" src="/editor/kindeditor-min.js"></script>
		<script charset="utf-8" src="/editor/lang/zh_CN.js"></script>
			<script>
					var editor;
					KindEditor.ready(function(K) {
						editor = K.create('#cmeditor', {
							resizeType : 0,
							allowPreviewEmoticons : true,
							allowImageUpload : false,
							resizeMode : 0,
							items : [
								'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
								'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
								'insertunorderedlist', '|', 'emoticons', 'image', 'link']
						});
					});
					
				$('#comments_bt1').click(
				function(){
					var xhtml=editor.html();
					if(editor.count()<10)
					{
						alert("多写点字会死么- -！");
						return;
					}
					if(editor.count()>500)
					{
						alert("评论请言简意赅- -！");
						return;
					}
					$('#comments_text').html(" ");
					$.getJSON($('#comments_form').prop('action'),{str:xhtml}, function (files) {
							editor.html("提交成功！");
								$.getJSON("/imagegroup/showcomments/"+$("#currentgroupid").val(), function(result) {
							  $.each(result, function(i, field){
									 $('#comments_text').append("<div id='comments_replay'><div><a  style='color:blue;' href='/user/"+field.userid+"'>"+field.username+ ":</a>"+field.text
									 +"</div><div>"+field.time+"</div></div>");
								});
						});
						});
				});
				$(document).ready(function(){
					$.getJSON("/imagegroup/showcomments/"+$("#currentgroupid").val(), function(result) {
							  $.each(result, function(i, field){
									 $('#comments_text').append("<div id='comments_replay'><div><a  style='color:blue;' href='/user/"+field.userid+"'>"+field.username+ ":</a>"+field.text
									 +"</div><div>"+field.time+"</div></div>");
								});
						});
				});
				</script>
		<script type="text/javascript">
				
	
			$(function() {
				 
				
				var $container 	= $('#am-container'),
					$imgs		= $container.find('img').hide(),
					totalImgs	= $imgs.length,
					cnt			= 0;
				
				$imgs.each(function(i) {
					var $img	= $(this);
					$('<img/>').load(function() {
						++cnt;
						if( cnt === totalImgs ) {
							$imgs.show();
							$container.montage({
								liquid 	: false,
								fillLastRow : true
							});
							
							/* 
							 * just for this demo:
							 */
							$('#overlay').fadeIn(500);
						}
					}).attr('src',$img.attr('src'));
				});
					
				// Initialize the Bootstrap Image Gallery plugin:
				$('#am-container').imagegallery();			

				
				
			});
		</script>
	
</body>
</html>