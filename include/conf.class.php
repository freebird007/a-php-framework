<?php 


defined('ACC')||exit('ACC Denied');
/*

file conf.class.php
配置文件读写类
使用单例模式
*/


class conf{

	protected static $ins= null;
	protected $data=array();
	final protected function __construct(){
		//把配置文件信息赋给data属性
		//之后配置信息直接从data中找
		//include("./config.inc.php");
		include(ROOT.'include/config.inc.php');

		$this->data = $_CFG;
	}

	final protected function __clone(){
	}
	public static function getIns(){
		if(self::$ins instanceof self){
			return self::$ins;

		}else{
			self::$ins=new self();
			return self::$ins;
		}
	}
	//$data是受保护权限，可以用魔术方法读取data内的信息，然后return出来
	public function __GET($key){
		if(array_key_exists($key,$this->data)){
			return $this->data[$key];
		}else{
			return null;
		}
	}

	//用魔术方法在运行期动态增加或改变配置选项
	public function __set($key,$value){
		$this->data[$key]=$value;
	}


	
}

/****
$conf=conf::getIns();
print_r($conf);
//conf Object ( [data:protected] => Array ( [host] => localhost [user] => root [pwd] => ) )
echo '<br>';
echo $conf->host;
echo $conf->user;

//动态追加选项
$conf->template_dir='D:/www/smarty';
echo $conf->template_dir;
print_r($conf);
****/

?>