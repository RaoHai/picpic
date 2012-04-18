<?php

/* ---------------------------
   路由类
   -----------------------------//  */
defined("WEB_AUTH") || die("NO_AUTH");
include_once 'route.ini.php';

class Route
{
    private $_moudle;
    private $_controller;
    private $_action;
    private $_uri;
    private $_param;
    //mvc资源
    private $moudle_arr;
    //路由资源
    private $route_arr;

    private $_default = array('module' => 'default',
            'conttoller' => 'index',
            'action' => 'index');

    public function __construct($uri = NULL)
    {
        global $moduleArr,$routeArr;
        $this->moudle_arr  = $moduleArr;
        $this->route_arr   = $routeArr;
     //if apache
        $uri == NULL && $uri = $_SERVER['REDIRECT_URL'];
	// if nginx:
	//$uri == NULL && $uri = $_SERVER['REQUEST_URI'];
        $this->_uri   = $uri;
        $this->init();


    }

    private function parseUri($uri = NULL)
    {
        global $routeArr;
        $uri == NULL && $uri = $this->_uri;


        foreach($routeArr as $regex=>$mvc)
        {

            //if(preg_match($regex,$uri,$matches))
            //{

            $uri =  preg_replace($regex,$mvc,$uri);
            //echo $uri."</br>";


            //var_dump($matches);

            //$this->uriArr = array($mvc["controller"],$mvc["action"],$mvc["param"]);
            //}

        }
        //die();
        $this->uriArr = explode('/',substr($uri,1));
        $this->uriArr && $this->uriArr = array_filter($this->uriArr);
        //var_dump($this->uriArr);
        //echo "==>".$this->uriArr[1];
    }

    private function init()
    {
        //$cache = Cache::getInstance();
        //Cache::op_cache_start();
        $this->parseUri();   
        $this->parseRoute();
        $this->dispatcher();
        //	Cache::op_cache_stop();
    }
    private function parseRoute()
    {
        $this->_module= (isset( $this->uriArr[0]) ? $this->uriArr[0] : 'index');
        $this->_controller=(isset( $this->uriArr[0]) ? $this->uriArr[0] : 'index');
        $this->_action =(isset( $this->uriArr[1]) ? $this->uriArr[1] : 'index');
        $this-> _param= (isset( $this->uriArr[2]) ? $this->uriArr[2] : '');
        //echo $this->_module."|".$this->_controller."|".$this->_action.":".$this-> _param;

    }

    private function dispatcher()
    {
        global $Permissions;
        $controllerfile = APPLICATION_PATH."/controllers/controller.{$this->_controller}.class.php";
        $controllerName =$this->_controller;
        $func = "_".$this->_action;
        $param = $this->_param;
        //echo "C:". $controllerName.",A:".$this->_action;
        // echo $Permissions[$controllerName];
        //$acl= loadser();
        $permission = $_SESSION["permission"];
        //echo  $_SESSION["permission"];
        $acl = Acl::getInstance();
        if(!$acl->GetFromCached())
        {
            $acl->addRole("guest");
            $acl->addRole("user");
            $acl->allow("guest","index");
            $acl->allow("user","index");
            $acl->allow("user","user");
            $acl->allow("user","imagegroup");
            $acl->allow("user","comments");
            $acl->allow("user","image");
            $acl->allow("user","information");
            $acl->allow("user","profile");
            $acl->allow("user","group");
            $acl->allow("user","friend");
            $acl->allow("user","active");
            $acl->allow("user","message");
            $acl->allow("user","favourite");
            $acl->allow("user","cover");
            $acl->allow("user","tags");
            $acl->allow("guest","user","loginpage");
            $acl->allow("guest","user","login");
            $acl->allow("guest","user","logout");
            $acl->allow("guest","user","register");
            $acl->allow("guest","user","checkemail");
            $acl->allow("guest","user","checkname");
            $acl->allow("guest","user","new");
            $acl->allow("guest","imagegroup","view");   
            $acl->allow("user","recommend");
            $acl->SaveToCached();
        }
        //}
        //$acl->allow("guest","user");

        //echo $permission;
        if (file_exists($controllerfile) && ($acl->isallowed($permission,$controllerName)||$acl->isallowed($permission,$controllerName,$this->_action)))
        {


            $Instance = new $controllerName();
            $Instance-> $func ($param);


        }
        else
        {
            //echo "权限不足";
            Header("Location: /user/loginpage?".$this->_uri."");
        }


    }

    public function GetModule()
    {
        if(empty($this->_module)) $this->_module="index";
        return $this->_module;
    }
    public function GetController()
    {
        if(empty($this->_controller)) $this->_controller="index";
        return $this->_controller;
    }
    public function GetAction()
    {
        if(empty($this->_action)) $this->_action="index";
        return $this->_action;
    }


}

?>
