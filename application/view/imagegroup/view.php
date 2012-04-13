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
			<p style="color:white;">图集作者:<a href='/user/<?php echo $this->values["authorid"]; ?>'>| <?php echo $this->values["authorname"]; ?> |</a></p>
			</div>
			
			<div style="width:100%;min-width:1080px; margin:10px auto;float:left;">
				<div class="am-container" id="am-container" style="float:left;">
				<?php echo $this->values["images"]; ?>
				</div>
			</div>
				<div  style="width:100%;min-width:1080px;margin:10px auto;">
				<div style="border-radius:4px;background-color:white;float:left;width:100%;">评论：<?php if($this->values["user"]) {  ?>
                <div style="margin-left:30px;">
				<ul id="comments_text"></ul>
				<!--<link rel="stylesheet" type="text/css" href="/markitup/markitup/skins/markitup/style.css" /> <!--  -->
				<!--<link rel="stylesheet" type="text/css" href="/markitup/markitup/sets/bbcode/style.css" /><!-- -->

				<form id="comments_form"action="/imagegroup/savecomments?Groupid=<?php echo $this->values["groupid"]; ?>" method="post">
					<textarea id="cmeditor" name="comments" cols="80" rows="20" style="width:800px;"></textarea>
			
				<button id="comments_bt1" type="button" class="btn primary start" >提交评论</button>
			</form>
			  </div>
				</div>
                <?php } ?>
                </div>
				</div>

		<div id="gallery-loader"></div>
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
		<script src="/jquery.min.js"></script>
		<script src="/jquery.montage.js"></script>
		<script src="/vendor/jquery.ui.widget.js"></script>
		<script src="/load-image.min.js"></script>
		<script src="/bootstrap-modal.min.js"></script>
		<script src="/bootstrap-image-gallery.min.js"></script>
        <script src="/jquery-infoAndFavorites/jquery-infoAndFavorites2.js" ></script>
        <script type="text/javascript" src="/jquery.tagsinput.js"></script>
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
$(document).ready(function(){
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
                                  refresh(field);
                                });
						});
	
						});
				});

    refresh = function(field)
    {
    var replys="";
    if (field.replys){
    $.each(field.replys,function(j,replies)
      { 
      replys+='<div style="width:750px;margin-left:20px;float:left;">'+
      '<div style="float:left"><img style="width:30px;height:30px;"src="/upload/avatar_small/'+
      replies.userid+'_small.jpg"/></div>'+
      '<div style="float:left;margin-top:-3px;"><p><a href="/user/'+replys.userid+
      '" style="margin:5px;color:#995F28;">'+
      '<b>'+replies.username+'</b></a>'+replies.text+'</p><p>'+
      replies.time+'</p></div></div>';
      });
    }
    $('<li></li>').html('<div style="float:left;width:750px;border-bottom:1px #CCCCCC dotted;"><div style="float:left">'+
      '<img src="/upload/avatar_small/'+field.userid+'_small.jpg" />'+
      '</div><div style="float:left;margin-top:-3px;" id="weibocontent">	<p><a href="/user/'+field.userid+
      '" style="margin:5px;color:#995F28;"><b>'+field.username+'</b></a>:'+
      field.text+'</p><p style="float:right;"><a style="cursor:pointer" onclick="replyto(this,'+field.id+')">回复</a>|'+
      field.time+'</p></div>'+replys+'</div>'
      )
      .appendTo($('#comments_text'));
    };
replyto = function(obj,id)
{
  $("<div id='replybox'></div>").html("<div>"+
      '<div id="arrow"><em class="W_arrline">◆</em></div>'+
      "<input id='replytext' style='width:400px;margin:4px;'/>"+
      "<a id='replysubmit' key="+id+" class='btn btn-primary' style='float:right;'>提交</a>"+
      "</div>"
      ).appendTo(obj.parentNode.parentNode.parentNode);
  $("#replysubmit").click(function()
      {
      var id = $(this).attr("key");
      $.getJSON("/imagegroup/replyto/"+id,{str:$('#replytext').val()}, function() {
         $(this).parent().parent().remove();
        $('#comments_text').html('');
        $.getJSON("/imagegroup/showcomments/"+$("#currentgroupid").val(), function(result) {
          $.each(result, function(i, field){
            refresh(field);
            });
        });
        });

      });

  //alert(id);
};
$.getJSON("/imagegroup/showcomments/"+$("#currentgroupid").val(), function(result) {
    if(result && result.length >0)
    {
    $.each(result, function(i, field){
      refresh(field);
      });
    }
    });

});
</script>
<script type="text/javascript">
function onAddTag(tag) {
     var imgid = $('.imgid').val();
    $.getJSON('/tags/addtag',{tags:$('#tags_1').val(),imgid:$('.imgid').val(),tagname:tag},function(){
                  $('#'+imgid).attr('tags',$('#tags_1').val());
                });
		}
		function onRemoveTag(tag) {
          var imgid = $('.imgid').val();
        $.getJSON('/tags/removetag',{tags:$('#tags_1').val(),imgid:$('.imgid').val(),tagname:tag},function(){
           $('#'+imgid).attr('tags',$('#tags_1').val());
           });

          //console.log($('#am-container').data);
		}
		
		function onChangeTag(input,tag) {
		}


$(function() {
if (<?php echo $this->values["userid"]; ?>==<?php echo $this->values["authorid"]; ?>)
  $('#tags_1').tagsInput({width:'auto','maxChars' : 5,'placeholderColor' : '#09F','onAddTag':onAddTag,'removeWithBackspace':false,'onRemoveTag':onRemoveTag, 'onChangeTag':onChangeTag });
else
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
