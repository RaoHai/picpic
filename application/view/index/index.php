<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo $this->values["title"]; ?></title>
<link rel="stylesheet" href="/bootstrap.new.css">
<link rel="stylesheet" href="/bootstrap-image-gallery.min.css">
<link rel="stylesheet" href="/indexstyle.css">

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
<?php if($this->values["user"]) {  ?>
<?php } else { ?>
		<div id="welcome">
			<a href="/reg">欢迎信息|注册链接
			<?php echo $this->values["welcome"]; ?></a>
		</div>
<?php } ?>
		<div id="indexshow">
			
				<?php echo $this->values["images"]; ?>
				
		</div>
       		<div id="activeuser">
             <div style="width:100%; border-bottom:dotted 1px #ccc;"><h4 style="color:#09f;">活跃用户>></h4></div>
              <div style="width:100%;margin-top:10px;"> 
            	<?php foreach($this->values["users"] as $usr) {  ?>
                <a href="/user/<?php echo $usr->UserId; ?>"><img src="upload/avatar_small/<?php echo $usr->UserId; ?>_small.jpg"  style="height:50px;"/></a>
               	<?php } ?>
                </div>
		</div>
		<div id="recommand">
		<div id="re-left">
		左列表
		</div>
		<div id="re-right">
        <div style="width:100%;">
        <h4 style="color:#09f;">热门画集>></h4>
        </div>
		 <?php foreach($this->values["cover"] as $f) {  ?> 
        <div style="margin:25px 5px 5px 10px;width:310px;display:block;float:left;">
        <div style="width:100%;"><a href="/imagegroup/<?php echo $f->GroupId; ?>" title="<?php echo $f->Desc; ?>"><h3><?php echo $f->GroupName; ?></h3></a></div>
         <a href="/imagegroup/<?php echo $f->GroupId; ?>" title="<?php echo $f->Desc; ?>" >        <div  style="float:left;width:161px;overflow:hidden;" data-url="">
            <img class="imginfo" src="/medium/<?php echo $f->img[0]; ?>"  style="height:161px;"/>
          </div>
          <div style="margin-left:5px;height:160px;width:133px;">
              <div id="coversmall">
                 <img src="/medium/<?php echo $f->img[1]; ?>"  style="width:133px;"/>
              </div></br>
               <div id="coversmall" style="margin-top:5px;">
              <img src="/medium/<?php echo $f->img[2]; ?>"  style="width:133px;"/>
              </div></br>
               <div id="coversmall" style="margin-top:5px;">
              <img src="/medium/<?php echo $f->img[3]; ?>"  style="width:133px;"/>
              </div>
          </div>
        </div></a>
	    <?php } ?>

		</div>
	</div>
	</div>
	<div id="footer">
		<p>©Copyright by surgesoft, 2011,all rights reserved</p>
		<p>收集工具|关于我们|帮助</p>
	</div>
	</div>
    <script src="/jquery.min.js"></script>
	<script type="text/javascript">
				
	
			$(function() {
				 
				
				var $container 	= $('#am-container'),
					$imgs		= $container.find('img').hide(),
					totalImgs	= $imgs.length,
					cnt			= 0
					;
				
				$imgs.each(function(i) {
					var $img	= $(this);
					$('<img/>').load(function() {
						++cnt;
						if( cnt === totalImgs ) {
							$imgs.show();
							$container.montage({
								liquid 	: false,
								minw : 100,
							alternateHeight : true,
							alternateHeightRange : {
								min	: 70,
								max	: 150
							},
							margin :2,
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

				
				
			});
		</script>
		<script src="/jquery.montage.js"></script>
		<script src="/vendor/jquery.ui.widget.js"></script>
		<script src="/load-image.min.js"></script>
    	<script src="/jquery.montage.js"></script>
        <script src="/bootstrap-tooltip.js"></script>
        <script src="/popup.js"></script>
        <script src="/jquery-infoAndFavorites/jquery-infoAndFavorites2.js" ></script>
        <script>
        $('#indexshow .imginfo').favor({
border:false,
width:120,
height:80
            });
        $('#re-right .imginfo').favor(
            {
linkto:false,
title:false,
border:false,
link:"",
width:161,
height:161,

            }); 
        </script>
        </body>
</html>
