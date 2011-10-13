<?php
require_once('..\handler.php');
session_start();
$year=date("Y");
$month=date("m");
$day=date("d");
$birthday=$_POST['birthyear'].'/'.$_POST['birthmonth'].'/'.$_POST['birthday'];
$address=$_POST['resideprovince'];
$user=$imgView->GetUser($_SESSION['user']);
$profile=$imgView->getprofile($user['UserID']);

$imgView->showinformation();	
	
	if (($_FILES["file"]["type"] == "image/gif")||($_FILES["file"]["type"] == "image/jpeg")||($_FILES["file"]["type"] == "image/pjpeg"))
	  {
	  if ($_FILES["file"]["error"] > 0)
		{
		echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
		}
	  else
		{
		if (file_exists("userphoto/".$user['UserID'].$user['UserName'].".jpg"))
			unlink("userphoto/".$user['UserID'].$user['UserName'].".jpg");
		move_uploaded_file($_FILES["file"]["tmp_name"],"userphoto/".$user['UserID'].$user['UserName'].".jpg");
		}
		echo "图片上传成功";
	  }

	$userphoto=$user['UserID'].$user['UserName'].".jpg";
	if (!file_exists("userphoto/".$userphoto))
	{
		$userphoto="123.jpg";
	}
	
	$show='
	<script language="javascript" type="text/javascript">
	function showbirthday()
	{
		var number=parseInt(document.forms["user"].elements["birthyear"].value);
		var dayoption1=new Option("29","29");
		var dayoption2=new Option("30","30");
		var dayoption2=new Option("31","31");
		if(document.forms["user"].elements["birthmonth"].value=="2")
		{
		document.getElementById("birthday").remove(31);
		document.getElementById("birthday").remove(30);
		document.getElementById("birthday").remove(29);
		if(number%4==0)
		{
		document.getElementById("birthday").add(dayoption1,29);
		}
		}
		else
		{
	
			if(document.getElementById("birthday").length==29)
			document.getElementById("birthday").add(dayoption1,29);
			if(document.getElementById("birthday").length==30)
			document.getElementById("birthday").add(dayoption2,30);
			if(document.getElementById("birthday").length==31)
			document.getElementById("birthday").add(dayoption3,31);
			if(document.forms["user"].elements["birthmonth"].value=="4" || document.forms["user"].elements["birthmonth"].value=="6" || document.forms["user"].elements["birthmonth"].value=="9" || document.forms["user"].elements["birthmonth"].value=="11" )
			document.getElementById("birthday").remove(31);
		}
	}
	</script>
	<div>
	<img src="../information/userphoto/'.$userphoto.'" alt="user"/>
	</div>
	<div>
	<form name="user" action="user.php" method="post" enctype="multipart/form-data">
	<label for="file">Filename:</label>
	<input type="file" name="file" id="file" />
	<select name="birthyear" id="birthyear" tabindex="1" onchange="showbirthday();">
		<option value="">年</option>
		<option value="2011">2011</option>
		<option value="2010">2010</option>
		<option value="2009">2009</option>
		<option value="2008">2008</option>
		<option value="2007">2007</option>
		<option value="2006">2006</option>
		<option value="2005">2005</option>
		<option value="2004">2004</option>
		<option value="2003">2003</option>
		<option value="2002">2002</option>
		<option value="2001">2001</option>
		<option value="2000">2000</option>
		<option value="1999">1999</option>
		<option value="1998">1998</option>
		<option value="1997">1997</option>
		<option value="1996">1996</option>
		<option value="1995">1995</option>
		<option value="1994">1994</option>
		<option value="1993">1993</option>
		<option value="1992">1992</option>
		<option value="1991">1991</option>
		<option value="1990">1990</option>
		<option value="1989">1989</option>
		<option value="1988">1988</option>
		<option value="1987">1987</option>
		<option value="1986">1986</option>
		<option value="1985">1985</option>
		<option value="1984">1984</option>
		<option value="1983">1983</option>
		<option value="1982">1982</option>
		<option value="1981">1981</option>
		<option value="1980">1980</option>
		<option value="1979">1979</option>
		<option value="1978">1978</option>
		<option value="1977">1977</option>
		<option value="1976">1976</option>
		<option value="1975">1975</option>
		<option value="1974">1974</option>
		<option value="1973">1973</option>
		<option value="1972">1972</option>
		<option value="1971">1971</option>
		<option value="1970">1970</option>
		<option value="1969">1969</option>
		<option value="1968">1968</option>
		<option value="1967">1967</option>
		<option value="1966">1966</option>
		<option value="1965">1965</option>
		<option value="1964">1964</option>
		<option value="1963">1963</option>
		<option value="1962">1962</option>
		<option value="1961">1961</option>
		<option value="1960">1960</option>
		<option value="1959">1959</option>
		<option value="1958">1958</option>
		<option value="1957">1957</option>
		<option value="1956">1956</option>
		<option value="1955">1955</option>
		<option value="1954">1954</option>
		<option value="1953">1953</option>
		<option value="1952">1952</option>
		<option value="1951">1951</option>
		<option value="1950">1950</option>
		<option value="1949">1949</option>
		<option value="1948">1948</option>
		<option value="1947">1947</option>
		<option value="1946">1946</option>
		<option value="1945">1945</option>
		<option value="1944">1944</option>
		<option value="1943">1943</option>
		<option value="1942">1942</option>
		<option value="1941">1941</option>
		<option value="1940">1940</option>
		<option value="1939">1939</option>
		<option value="1938">1938</option>
		<option value="1937">1937</option>
		<option value="1936">1936</option>
		<option value="1935">1935</option>
		</select>
		<select name="birthmonth" id="birthmonth" onchange="showbirthday();" tabindex="1">
		<option value="">月</option>
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
		<option value="6">6</option>
		<option value="7">7</option>
		<option value="8">8</option>
		<option value="9">9</option>
		<option value="10">10</option>
		<option value="11">11</option>
		<option value="12">12</option>
		</select>
		<select name="birthday" id="birthday"  tabindex="1">
		<option value="">日</option>
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
		<option value="6">6</option>
		<option value="7">7</option>
		<option value="8">8</option>
		<option value="9">9</option>
		<option value="10">10</option>
		<option value="11">11</option>
		<option value="12">12</option>
		<option value="13">13</option>
		<option value="14">14</option>
		<option value="15">15</option>
		<option value="16">16</option>
		<option value="17">17</option>
		<option value="18">18</option>
		<option value="19">19</option>
		<option value="20">20</option>
		<option value="21">21</option>
		<option value="22">22</option>
		<option value="23">23</option>
		<option value="24">24</option>
		<option value="25">25</option>
		<option value="26">26</option>
		<option value="27">27</option>
		<option value="28">28</option>
		<option value="29">29</option>
		<option value="30">30</option>
		<option value="31">31</option>
		</select>
		<select name="resideprovince" id="resideprovince" tabindex="1">
		<option value="">-省份-</option>
		<option did="1" value="北京市">北京市</option>
		<option did="2" value="天津市">天津市</option>
		<option did="3" value="河北省">河北省</option>
		<option did="4" value="山西省">山西省</option>
		<option did="5" value="内蒙古自治区">内蒙古自治区</option>
		<option did="6" value="辽宁省">辽宁省</option>
		<option did="7" value="吉林省">吉林省</option>
		<option did="8" value="黑龙江省">黑龙江省</option>
		<option did="9" value="上海市">上海市</option>
		<option did="10" value="江苏省">江苏省</option>
		<option did="11" value="浙江省">浙江省</option>
		<option did="12" value="安徽省">安徽省</option>
		<option did="13" value="福建省">福建省</option>
		<option did="14" value="江西省">江西省</option>
		<option did="15" value="山东省">山东省</option>		
		<option did="16" value="河南省">河南省</option>
		<option did="17" value="湖北省">湖北省</option>
		<option did="18" value="湖南省">湖南省</option>
		<option did="19" value="广东省">广东省</option>
		<option did="20" value="广西壮族自治区">广西壮族自治区</option>
		<option did="21" value="海南省">海南省</option>
		<option did="22" value="重庆市">重庆市</option>
		<option did="23" value="四川省">四川省</option>
		<option did="24" value="贵州省">贵州省</option>
		<option did="25" value="云南省">云南省</option>
		<option did="26" value="西藏自治区">西藏自治区</option>
		<option did="27" value="陕西省">陕西省</option>
		<option did="28" value="甘肃省">甘肃省</option>
		<option did="29" value="青海省">青海省</option>
		<option did="30" value="宁夏回族自治区">宁夏回族自治区</option>
		<option did="31" value="新疆维吾尔自治区">新疆维吾尔自治区</option>
		<option did="32" value="台湾省">台湾省</option>
		<option did="33" value="香港特别行政区">香港特别行政区</option>
		<option did="34" value="澳门特别行政区">澳门特别行政区</option>
		<option did="35" value="海外">海外</option>
		<option did="36" value="其他">其他</option>
		</select>
	<p><input type=submit name="click2" value="确定"/></p>
	</form>
	</div>';
	echo $show;
	
	$imgView->updateprofile($profile['UserId'],$birthday,$address);
?>