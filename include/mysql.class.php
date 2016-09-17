<?php


defined('ACC')||exit('ACC Denied');

class Mysql extends db{
	private static $ins=NULL;
	private $conf=array();
	private $link=NULL;
	protected function __construct(){
		$this->conf=conf::getIns();
		$this->conn($this->conf->host,$this->conf->user,$this->conf->password);
		$this->select_db($this->conf->db);
		$this->setChar($this->conf->charset);
	}
	public function __destruct(){

	}
	public static function getIns(){
		if(self::$ins===null){
			self::$ins=new self();
		
		}
		return self::$ins;
	}
	/**
	*连接数据库 从配置文件读取配置信息
	*
	**/
	public function conn($h,$u,$p){
		$this->link=new mysqli($h,$u,$p);
		/*if(!$this->conn){
			echo '连接失败';
		}*/
	}
	/*
	连接db
	*/
	public function select_db($db){
		$sql='use ' . $db;
		return $this->query($sql);
	}
	/*
	设置字符集
	*/
	public function setChar($charset){
		$sql='set names ' . $charset;
		return $this->query($sql);
	}


	/*
	*
	*执行sql语句
	*@param string $sql
	*@return mixed 返回bool或者资源
	**/
	public function query($sql){
		log::write($sql);
		return $this->link->query($sql);
	}
	/**
	*查询select语句 返回多行，用于查询多条数据
	*
	*@param string $sql select语句
	*@return mixed array 或者false
	*/

	public function getAll($sql){
		$res=$this->query($sql);
		$data=array();
		while($row=$res->fetch_assoc()){
				//print_r($row);
				$data[]=$row;
		}
		return $data;
	}

	public function getRow($sql){
		$res = $this->query($sql);
		$row = $res->fetch_assoc();
		return $row;
	}
	

	public function getOne($sql){
		$res = $this->query($sql);
		$row= $res->fetch_row()[0];
		return $row;

	}
	/**
	*拼接sql语句
	*@param array $data 要插入或者更改的数据，键代表列名，值为新值
	*@param arr $data 接收到的数据，一维数组
	*@param str $cat 动作 默认为'insert'
	*@param str $where 防止
	*@param bool insert 或者update 插入成功或者失败
	*/
	public function autoExecute($data , $table , $act='insert' , $where='0'){
		if($act == 'insert'){
			//插入语句
			$sql="insert into $table (";
			$sql.=implode(',',array_keys($data)) . ") values('";
			$sql.=implode("','",array_values($data)) . "')";
			//print_r($sql);
			//return $this->query($sql);
		}else if ($act='update') {
			//update ** set name='aa', age='10' where id=1;
			$sql = "update $table set ";
			foreach($data as $k=>$v) {
				$sql .= $k . "='" . $v . "',";
			}
			
			$sql = rtrim($sql , ',') . " where ".$where;
			//print_r($sql);
			//return $this->query($sql);
		}
		return $this->query($sql);
	}
	//获取上一步操作影响地行数
	public function affectRows(){
		return $this->link->affected_rows;
	}
	////获取自增长的ID值
	public function insert_id(){
		return $this->link->insert_id;
	}
}


//$Mysql=new Mysql();
//$a->conn();
//$b=$a->getOne('select name from user where id=1');
//$a->Exec(['id'=>8,'name'=>'zea','age'=>'5'] , 'user' , 'insert');
//$b=$a->Exec(['id'=>'2','name'=>'zexian','age'=>'10'], 'user' , 'update','id=2');
/*$a->Exec(['name'=>'zeaaaaa'] , 'user' , 'update', 'age=5');
print_r($a->affectRows());*/
//echo $b;
?>

