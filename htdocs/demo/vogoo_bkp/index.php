<html>
<head>
<?php
echo realpath(dirname(__FILE__));
include('vogoo-2.2/vogoo/vogoo.php');
if(!$vogoo->connected)
{
	echo "<h1 align=\"center\">OOPS !! Connection couldnot be established !!</h1>";
}
else
{?>
<h1 align="center"> Welcome to the Recommendation System !! </h1>
<?php
}
?>
</head>

<body>
	<div id="main_menu" align="center">
		<a href="add_a_rating.php">Rate an Item</a><br/>
		<a href="delete_a_rating.php">Delete a Rating</a><br/>
	
		<br/><br/><br/>
		<h3>
			Choose How you want to get Recommended : <br/>
			<a href="item_based.php">Item Based Recommendation</a><br/>
			<a href="user_based.php">User Based Recommendation</a><br/>
		</h3>
	</div>
</body>
</html>
