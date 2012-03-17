<?php
$show="<html>
	<head>
	<script type='text/javascript' src='/shi/jquery-1.7.1.js'></script>
	<script type='text/javascript'>	
	$(document).ready(function(){
	$(this).click(function() {
	alert($(this).attr('value'));
	  $('[name=\"'+$(this).attr('name')+'\"]').toggle(1000);
	  }
	  
	  );
	});
	</script>
	</head>
	<body>

";
for($i=0;$i<10;$i++)
{
$show=$show."	
<a class='al'>
	<p class='ac' value='".(string)$i."'>ac".(string)$i."</p>
	<p class='ab' value='1".(string)$i."'>ab".(string)$i."</p>
	</a>";
	};
$show=$show." 
	

	</body>
	</html>";
	echo $show;
?>
