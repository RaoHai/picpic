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
<div id="go_home" align="left"><a href="index.php">Home</a></div><br/>
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
                        if ($member_id == '') {
                            $member_id = $_GET['member_id'];
                        }
                        echo "<h3>Recommended Items for user ID $member_id</h3>" ;
                        if ($member_id != ''){
                        echo "<a href='user_items.php?member_id=$member_id'>Items rated by user id $member_id (training data)</a> <br/>"; 
                        echo "<a href='user_items_test.php?member_id=$member_id'>Items rated by user id $member_id (test data)</a> <br/>"; 
                        }
			$user = "vogoo";
			$user_password = "";
			$db_name = "vogoo_web";
			$db = new mysqli ("localhost", $user, $user_password, $db_name);
			
			if($member_id!='')
			{
				//echo $member_id;
				//$ret = $vogoo_items->member_get_recommended_items($member_id);	
				$ret = $vogoo_items->member_predict_all($member_id,1,false);	
				if(!$ret)
				{
					echo "Failed : No Recommendations for this user (Please check if you entered a valid user id)"."<br>";
				}
				/*else
				{
				//	echo "passed";
				}*/
			}
			echo "<tr>";
			echo "<td align=\"center\">";
			echo "<b>Recommended Item Ids</b>";
			echo "</td>";
			echo "<td align=\"center\">";
			echo "<b>Predicted Ratings for Recommended Item</b>";
			echo "</td>";
			echo "<td align=\"center\">";
			echo "<b>Actual rating ( if available) </b>";
			echo "</td>";
			echo "<td align=\"center\">";
			echo "<b>Absolute error </b>";
			echo "</td>";
			echo "<td align=\"center\">";
			echo "<b> squared error </b>";
			echo "</td>";
			echo "<td align=\"center\">";
			echo "<b>Recommended Item Names</b>";
			echo "</td>";
			echo "</tr>";
                        /*while($result = mysql_fetch_array($ret,$db) ) {

                                echo "<tr>" ;
                                echo "<$td align=\"center\">" ;
                                echo $result['product_id'] ; 
                                echo "</td>";  
                                echo "<$td align=\"center\">" ;
                                echo $result['rating'];
                                echo "</td>";  
				$query ='select name from movies where id = '.$pieces[0];
				if($rating_data = $db->query($query))
				{
					$record = $rating_data->fetch_array(MYSQLI_BOTH);
					echo $record['name'];
				}
				echo "</td>";
				echo "</tr>";

                        }*/
                        $count = 0 ;
                        $sum_error_1 = 0 ;
                        $sum_error_2 = 0 ;
			foreach($ret as $recommended_item)
			{
			        $flag = 0 ;
                                //$pieces = explode(" ",$recommended_item);
				echo "<tr>";
				echo "<td align=\"center\">";
                                $product_id = $recommended_item[0] ;	
				echo $recommended_item[0];
				echo "</td>";
				echo "<td align=\"center\">";
                                $predicted = $recommended_item[1];
                                printf("%.2f",$recommended_item[1]);	
				//echo $recommended_item[1];
				echo "</td>";
				echo "<td align=\"center\">";
				$query_actual_rating = " select rating from vogoo_test where product_id = $recommended_item[0] and member_id = $member_id " ;
                                if( $rating_result = $db->query( $query_actual_rating) ) {
                                                   
                                               if($row = $rating_result->fetch_array(MYSQLI_BOTH)){
                                               $actual = $row['rating']/5.0 ;
                                               echo $actual ;
                                               $count++ ; 
				               }
				               else {
                                                echo "-";
                                                $flag=1 ;
				               }
                                }
                                else {
                                       echo "could not execute query ".mysql_error() ;
                                }
				echo "</td>";
				echo "<td align=\"center\">";
                                // MEAN ABSOLUTE
                       		 if ( $flag == 0 ) {       
                                 $error_1 = abs($actual - $predicted) ;
                                 $sum_error_1 += $error_1 ; 
                                      
                                printf("%.2f",$error_1);
                                }
				else{
                                   echo "-" ;
				} 								
				echo "</td>";
				echo "<td align=\"center\">";
                                 if ($flag == 0){
                                 $error_2 = ($actual - $predicted)*  ($actual - $predicted) ;
                                 $sum_error_2 += $error_2 ; 
                                printf("%.4f",$error_2);
				}
 				else{
				   echo "-" ;
				}	
				echo "</td>";
				echo "<td align=\"center\">";
				$query ='select name from movies where id = '.$recommended_item[0];
				if($rating_data = $db->query($query))
				{
					$record = $rating_data->fetch_array(MYSQLI_BOTH);
					echo $record['name'];
				}
				echo "</td>";
				echo "</tr>";
			}
                        echo "<font color='GREEN'> Number of Actual ratings found :: ".$count."</font><br>" ;
                        if ($count == 0){
                        echo "<font color='GREEN'> MAE :: ".$count."</font><br>" ; 

			} 
       			else{
                        echo "<font color='GREEN'> MAE :: ".$sum_error_1/$count."</font><br>" ;
                        } 
                        //echo " MSE ".$sum_error_2/$count."<br>" ; 
                        echo "<font color='GREEN'> RMSE :: ".sqrt($sum_error_2/$count)."</font><br>" ; 

			$rating_data->close();
			$db->close();
                        //echo " Number of Actual ratings found ".$count."<br>" ; 
                        //echo " MAE ".$sum_error_1/$count."<br>" ; 
                        //echo " MSE ".$sum_error_2/$count."<br>" ; 
                        //echo " RMSE ".sqrt($sum_error_2/$count)."<br>" ; 
		?>
		</table>
		</div>
		
	</form>
</body>
</html>
