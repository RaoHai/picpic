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
	xmlHttp.open("get","login.php?username="+str+"&password="+str1,true);
	xmlHttp.send(null)		
	}

	function stateChanged() 
	{ 
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	 { 		 
	 if(xmlHttp.responseText=='0')
	 {
		 document.getElementById("password").innerHTML="用户名不存在！" ;
		 }
     if(xmlHttp.responseText=='1')
		 document.getElementById("password").innerHTML="密码错误！";	 
     if(xmlHttp.responseText=='2')
		window.location.href='home';
	 } 
	}

	function username()
	{
	return document.forms['login'].elements['username'].value;
	}