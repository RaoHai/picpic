<?php

/**

 * ʵ��·�� ��֤ Ȩ����֤���Լ� ��ʼ��

 */

defined("WEB_AUTH") || die("NO_AUTH");

/**

 * �������������ļ�

 */

include_once 'config.ini.php';
//include_once 'route.ini.php';
//include_once 'mvc.ini.php';
//include_once 'role.ini.php';
include_once 'lib/acl.php';
include_once 'lib/uploader.php';
include_once 'lib/cache.php';
include_once 'route/route.class.php';
include_once 'global.func.php';

$route = new Route();

//include_once 'common.ini.php';
//$route->run();

?>