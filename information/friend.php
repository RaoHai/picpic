<?php
require_once('..\handler.php');
session_start();
$imgView->showinformation();
$friend=$imgView->GetFriend($_SESSION['user']);
for($i=0;$friend[$i]!=NULL;$i++)
{
echo $friend[$i];
}
?>