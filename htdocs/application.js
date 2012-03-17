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

$(function () {
    'use strict';
    // Initialize the jQuery File Upload widget:
    $('#fileupload').fileupload();
        // Load existing files:
      questandset();
    

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

    // Initialize the Bootstrap Image Gallery plugin:
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
	
	$('#showcatch').click(function()
	{
			
		
	});
});

