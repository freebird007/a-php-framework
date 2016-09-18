<?php 


define('ACC',true);//include文件夹中的配置文件为了避免被直接访问，都会检测是否设置了ACC常量
/*
所有由用户直接访问到的页面
都要先加载init.php
*/


require('./include/init.php');
//require(ROOT . 'controller/cateadd.php');

//测试配置文件
/*$conf=conf::getIns();
//读取选项
echo $conf->host;
echo $conf->user;
//动态追加选项
$conf->template_dir='D:/www/smarty';
echo $conf->template_dir;
print_r($conf);*/




//测试LOG日志记录功能
/*class mysql{
	public function query($sql){
		//xxxx查询
		//记录
		//log::write('记录');
		log::write($sql);
	}
}
$mysql=new mysql();
for($i=0;$i<8000;$i++){
	$sql='from mytext.select * from mytext.select * from mytext.select * from mytext.select * from mytext.select * from mytext.select * from mytext.select * from mytext.select * from mytext.' . mt_rand(1,1000);
	$mysql->query($sql);
	usleep(500);
}

echo 'OK';*/

//print_r($_GET);
//测试mysql类是否可以正常添加数据。
/*$mysql=Mysql::getIns();
print_r($mysql);
$t1=$_GET['t1'];
$t2=$_GET['t2'];
//$sql="insert into text(t1) values('$t1')";
var_dump($mysql->autoExecute($_GET,'text','insert'));
*/
?>