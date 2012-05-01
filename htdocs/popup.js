function showWin()
{
	
	var windowWidth = document.documentElement.clientWidth;
	var windowHeight = document.documentElement.clientHeight;
	$("#signin_dialog").css({"display":"block",
									"left":windowWidth/2-160,
									"top":windowHeight/2-170});
	$("#fade").css({"display":"block"});
}
function hideWin()
{
	$("#signin_dialog").css({"display":"none"});
	$("#fade").css({"display":"none"});

}
function showUpload()
{
	var windowWidth = document.documentElement.clientWidth;
	var windowHeight = document.documentElement.clientHeight;
	$("#signin_upload").css({"display":"block",
									"left":windowWidth*0.1,
									"top":windowHeight*0.1});
	$("#fade").css({"display":"block"});
	$("#fileuploadmain").css({"overflow-y":"scroll"});
}
var t0 = new Date().getTime();

function hideUpload()
{
	$("#signin_upload").css({"display":"none"});
	$("#fade").css({"display":"none"});

}
  var xmlHttp=null;	
  var c1;  
  function checkon(){
	str=document.forms['login'].elements['username'].value;
	str1=document.forms['login'].elements['password'].value;
	xmlHttp=new XMLHttpRequest();
	xmlHttp.onreadystatechange=stateChanged;	
	xmlHttp.open("get","/user/login?username="+str+"&password="+str1,true);
	xmlHttp.send(null)		
	}

	function stateChanged() 
	{ 
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	 { 		 
	 if(xmlHttp.responseText=='0')
	 {
		 document.getElementById("password").innerHTML="登录失败！" ;
		 }
     if(xmlHttp.responseText=='1')
		 {
			var url=window.location.search.substr(1);
			window.location.href= url;
		}
	 } 
	}

var checkemail = false;
var checkname = false;

	function username()
	{
	return document.forms['login'].elements['username'].value;
	}
	

	$(document).ready(function(){

      //控制台
       var now = new Date().getTime();
       var latency = now - t0;
      
       $(document).keydown(function(e) {
         if(e.keyCode=="113")
        {
        if(!this._w)
        {
        	this._w = $('<div></div>').css({
              display:'none',
              width:500,
              height:250,
              position: 'absolute',
              background: 'black',
              border: '2px solid #AAA',
              'border-radius':'8px',
              'box-shadow': 'rgb(68, 68, 68) 9px 9px 9px',
              left: 5,
              top: 5,
            }).html('<textarea id="console_out" style="background-color:black;border-color: black;color:white;width:490px;height:200px;cursor:default;"readonly="readonly">'+
              '控制台已加载:\n页面加载时间：'+latency+
              'ms</textarea><input id="console_input" type="text" style="border-color:#09f;width:450px;background-color:black;color:white;">'+
              '<button type="button" id="console_send" class="btn btn-primary" style="margin-top:-10px;">&lt;</button>').appendTo($(document.body));	
               $('#console_send').click(function()
                 {
                    eval($('#console_input').val());
                 });
        }
        if(this._w.css('display')=='block')
            this._w.css({
                'display':'none'});
        else
            this._w.css({
                'display':'block'});

        
        }
      });
$('#weibo').atcomplete({
    datasource : '/friend/getfriendjson',
    });


		$('#regbt').click(function()
		{
			/*
			$("#inner").animate({
            opacity: "0.1",
            left: "-=500"
			}, 600);
			//*/
			// /*
			if(checkemail==true && checkname==true  && $('#agreement').attr('checked')=="checked" )
			{
					 $.getJSON("/user/new",{email:$("#email").val(),username:$("#username").val(),nickname:$("#nickname").val(),password:$("#password").val()}, function (values) {
						if(values==true)
						{
							
						}
				});
			}
			// */
		});
	$('#email').blur(function()
	{
		 if($("#email").val().match(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/)){
			 $.getJSON("/user/checkemail/"+$("#email").val(), function (values) {
				if(values==true) 
				{
					checkemail=true;
					$('#emailnotice').html("");
				}
				else 
				{
					checkemail=false;
					$('#emailnotice').html("<font color='red'>email已被使用</font>");
				}
				
		 });
		 }
		 else
		 {
			$('#emailnotice').html("<font color='red'>email格式错误</font>");
		 }
	});
	$('#username').blur(function()
	{
			if($("#username").val()!=""){
			 $.getJSON("/user/checkname/"+$("#username").val(), function (values) {
			 	if(values==true) 
				{
					checkname=true;
					$('#namenotice').html("");
				}
				else 
				{
					checkname=false;
					$('#namenotice').html("<font color='red'>该名字已被使用</font>");
				}
			 });
			 }
	});
 });
