<html>
<head>
<?php
include('vogoo-2.2/vogoo/vogoo.php');
if(!$vogoo->connected)
{
	echo "<h1 align=\"center\">OOPS !! Connection couldnot be established !!</h1>";
}
else
{
?>
<div id="go_home" align="center"><a href="index.php">Home</a></div><br/>
<h1 align="center"> Delete a Rating </h1>
<br />
<?php
}
?>
</head>

<body>
	<form name="addRatingInputs" method="post">
		<div id="add_rating_input" align="center">
			<table>
			<tr>
			<td>
			<b>Member Id :</b></td><td><input type="text" name="member_id" id="member_id" size="3"></input>
			</td>
			</tr>
			<tr>
			<td>
			<b>Item Id :</b></td><td><input type="text" name="item_id" id="item_id" size="3"></input>
			</td>
			</tr>
			<tr>
			<td>
			<br/>
			<input type="submit" value="Delete Rating!"/>
			</td>
			</tr>
			</table>
		</div>
	</form>
	
	<form name="table_content" method="get">
		<div id="rating_table" align="center">
		<table border="1">
		<?php
			$member_id = $_POST['member_id'];
			$item_id = $_POST['item_id'];
			if($member_id!='' && $item_id!='')
			{
				$vogoo->delete_rating($member_id,$item_id);			
			}
			echo "<tr>";
			echo "<td>";
			echo "<b>Member Id</b>";
			echo "</td>";
			echo "<td>";
			echo "<b>Item Id</b>";
			echo "</td>";
			echo "<td>";
			echo "<b>Rating</b>";
			echo "</td>";
			echo "</tr>";
			$user = "vogoo";
			$user_password = "";
			$db_name = "vogoo_web";
			$db = new mysqli ("localhost", $user, $user_password, $db_name);
			$query = 'select * from vogoo_ratings';
			if($rating_data = $db->query($query))
			{
				while ($record = $rating_data->fetch_array(MYSQLI_BOTH))
				{
					echo "<tr>";
					echo "<td>";
					echo $record['member_id'];
					echo "</td>";
					echo "<td>";
					echo $record['product_id'];
					echo "</td>";
					echo "<td>";
					echo $record['rating'];
					echo "</td>";
					echo "</tr>";
				}
			}
			else
			{
				echo "Query did not get executed..";
			}
			$rating_data->close();
			$db->close();
		?>
		</table>
		</div>
		
	</form>
</body>
</html>