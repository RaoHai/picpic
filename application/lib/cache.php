<?php
/* 缓存类
* 缓存前端：输出缓存、数据库抽象化缓存、文件缓存
* 缓存后端：memcache、数据库、文件
* 同样作为一个静态对象
*/
class Cache
{
	static protected $ob; 
	static private $_instance = NULL;
    static public $memcache;
	static public function getInstance() 
	{
		if (is_null(self::$_instance) || !isset(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$memcache;
	}
    private function __construct()
    {
        self::$memcache = new Memcache;
        self::$memcache->connect("127.0.0.1",11211);

    }
 
    
	
	
}

?>
