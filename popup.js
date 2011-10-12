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