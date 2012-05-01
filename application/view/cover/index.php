<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo $this->values["title"]; ?></title>
<link rel="stylesheet" href="/bootstrap.new.css">
<link rel="stylesheet" href="/bootstrap-image-gallery.min.css">
<link rel="stylesheet" href="/indexstyle.css">
<link rel="stylesheet" type="text/css" href="/jquery.tagsinput.css" />
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
					<a href="/home"  >我的Pic</a>
				</li>
				<li id="nv-cv">
					<a href="/cover" style="border-bottom: 4px solid #09f;color:#09f;">发现</a>
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
    <div style="width:100%"><h3>最多收藏：</h3>
    <hr width=100%;size=2;></div>
    <div class="tagsinput" style="width:235px;">热门标签：<hr> <?php echo $this->values["tags"]; ?></div>
    <?php echo $this->values["images"]; ?>
	</div>
	<div id="footer">
		<p>©Copyright by surgesoft, 2011,all rights reserved</p>
		<p>收集工具|关于我们|帮助</p>
	</div>
	</div>

<!-- gallery-modal is the modal dialog used for the image gallery -->
<div id="gallery-modal" class="modal hide fade">
  <div class="modal-header">
    <a href="#" class="close">&times;</a>
    <h3 class="title"></h3>
    <input class = "imgid" id="edimgname" name="edimgname" style="display:none"/>
  </div>

  <div style="float:left;">
    <div  class="modal-body" >
    </div>
    <div class="modal-footer" style="width:auto;height:100%;" >
      <p id="imgdesc" style="float:left;width:auto;"></p>
      <a class="btn btn-primary next"><i class="icon-arrow-right icon-white"></i>下一张</a>
      <a class="btn btn-info prev"><i class="icon-arrow-left icon-white"></i>上一张</a>
      <a class="btn btn-success download" target="_blank"><i class="icon-download icon-white"></i>下载</a>
    </div>
  </div>
  <div style="float:right;width:140px;min-height:100%;margin-top:20px;">
    图片标签：
    <div class="imgtags">
      <input id="tags_1" type="text" class="tags" value="" /></p>
    </div>
    他们收藏了该图片：
    <div id="favored">
    </div></div>
</div>
<?php if($this->values["page"]) {  ?>
<button id="page-switcher-start" title="上一页" class="page-switcher custom-appearance" tabindex="2" style="width: 73px; left: 0px; top: 0px; padding-bottom: 0px; ">‹
</button>
<?php } ?>
<button id="page-switcher-end" title="下一页" class="page-switcher custom-appearance" tabindex="2" style="width: 121.875px; right: 13px; top: 0px; padding-bottom: 0px; ">›
</button>


    <script src="/jquery.min.js"></script>
		<script src="/jquery.montage.js"></script>
		<script src="/vendor/jquery.ui.widget.js"></script>
		<script src="/load-image.min.js"></script>
    	<script src="/jquery.montage.js"></script>
        <script src="/bootstrap-tooltip.js"></script>
        <script src="/bootstrap-image-gallery.min.js"></script>
        <script src="/bootstrap-modal.min.js"></script>
        <script type="text/javascript" src="/jquery.tagsinput.js"></script>
        <script src="/popup.js"></script>
        <script src="/jquery-infoAndFavorites/jquery-infoAndFavorites2.js" ></script>
        <script>
        $('#tags_1').tagsInput({width:'auto','maxChars' : 5,'interactive':false,'placeholderColor' : '#09F' });
        $('#content').imagegallery();	
        $('#content .imginfo').favor(
            {
              title:false,
              linkto:false,
              width:210,
              height:140,
              margin:8,
              link:"<a rel='gallery'></a>"
            }); 
       $('#page-switcher-end').click(function()
           {
             window.location.href="http://localhost/cover/"+(<?php echo $this->values["page"]; ?>+1);
           }); 
        $('#page-switcher-start').click(function()
           {
             window.location.href="http://localhost/cover/"+(<?php echo $this->values["page"]; ?>-1);
           }); 

        </script>

        </body>
</html>
