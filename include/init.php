<?php 

defined('ACC')||exit('ACC Denied');//定义一个ACC常量，避免框架的核心文件被恶意直接访问

/*
file init.php
框架初始化

*/
//初始化当前的绝对路径
//换成正斜线兼容linux
define('ROOT',str_replace('\\','/', dirname(dirname(__FILE__))).'/');
//define('ROOT',dirname(__DIR__));//php5.3以后版本的可以支持__DIR__


/*require(ROOT . 'include/db.class.php');
require(ROOT . 'include/conf.class.php');
require(ROOT . 'include/log.class.php');
require(ROOT . 'include/mysql.class.php');
require(ROOT . 'Model/Model.class.php');
require(ROOT . 'Model/TestModel.class.php');*/
require(ROOT . 'include/lib_base.php');

//自动加载
function __autoload($class){
	if(strtolower(substr($class, -5))=='model'){
		require(ROOT . 'Model/' . $class . '.class.php');
	}else{
		require(ROOT . 'include/'  . $class .'.class.php');
	}
}

//过滤参数，用递归的方式过滤$_GET  $_POST  $_COOKIE
$_GET=_addslashes($_GET);
$_POST=_addslashes($_POST);
$_COOKIE=_addslashes($_COOKIE);



//报错级别
define('DEBUG',true);

if(defined('DEBUG')){
	error_reporting(E_ALL);
}else{
	error_reporting(0);
}


?>