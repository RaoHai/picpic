<html>
<head>
<?php
include('vogoo-2.2/vogoo/vogoo.php');
include('vogoo-2.2/vogoo/users.php');
if(!$vogoo->connected)
{
	echo "<h1 align=\"center\">OOPS !! Connection couldnot be established !!</h1>";
}
else
{
?>
<div id="go_home" align="center"><a href="index.php">Home</a></div><br/>
<h1 align="center"> User Based Recommendation </h1>
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
			<br/>
			<input type="submit" value="Who are the similar Users?"/>
			</td>
			</tr>
			</table>
		</div>
	</form>
	
	<form name="table_content" method="get">
		<div id="items_table" align="center">
		<table border="1">
		<?php
			$member_id = $_POST['member_id'];
			if($member_id!='')
			{
				$vogoo_users->member_k_similarities($member_id,20,$sims);
				$ret = $vogoo_users->member_k_recommendations($member_id,10,&$sims,&$recommendations,$cat = 1,$filter = false);				
				if(sizeof($recommendations) == 0)
				{
					echo "<h2>Sorry no recommendations for you.</h2>";
				}
				else
				{
					echo "<h3>Users similar to you and the items he had rated.</h3>";
				}
			}
			echo "<tr>";
			echo "<td>";
			echo "<b>Similar User</b>";
			echo "</td>";
			echo "<td>";
			echo "<b>Similarity</b>";
			echo "</td>";
			echo "<td>";
			echo "<b>Recommended<br/>Item ID</b>";
			echo "</td>";
			echo "<td>";
			echo "<b>Rating<br/>Given</b>";
			echo "</td>";
			echo "<td>";
			echo "<b>Time of Rating</b>";
			echo "</td>";
			echo "</tr>";
			for($idx = 0; $idx < sizeof($recommendations); $idx++)
			{
				echo "<tr>";
				echo "<td align=\"center\">";
				echo $recommendations[$idx][0];
				echo "</td>";
				echo "<td align=\"center\">";
				echo $recommendations[$idx][1]/100;
				echo "</td>";
				echo "<td align=\"center\">";
				echo $recommendations[$idx][2];
				echo "</td>";
				echo "<td align=\"center\">";
				echo $recommendations[$idx][3];
				echo "</td>";
				echo "<td align=\"center\">";
				echo $recommendations[$idx][4];
				echo "</td>";
				echo "</tr>";
			}
		?>
		</table>
		</div>
		
	</form>
</body>
</html>