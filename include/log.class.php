<?php 

defined('ACC')||exit('ACC Denied');

/*
file log.class.php
作用 记录信息到日志
*/

/*
思路
给定内容 写入文件(fopen fweite..)
如果文件大于1M，重新写一份
,传过来一个内容
判断大小
如果>1m 备份
否则 写入
*/
class log{
	const LOGFILE='curr.log';//建立一个常量 代表日志文件的名称

	//写日志的
	public static function write($cont){
		$cont.="\r\n";  //进行换行
		$log=self::isBak();//计算出日志文件的地址，判断是否备份
		$fh=fopen($log,'ab');
		fwrite($fh, $cont);
		fclose($fh);
		//return 1;
	}
	//备份日志
	public static function bak(){
		//把原来的日志文件改个名，存储起来
		//g改成 年-月-日.bakc
		//$log=ROOT.'data/log/curr.log';
		$log=ROOT . 'data/log/' . self::LOGFILE;
		$bak=ROOT . 'data/log/' . mt_rand(10000,99999) . '.bak';
		/*if(!rename($log, $bak)){
			echo 'fail'; exit;
		}else{
			echo 'succ';exit;
		}*/
		return rename($log, $bak);
	}

	//读取并判断日志的大小
	public static function isBak(){
		$log=ROOT.'data/log/' . self::LOGFILE;
		if(!file_exists($log)){
			touch($log);//不存在则创建文件；LINUX下也有这个命令
			return $log;
		}
		//清除缓存
		//!!!!!!!避免一次性连续写入大于1M的文件，没有将超过1M的文件备份出来，而需要等下次重新写入的时候才可以重新创建新的urr.log；
		clearstatcache(true,$log);
		//存在，判断大小
		$size=filesize($log);

		if($size<=1024*1024){
			return $log;
		}
		//走到这一行说明大于1M 调用bak（）；
		if(!self::bak()){
			return $log;
		}else{
			touch($log);
			return $log;
		}
	}
	

}


?>