<html>
<head>
<?php
include('vogoo-2.2/vogoo/vogoo.php');
include('vogoo-2.2/vogoo/items.php');
if(!$vogoo->connected)
{
	echo "<h1 align=\"center\">OOPS !! Connection couldnot be established !!</h1>";
}
else
{
?>
<div id="go_home" align="center"><a href="index.php">Home</a></div><br/>
<h1 align="center"> Item Based Recommendation </h1>
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
			<input type="submit" value="Recommend Items!"/>
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
				echo $member_id;
				$ret = $vogoo_items->member_get_recommended_items($member_id);	
				if(!$ret)
				{
					echo "Failed";
				}
				else
				{
					echo "passed";
				}
			}
			echo "<tr>";
			echo "<td>";
			echo "<b>Recommended Items</b>";
			echo "</td>";
			echo "</tr>";
			foreach($ret as &$recommended_item)
			{
				echo "<tr>";
				echo "<td align=\"center\">";
				echo $recommended_item;
				echo "</td>";
				echo "</tr>";
			}
		?>
		</table>
		</div>
		
	</form>
</body>
</html>