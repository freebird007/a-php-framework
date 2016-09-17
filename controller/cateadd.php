<?php 


define('ACC',true);
require('../include/init.php');
/*

MVC开发方式
接受数据
检验数据

把数据交给MODEL去写入数据库

判断MODEL的返回值
*/



//接收
$data['catename']=$_POST['catename'];
$data['intro']=$_POST['intro'];


//检验判断
if($data['catename']==''||$data['intro']==''){
	include(ROOT . 'view/cateaddform.html');
}else{

	//调用MODEL

	$cateModel=new CateModel();

	if($cateModel->add($data)){
		$res=true;
	}else{
		$res=false;
	}

	//
	echo $res?'成功':'失败';
}
?>