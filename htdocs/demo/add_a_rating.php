<html>
<head>
<script type="text/javascript" src="gen_links.js"></script>
<link href="style.css" rel="stylesheet" type="text/css">
<?php
include('vogoo-2.2/vogoo/vogoo.php');
if(!$vogoo->connected)
{
	echo "<h1 align=\"center\">OOPS !! Connection couldnot be established !!</h1>";
}
else
{
?>

<div id="go_home" align="left"><a href="index.php">Home</a>
<a href="load_ratings_from_file.php">Load ratings from a file</a>
</div><br/>
<h1 align="center"> Add a Rating </h1>
<br />
<?php
}
?>
</head>

<body>
 
	  
	<form name="addRatingInputs" method="post" >
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
	                <span><input type="button" value="create Links" onclick="call_cronlink()" /></span>
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


                        
	/*
		Place code to connect to your DB here.
	*/

	$tbl_name="vogoo_ratings";		//your table name
	// How many adjacent pages should be shown on each side?
	$adjacents = 3;
	
	/* 
	   First get total number of rows in data table. 
	   If you have a WHERE clause in your query, make sure you mirror it here.
	*/
	$query = "SELECT COUNT(*) as num FROM $tbl_name";
	$total_pages = mysql_fetch_array(mysql_query($query));
	$total_pages = $total_pages[num];
	
	/* Setup vars for query. */
	$targetpage = "add_a_rating.php"; 	//your file name  (the name of this file)
	$limit = 20; 								//how many items to show per page
	$page = $_GET['page'];
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;								//if no page var is given, set start to 0
	
	/* Get data. */
	$sql = "SELECT * FROM $tbl_name LIMIT $start, $limit";
	$result = mysql_query($sql);
	
	/* Setup page vars for display. */
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;						//last page minus 1
	
	/* 
		Now we apply our rules and draw the pagination object. 
		We're actually saving the code to a variable in case we want to draw it more than once.
	*/
	$pagination = "";
	if($lastpage > 1)
	{	
		$pagination .= "<div class=\"pagination\">";
		//previous button
		if ($page > 1) 
			$pagination.= "<a href=\"$targetpage?page=$prev\"> << previous</a>";
		else
			$pagination.= "<span class=\"disabled\"> << previous</span>";	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<span class=\"current\">$counter</span>";
				else
					$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= "<a href=\"$targetpage?page=1\">1</a>";
				$pagination.= "<a href=\"$targetpage?page=2\">2</a>";
				$pagination.= "...";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= "<a href=\"$targetpage?page=1\">1</a>";
				$pagination.= "<a href=\"$targetpage?page=2\">2</a>";
				$pagination.= "...";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) 
			$pagination.= "<a href=\"$targetpage?page=$next\">next >> </a>";
		else
			$pagination.= "<span class=\"disabled\">next >> </span>";
		$pagination.= "</div>\n";		
	}

				while ($record = mysql_fetch_array($result))
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
                                
                              # include './vogoo-2.2/vogoo/cronlinks.php' ;
                      //  unset($rating_data) ;                     
                   ?>
              <?=$pagination?> 
                    <?php
			$db->close();
                       // echo $ret."####################################3"  ;  
		?>
		</table>
		</div>
		
	</form>
</body>
</html>
