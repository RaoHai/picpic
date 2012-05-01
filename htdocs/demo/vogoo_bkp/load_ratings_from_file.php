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
	<form enctype="multipart/form-data" action="load_ratings_from_file.php" method="POST">
	  <div id="add_rating_from_file" align="center">
		<label for="file">Filename:</label>
		<input type="file" name="file" id="file" /> 
		<br />
		<input type="submit" name="submit" value="Submit" />
	  </div>
	</form>
	
	<form name="table_content" method="get">
		<div id="rating_table" align="center">
		<table border="1">
		<?php
			$file_name = "/home/bharath/public_html/vogoo_interface/upload/".$_FILES["file"]["name"];
			if($_FILES["file"]["name"]!="" && !move_uploaded_file($_FILES["file"]["tmp_name"],$file_name))
			{
				echo "<br/><h1>File upload Failed</h1>";
			}
			$ratings_file = fopen($file_name,'r');
			while($ratings_data = fgets($ratings_file))
			{
				$data = split("\t",$ratings_data);
				$member_id = $data[0];
				$item_id = $data[1];
				$scaled_rating = $data[2]/5;
				$vogoo->set_rating($member_id,$item_id,$scaled_rating);
			}
			fclose($ratings_file);
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