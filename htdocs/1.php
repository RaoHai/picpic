<?php
$mem = new Memcache;
$mem->connect("127.0.0.1", 11211);
$mem->set('key', 'This is a test!', 0, 60);
$val = $mem->get('key');
echo $val;
require_once('abc.php');
?>
