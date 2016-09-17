<?php 


defined('ACC')||exit('ACC Denied');

/*
file db.class.php

数据库类，连接数据库
*/

abstract class db{

	/**
	*链接服务器
	*@param  $h 服务器地址
	*@param $u 用户名
	*@param $p 密码
	**/
	public abstract function conn($h,$u,$p);
	/**
	*发送查询
	*@param  string $sql 发送查询的sql语句
	*@return mixed bool/resource
	**/
	public abstract function query($sql);

	/**
	*查询多行数据
	*@param string $sql select型语句
	*@return array/false
	**/
	public abstract function getAll($sql);

	/**
	*查询一行数据
	*@param string $sql select型语句
	*@return array/false
	**/
	public abstract function getRow($sql);
	/**
	*查询单个数据
	*@param string $sql select型语句
	*@return int /false
	**/
	public abstract function getOne($sql);

	/**
	*insert、update  拼接sql语句
	*@param arr $table 要插入的或者更改的数据，键 代表列名 值为新值
	*@param arr $data接受的数据
	*@param string $act 动作
	*@param string $where 防止出错
	*@return int /false
	**/
	public abstract function autoExecute($table,$data,$act='insert',$where='0');

	public abstract function affectRows();

}
?>