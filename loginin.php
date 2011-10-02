<?php
$click1=$_GET['click1'];
if($click1==NULL)
	echo<<<EOD
<div>
<form name="login" action="loginin.php" method="get" >
<input type='button' name='click1' value='0' href=# onclick='document.login.submit'/>  
</form>
</div>

EOD;
if($click1=='0')
	echo "123";
?>