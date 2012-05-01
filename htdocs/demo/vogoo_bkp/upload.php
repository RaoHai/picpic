<html>
<head><h1>Status</h1></head>
<body>
<?php
  echo "Upload: " . $_FILES["file"]["name"] . "<br />";
  echo "Type: " . $_FILES["file"]["type"] . "<br />";
  echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
  echo "Stored in: " . $_FILES["file"]["tmp_name"];
  $file_name = "/home/bharath/public_html/vogoo_interface/upload/".$_FILES["file"]["name"];
   
if(move_uploaded_file($_FILES["file"]["tmp_name"],$file_name))
{
	echo "<br/><h1>File Uploaded</h1>";
}
else
{
	echo "<br/><h1>File upload Failed</h1>";
}
$ratings_file = fopen($file_name,'r');
while($ratings = fgets($ratings_file))
{
	list($member_id,$product_id,$rating) = split(" ",$ratings,3);
	echo $member_id." ".$product_id." ".$rating."<br/>";
}
?>
</body>
</html>