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
<h1 align="center"> Add a Rating </h1>
<br />
<?php
}
?>
</head>

<body>
	<div id="add_rating_from_file" align="center">
		<a href="load_ratings_from_file.php"><h3>Load ratings from a file</h3></a>
		<br/>
		<br/>
		<br/>
		<h3> OR </h3>
		<br/>
	  </div>
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
			<b>Rating :</b></td><td><input type="text" name="numerator" id="numerator" size="3"></input>
			out of <input type="text" name="denominator" id="denominator" size="3"></input>
			</td>
			</tr>
			<tr>
			<td>
			</td>
			<td>
			<br/>
			<input type="submit" value="Rate!"/>
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
			$ntr = $_POST['numerator'];
			$dtr = $_POST['denominator'];
			$rating = $ntr/$dtr;
			if($member_id!='' && $item_id!='' && $ntr!='' && $dtr!='' && $dtr!=0)
			{
				$vogoo->set_rating($member_id,$item_id,$rating);			
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
