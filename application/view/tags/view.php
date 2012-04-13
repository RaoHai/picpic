<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/bootstrap.new.css">
<link rel="stylesheet" href="/bootstrap-image-gallery.min.css">
<link rel="stylesheet" href="/indexstyle.css">
<link rel="stylesheet" type="text/css" href="/jquery.tagsinput.css" />
<title><?php echo $this->values["title"]; ?></title>
</head>
<body style="background-color: #565656;">
	<div class="header" style="background-color:black;">
				<a href="/"><img src="/logo.png" title="主页" style="width:120px;margin-left:10px;"/></a>
				<span class="right_ab">
						<?php if($this->values["user"]) {  ?>
							<a href="/home" ><b><?php echo $this->values["nickname"]; ?></b></a> <a href="/user/logout">[退出]</a> 
						<?php } else { ?>
							<a href="/user/loginpage?/" >[登录]</a>
							<a href="register.html">[注册]</a>
						<?php } ?>
				</span>
	</div>
			<div style="width:80%;margin: auto;">
			<div style="width:100%;float:left;">
            <input id="currentgroupid" style="display:none;" value='<?php echo $this->values["groupid"]; ?>'></input>
			<h1><?php echo $this->values["groupname"]; ?></h1>
			<div style="width:220px;color:white"><?php echo $this->values["groupdesc"]; ?></div>
			</div>
			
			<div style="width:100%;min-width:800px; margin:10px auto;float:left;">
				<div class="am-container" id="am-container" style="float:left;">
				<?php echo $this->values["images"]; ?>
				</div>
			</div>
				<div  style="width:100%;min-width:800px;margin:10px auto;">
								</div>

		<div id="gallery-loader"></div>
<!-- gallery-modal is the modal dialog used for the image gallery -->
<div id="gallery-modal" class="modal hide fade">
    <div class="modal-header">
        <a href="#" class="close">&times;</a>
        <h3 class="title"></h3>
		<input class = "imgid" id="edimgname" name="edimgname" style="display:none"/>
    </div>
    <div style="float:left;"><div class="modal-body" style="float:left;"></div><div style="float:right;width:140px;height:auto;">
    图片标签：
    <div class="imgtags">
    <input id="tags_1" type="text" class="tags" value="" /></p>
    </div>
</div></div>
    <div class="modal-footer">
		<p id="imgdesc" style="float:left;width:auto;"></p>
        <a class="btn btn-primary next"><i class="icon-arrow-right icon-white"></i>下一张</a>
        <a class="btn btn-info prev"><i class="icon-arrow-left icon-white"></i>上一张</a>
        <a class="btn btn-success download" target="_blank"><i class="icon-download icon-white"></i>下载</a>
    </div>
</div>
		<script src="/jquery.min.js"></script>
		<script src="/jquery.montage.js"></script>
		<script src="/vendor/jquery.ui.widget.js"></script>
		<script src="/load-image.min.js"></script>
		<script src="/bootstrap-modal.min.js"></script>
		<script src="/bootstrap-image-gallery.min.js"></script>
        <script src="/jquery-infoAndFavorites/jquery-infoAndFavorites2.js" ></script>
        <script type="text/javascript" src="/jquery.tagsinput.js"></script>

<script type="text/javascript">

$(function() {
	$('#tags_1').tagsInput({width:'auto','maxChars' : 5,'interactive':false,'placeholderColor' : '#09F' });

  // Initialize the Bootstrap Image Gallery plugin:
$('#am-container').imagegallery();			
$('#am-container .imginfo').favor(
            {
              title:false,
              linkto:false,
              width:240,
              height:160,
              margin:8,
              link:"<a rel='gallery'></a>"
            }); 



});
</script>

</body>
</html>
