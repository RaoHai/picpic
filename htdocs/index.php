<?php
//header("content-Type: text/html; charset=utf-8");
error_reporting(E_ALL);
   
   // error_reporting(0);

    defined('BASE_PATH')  
	|| define('BASE_PATH', realpath(dirname(__FILE__)).'/../');    
	defined('INDEX_PATH')  
	|| define('INDEX_PATH', realpath(dirname(__FILE__)));
    defined('APPLICATION_PATH')
	|| define('APPLICATION_PATH', BASE_PATH . '/application');
    defined('APPLICATION_ENV')
        || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));
    defined('WEB_ROOT')
        || define('WEB_ROOT', BASE_PATH . 'www');

       

  

session_start();
if(empty($_SESSION["permission"])) $_SESSION["permission"]="guest";
define("WEB_AUTH",TRUE);

include_once APPLICATION_PATH.'/route.php';

?>