/*
 * jQuery File Upload Plugin JS Example 6.0.3
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

/*jslint nomen: true, unparam: true, regexp: true */
/*global $, window, document */
function questandset()
{
  $.getJSON($('#fileupload').prop('action'),{name:$("#upselect").val()}, function (files) {
      var fu = $('#fileupload').data('fileupload'),
      template;
      if(files.length==0)
      $('#fileupload .files').html("<center>画集里还没有文件，请点击[添加文件] 或把图片拖放到浏览器中上传</center>");
      fu._adjustMaxNumberOfFiles(-files.length);
      template = fu._renderDownload(files)
      .appendTo($('#fileupload .files'));
      // Force reflow:
      fu._reflow = fu._transition && template.length &&
      template[0].offsetWidth;
      template.addClass('in');
      });
}
function setpage(values)
{
     var currange = Math.ceil(values.curpage/4);
    var rightpart="";
    if(currange+3<values.pages)
    {
      var pageend = currange+3; 
      rightpart = '<li><a href="'+(pageend+1)+'">»</a></li>';
    }
    else
    {
      var pageend = values.pages;
    }
    var pageselect="";
    for(var i = currange ; i <= pageend ; i++)
    {
      var li="";
      var leftpart="";
      if(currange==1) leftpart='';
      else leftpart='<li><a href="'+4*(currange-1)+'">«</a><li>';
      
      if(i == values.curpage) li = '<li class="active">';
      else li='<li>';
      pageselect += li+'<a href="#'+i+'">'+i+'</a></li>';
    }
    $('<div class="pagination"></div>').html('<ul>'+leftpart+pageselect+rightpart+'</ul>')
    .appendTo($('#pageselect'));
}
function addtoactive(values,prepend)
{
  if(values=="short"){
    alert('微薄太短了混蛋。。');
    return;
  } 
  if(values=='long')
  {
    alert('微薄也要言简意赅。。');
    return;
  }
  for(var i=0; i<values.length; i++)
  {
        data=values[i];

    if(data.type==1){
      var str="";
      for(var j=0;j<data.data.length;j++)
      {
        str +='<img style="max-width:100px;margin:5px;"src="/medium/'+data.data[j].d+'"/>';
      }
      $('<li></li>').html('<div id="uili" style="float:left;width:100%;"><div style="float:left">'+
          '<img src="/upload/avatar_small/'+data.userid+'_small.jpg" />'+
          '</div><div style="float:left">	<p><a href="/user/'+data.userid+'" style="margin:5px;color:#995F28;"><b>'+data.username+'</b></a> '+data.time+'上传到'+data.gid+'</p><p  style="margin:5px;">'
          +'<a href="/imagegroup/'+data.gid+'" title="查看" >'+str+'</a></p></div></div>')
        .appendTo($('#showactives'));

      
    }
    else if(data.type==6)
    {
      console.log('hello');
      if(data.userid>0 && data.userid==myid)
        var del="<a name='del' style='cursor:pointer;' delid="+data.data[0].id+">删除</a>";
      else
        var del="";
      var repo="";
      if(data.data[0].repo)
      {
        repo = '<div id="repos"><div id="arrow2"><em class="W_arrline">◆</em></div>'+data.data[0].repo+'</div>';
      }
      var Liadd = $('<li></li>').html('<div id="uili" style="float:left;width:550px;"><div style="float:left">'+
          '<img src="/upload/avatar_small/'+data.userid+'_small.jpg" .>'+
          '</div><div style="float:left" id="weibocontent">	<p><a href="/user/'+data.userid+'" style="margin:5px;color:#995F28;"><b>'+data.username+'</b></a>:'+
          data.data[0].d+'</p>'+
          repo+'<p style="float:left;">'+data.time+'</p>'+
          '<p style="float:right;"><a name="repo" style="margin-right:20px;cursor:pointer;" repoid='+data.data[0].id+'>转发</a>'+del+'</p>'+
          '</div></div>');
       if(prepend==1)
          Liadd.prependTo($('#showactives'));
       else
         Liadd.appendTo($('#showactives'));


              $('a[name=del]').unbind().click(function(){
          $(this).parents('li').remove();
          var delid = $(this).attr('delid');
            $.getJSON('/active/delweibo/'+delid,0,function(values){
          
            });

          });
      $('a[name=repo]').unbind().click(function(){
            var repoid = $(this).attr('repoid');
            $.getJSON('/active/getActionById/'+repoid,0,function(values)
              {
                $('#weibopreview').html('<a href="/user/'+data.userid+'"style="margin:5px;color:#995F28;" >@'+data.username+'</a>'+values.content.d+'</br>'+data.time+'| <a id="repolink" href="/active/'+repoid+'">转发</a>');
                $('#modal-weibo-repo').modal({
                  backdrop:true,
                  show:true
                  });
                //console.log(values);

              }); 
          });
    }
  }
}
function SaveText() {
  var date = new Date();
  date.setTime(date.getTime() + (30 * 60 * 1000));
  $.cookie("input", $("#weibo").text(), { expires: date });
}

$(function () {
    'use strict';
    // Initialize the jQuery File Upload widget:
    $('#fileupload').fileupload();
    // Load existing files:
    questandset();
window.onhashchange = function(){
  var page = window.location.hash.substr(1);
  if(page<=0) page=0;
  page = page-1;
 $.getJSON('/active/show/'+page,0,function(values)
    {
    $('#showactives').html('');
    $('#pageselect').html('');
    setpage(values);
    addtoactive(values.msg);
    });


};
    // Enable iframe cross-domain access via redirect page:
    var redirectPage = window.location.href.replace(
      /\/[^\/]*$/,
      '/cors/result.html?%s'
      );
    $('#fileupload').bind('fileuploadsend', function (e, data) {
      if (data.dataType.substr(0, 6) === 'iframe') {
      var target = $('<a/>').prop('href', data.url)[0];
      if (window.location.host !== target.host) {
      data.formData.push({
name: 'redirect',
value: redirectPage
});
      }
      }
      $("#weibo").text($.cookie("input"));
      });

// Open download dialogs via iframes,
// to prevent aborting current uploads:
$('#fileupload .files').delegate(
    'a:not([rel^=gallery])',
    'a:not([rel==normal])',
    'click',
    function (e) {
    e.preventDefault();
    $('<iframe style="display:none;"></iframe>')
    .prop('src', this.href)
    .appendTo(document.body);
    }
    );
/**
 *发送微博
 *
 */
$('#weibosend').click(function(){
    var val = encodeURIComponent($('#weibo').val());
     $.ajax({                                                
type: "POST",                                 
url: "/active/weibo/",  
data: "text="+val,  
 dataType: "json",
success: function(msg){         
console.log(msg);
addtoactive(msg,1);
 $('#weibo').val('');
}});
     });
$('#reposubmit').click(function(){
      var val = encodeURIComponent($('#weiborepo').val());
      var repo = encodeURIComponent($('#weibopreview').html());
      //console.log(val);
      //console.log(repo);
      $.ajax({
type:"POST",
url:"/active/repo/",
data:"text="+val + "&repo=" + repo,
dataType:"json",
success:function(msg){
  addtoactive(msg);
  $('#modal-weibo-repo').modal('hide');
}
        });
    });
$('#weibo').keyup(function()
    {
    var val = $('#weibo').val();
    if(val.length>0 && val.length<140){
    $('#weibosend').removeClass('disabled');
    $('#weibosend').removeAttr("disabled");     
    $('#weibolength').html('还可以输入：'+(140 - val.length)+"字");
    }
    else
    {
    $('#weibosend').addClass('disabled');
    $('#weibosend').attr("disabled","disabled");	
    if(val.length>140)
    $('#weibolength').html('已超过'+(val.length - 140)+"字");

    }
    });

// Initialize the Bootstrap Image Gallery l:
$('#fileupload .files').imagegallery();

});
$(document).ready(function(){
    
       
      $("#showup").click(function(){
      $("#fcontainer").show("fast");

      return false;
      }); 
    $("#uploadcomplete").click(function(){
      $("#fcontainer").hide("fast");

      return false;
      });

    $("#groupsubmit").click(function()
      {
      $.ajax({                                                
type: "POST",                                 
url: "/imagegroup/new",                                    
data: "groupname="+$("#groupname").val()+"&groupdescription="+$("#groupdescription").val()+"&groupcatalog="+$("#groupcatalog").val(),   
success: function(msg){                 
$("#upselect").html(msg);    
$("#upselect").change();
$("#groupnotice").show("fast");
}    
});  
      });
	  $("#showup").click(function(){
			  $("#fcontainer").show("fast");
			
			return false;
    }); 
	$("#uploadcomplete").click(function(){
			  $("#fcontainer").hide("fast");
			 
			return false;
    });
	$("#upselect").change(function(){
			$('#fileupload .files').empty();
		   questandset();
	});
	$("#groupsubmit").click(function()
	{
			$.ajax({                                                
			type: "POST",                                 
			url: "/imagegroup/new",                                    
			data: "groupname="+$("#groupname").val()+"&groupdescription="+$("#groupdescription").val()+"&groupcatalog="+$("#groupcatalog").val(),   
			success: function(msg){                 
				 $("#upselect").html(msg);    
				 $("#upselect").change();
				 $("#groupnotice").show("fast");
			}    
			});  
	});
	$("#group_submit").click(function()
	{
			$.ajax({                                                
			type: "POST",                                 
			url: "/group/imagegroupadd",                                    
			data: "groupname="+$("#groupname").val()+"&groupdescription="+$("#groupdescription").val()+"&groupcatalog="+$("#groupcatalog").val(),   
			success: function(msg){                 
				 $("#upselect").html(msg);    
				 $("#upselect").change();
				 $("#groupnotice").show("fast");
			}    
			});  
	});
$('#edgroupsubmit').click(function()
    {
    $.ajax({                                                
type: "POST",                                 
url: "/imagegroup/edit",                                    
data: "groupname="+$("#edgroupname").val()+"&groupdescription="+$("#edgroupdescription").val()+"&groupcatalog="+$("#edgroupcatalog").val()+"&groupid="+$("#edgroupid").val(),   
success: function(msg){                 
$("#upselect").html(msg);    
//$("#upselect").change();
$("#edgroupnotice").show("fast");
}    
});  
    });
$("#groupsettings").click(function()
    {
    $.getJSON("/imagegroup/show",{id:$("#upselect").val()}, function (values) {
      $("#edgroupname").val(values.name);
      $("#edgroupid").val(values.id);
      $("#edgroupdescription").val(values.desc);
      //alert(values.cata);
      $("#edgroupcatalog").val(values.cata);
      //alert(values.name);
      });
    });
$('#imgedit').click(function()
    {
    $.ajax({                                                
type: "GET",                                 
url: "/image/edit",                                    
data: "desc="+$("#edimgdesc").val()+"&url=" +$("#edimgname").val(),   
success: function(msg){                 
}    
});  
    });
 $.getJSON('/active/show',0,function(values)
    {
    setpage(values);
    addtoactive(values.msg);
    });
});

$("#group_information_submit").click(function()
	{
			$.ajax({                                                
			type: "POST",                                 
			url: "/group/informationupdate",                                    
			data: "groupnewname="+$("#groupnewname").val()+"&groupnewdescription="+$("#groupnewdescription").val(),   
			success: function(msg){                 
				 $("#upselect").html(msg);    
				 $("#upselect").change();
				 $("#groupnotice1").show("fast");
			}    
			});  
	});

$("#group_activity_submit").click(function()
	{
			$.ajax({                                                
			type: "POST",                                 
			url: "/group/activityadd",                                    
			data: "activityname="+$("#activityname").val()+"&activitydescription="+$("#activitydescription").val(),   
			success: function(msg){                 
				 $("#upselect").html(msg);    
				 $("#upselect").change();
				 $("#groupnotice2").show("fast");
			}    
			});  
	});
