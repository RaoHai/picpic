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
}
function hideUpload()
{
	$("#signin_upload").css({"display":"none"});
	$("#fade").css({"display":"none"});
	
}