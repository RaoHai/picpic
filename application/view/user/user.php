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
    	<div id="welcome" >
			<div id="myphoto" style="width:350px;"><a data-controls-modal="modal-from-avatar" data-backdrop="true" style="width:120px;overflow:hidden;"><img style="width:120px;max-height:140px;" src="/upload/avatar_big/<?php echo $this->values["thisuserid"]; ?>_big.jpg" title="点击以更改头像"/></a>
			<div style="float:right;width:200px;">
			<p><h3><b style="color:#09F;"><?php echo $this->values["thisnickname"]; ?></b></h3></p>
            <p><?php echo $this->values["thisdesc"]; ?></p>
            <a id="followfunction" class="follow"></a><a id="messageto" style="color:#09f;cursor:pointer;margin-left:20px;"><i class="icon-edit"></i>写信息</a>
			</div>
			</div>
			<span id="showfriend" ><?php echo $this->values["friends"]; ?></span>
		</div>
        </br>
       <h3><?php echo $this->values["thisnickname"]; ?> 的图集：</h3>
        <div id="imggroups">
       <?php foreach($this->values["cover"] as $f) {  ?> 
        <div style="margin:25px 5px 5px 10px;width:310px;display:block;">
        <div style="width:100%;"><a href="/imagegroup/<?php echo $f->GroupId; ?>" title="<?php echo $f->Desc; ?>"><h3><?php echo $f->GroupName; ?></h3></a></div>
         <a href="/imagegroup/<?php echo $f->GroupId; ?>" title="<?php echo $f->Desc; ?>" >        <div style="float:left;width:161px;overflow:hidden;">
            <img src="/medium/<?php echo $f->img[0]; ?>"  style="height:161px;"/>
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
    
    <script src="/jquery.min.js"></script>
	<script src="/jquery.montage.js"></script>
		<script src="/vendor/jquery.ui.widget.js"></script>
		<script src="/bootstrap-modal.min.js"></script>
        <script src="/bootstrap-tooltip.js"></script>
        <script src="/bootstrap-tab.js"></script>
        <script src="/popup.js"></script>
        <script>
$(function(){
            $(document).ready(function(){
              $('#imagetabs').tab('show');
              $('#messageto').click(function(){
                $('#reciverid').val("<?php echo $this->values["thisnickname"]; ?>");
                  $('#modal-send-message').modal({
                    backdrop:true,
                    show:true
                    });
                });
              if("<?php echo $this->values["isfriends"]; ?>"=="11")
                $('#followfunction').attr('class','followboth');
               if ("<?php echo $this->values["isfriends"]; ?>"=="01")
                $('#followfunction').attr('class','hefollowyou');
               if("<?php echo $this->values["isfriends"]; ?>"=="10")
                $('#followfunction').attr('class','youfollowhe');


                });

            $('#followfunction').click(function(){
                var cls = $('#followfunction').attr('class');
                if(cls=="followboth" || cls=="youfollowedhe" )
                {
                  var fid= <?php echo $this->values["thisuserid"]; ?>;
                  $.getJSON('/friend/Del/'+ fid,0,function(values){
                      if(values=="01")
                         $('#followfunction').attr('class','hefollowyou');
                      if(values=="00")
                         $('#followfunction').attr('class','follow');

                    });
                }
                if(cls == "follow" || cls=="hefollowyou")
                {
                  var fid= <?php echo $this->values["thisuserid"]; ?>;
                  $.getJSON('/friend/Addfriend/'+ fid,0,function(values){
                      if(values=="11")
                         $('#followfunction').attr('class','followboth');
                      if(values=="10")
                         $('#followfunction').attr('class','youfollowedhe');

                    });
                }

 
              });
            });
        </script>
        </body>
</html>
