<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
                           <a href="/user/message"> <i class="icon-envelope" id="newmessage"></i></a>
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
    <h1><center><?php echo $this->values["title2"]; ?></center></h1>
    	<div style="margin-top:20px;min-height:360px;">
        <ul id="showactives">
        <div style="float:left;width:200px;">
         <p> <a  href="/user/message" class="btn btn-primary start"  ><i class="icon-envelope icon-white"></i>收件箱</a></p>
         <p> <a  href="/user/sendbox" class="btn btn-info cancel"  ><i class="icon-inbox icon-white"></i>发件箱</a></p>
         <p> <a  class="btn btn-warning"  >通知</a></p>
         <p></p>
         <p><a data-controls-modal="modal-send-message" data-backdrop="true" data-keyboard="true"  class="btn btn-primary start"><i class= "icon-edit icon-white"></i>写信息</a> </p>
        </div>
        <div style='float:right;width:700px;'>
        <div class="accordion" id="accordion2">
           
 
          </div>

         </ul>
        </div>
        
  	</div>
    <div id="footer">
		<p>©Copyright by surgesoft, 2011,all rights reserved</p>
		<p>收集工具|关于我们|帮助</p>
	</div>
	</div>
        <!--写信息 -->
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
        <script src="/bootstrap-collapse.js"></script>
       <script src="/popup.js"></script>
       <script src="/bootstrap-tooltip.js"></script>

       <script>
        $(function(){
            $(document).ready(function(){
              $.getJSON("/message/<?php echo $this->values["ajaxaction"]; ?>",0, function (values) {
                for(var i=0;i<values.length;i++)
                {
                  if(values[i].readMark==1) var unread=""; else var unread = "in";
                  if("<?php echo $this->values["ajaxaction"]; ?>"=="getmessages") var head=values[i].senderId; else var head=values[i].reciverId;
                  $('<div class="accordion-group '+unread+'" style="width:100%"></div>')
                  .html('<div class="accordion-heading" style="width:100%;">'+
                    '  <div style="float:left;"><img src="/upload/avatar_small/'+head+
                    '_small.jpg" style="width:35px;height:35px;"/></div>'+
                     '<div ><a class="accordion-toggle" data-toggle="collapse"'+
                     'href="#collapse'+i+'"><span id="readmark">' + values[i].Title + '</span></a>'+
                     '</div><div style="float:right"><a id="delby" href="/message/delbyreciver/'+values[i].MessageId+'" class="btn btn-primary"'+
                     ' >删除</a></div></div>'+
                     '<div id="collapse'+i+'" class="accordion-body collapse " style="width:100%;">'+
                     '<div class="accordion-inner" ><p>'+ values[i].messageText + 
                     '</p></div></div></div>'
                 ).attr('readmark',values[i].readMark)
                  .attr('msgid',values[i].MessageId)
                  .on('show', function() {
                      if($(this).attr('readmark')==0 && "<?php echo $this->values["ajaxaction"]; ?>"=="getmessages"){
                      $(this).removeClass('in');
                      $(this).attr('readmark',1);
                      $.getJSON("/message/readmark/"+$(this).attr('msgid'),0,function(values){
                        });
                      }
                    })
                  .appendTo($('#accordion2'));
                  } 
                });
                             
           }); 
           $(".collapse").collapse({
             toggle: true
           });
              });
      </script>
</body>
</html>
