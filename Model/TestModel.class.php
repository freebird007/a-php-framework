<?php 

//数据模型  对应业务模型   许多的业务模型，比如前后台登录，前后台注册等，只需要一个数据模型即可
//可以有很多MODEL，但是为了避免多次实例化对象，可以造一个父类，提高效率，比如Model.class.php
class TestModel extends Model{
	/*protected $table = 'text';
	protected $db=NULL;

	//用户名注册的方法
	
	public function __construct(){
		$this->db=mysql::getIns();
	}*/
	protected $table = 'text';
	public function reg($data){
		return $this->db->autoExecute($data,$this->table,'insert');
	}
	public function select(){
		return $this->db->getAll('select * from ' . $this->table);
	}
}



?>