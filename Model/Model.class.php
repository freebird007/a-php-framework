
 <?php 



defined('ACC')||exit('ACC Denied');
//Model父类，提供基本的增删改查功能，还有仿照thinkPHP制作的自动过滤，自动填充和自动验证功能
class Model{
	protected $table = NULL;//MODEL控制的表，需要在各类Model层中标明具体的$table值
	//protected $table = 'text';//MODEL控制的表
	protected $db=NULL;  //引入的MYSQL对象

	/*protected $pk='';

	protected $fields=array();
	protected $_auto=array();

	protected $_valid=array();
	protected $error=array();*/
	//用户名注册的方法
	/*
	*/

	public function __construct(){
		$this->db=mysql::getIns();
	}

	public function table($table){
		$this->table=$table;
	}

	/*
	  $_POST自动过滤
	  负责吧传来的数组
	  清除掉不用的单元
	  留下和表对应的单元
	  思路
	  循环数组，分别判断其KEY是否是表的字段
	  自然要先有表的字段
	  表的字段可以DESC表明来分析
	  也可以手动谢好
	  以TP为例  两者都行
	  */
	//在父类里增加四个最基本的增删改查操作 减少代码量

	/*
	param array $data
	return bool
	*/
	/*public function _facade($array=array()){
		$data=array();
		foreach($array as $k=>$v) {//只有表字段的需要$k
			if(in_array($k,$this->fields)){
				$data[$k]=$v;
			}  
		}
		return $data;
	}*/
	/*
	自动填充
	负责把表中需要的值而$_POST中没传的字段附上值
	比如$_post里没有add_time
	就自动把add_time传过来
	*/
	/*public function _autoFill($data){
		foreach ($this->_auto as $k => $v) {
			if(!array_key_exists($v[0], $data)){
				switch ($v[1]){
					case 'value':
					$data[$v[0]]=$v[2];
					break;
				}
				switch ($v[1]){
					case 'function':
					$data[$v[0]]=call_user_func($v[2]);//回调函数
					break;
				}
			}
		}
		return $data;
	}*/

	/*
	自动验证
	格式 $this->_valid=array(
			array('验证的字段',0/1/2(验证changing),'require/in(某几种情况)/between(范围)/length(长度)
	        )
	array('goods_name',1,'必须有商品名'，'required'),
		array('cat_id',1,'必须是整型值','number'),
		array('is_new',0,'in','is_new只能是0或者1','0,1'),
		array('goods_brief',2,'length','商品简介在10到100字符','10,200')
	*/
 	/*public function _validate($data){
 		if(empty($this->_valid)){
 			return true;
 		}
 		$this->error=array();
 		foreach ($this->_valid as $k=> $v) {
 			switch($v[1]){
 				case 1:
 				//echo $v[0],'<br>';
 					if(!isset($data[$v[0]])||empty($data[$v[0]])){
 						$this->error[]=$v[2];
 						return false;
				 	}
				 	if(!$this->check($data[$v[0]],$v[3])){
				 		$this->error[]=$v[2];
				 		return false;
				 	}
				 	break;
				case 0:
				//echo $data[$v[0]], ' ````` ',$v[3],' ````````  ',$v[4],'<br>';
					if(isset($data[$v[0]])){
						
						if(!$this->check($data[$v[0]],$v[3],$v[4])){
							$this->error[]=$v[2];

							return false;
						}
					}
					
				break;

				case 2:
				    //echo $data[$v[0]];
					if(isset($data[$v[0]])&&!empty($data[$v[0]])){
						if(!$this->check($data[$v[0]],$v[3],$v[4])){
							$this->error[]=$v[2];
							return false;
					}
				}
				
 			


 			}

 		}
 		return true;
 	} 
 	
 	public function getErr(){
 		return $this->error;
 	}
 	public function check($value,$rule='',$parm=''){
 		 switch($rule){
 		 	case 'require':
 		 		return !empty($value);
 		 	case 'number':
 		 		return  is_numeric($value);
 		 	case 'in':
 		 	//echo '````123```',$parm,'``',$value,'<br>';
 		 		$tmp=explode(',', $parm);
 		 		//print_r($tmp);
 		 		return in_array($value,$tmp);
 		 	case 'between':
 		 		list($min,$max)=explode(',', $parm);
 		 		return $value>=$min && $max<= $max;
 		 	case 'length':
 		 		list($min,$max)=explode(',', $parm);
 		 		return strlen($value) >=$min && strlen($value) <=$max;
 		 	default:
 		 		return false;
 		 }
 	}
*/









 	//往数据库添加数据
	public function add($data){
		return $this->db->autoExecute($data,$this->table,'insert');
	}

	//获取表下所有数据
	public function select(){
		$sql='select * from ' . $this->table;

		return $this->db->getAll($sql);
	}
	//删除操作
	/*
	param int $id
	return int影响的行数
	*/
	public function delete($id=0){
		$sql='delete from ' . $this->table . ' where ' . $this->pk . '=' . $id;
		if($this->db->query($sql)){
			//返回受影响的行数，判断才准确
			return $this->db->affectRows();
		}else{
			return false;
		}
	}
	/*
	param array $data
	param int $id
	return int 影响行数*/
	public function update($data,$id=0){
		$rs=$this->db->autoExecute($data,$this->table,'update', $this->pk. '=' . $id);
		if($rs){
			return $this->db->affectRows();
		}else{
			return false;
		}
	} 
	//取出一行数据
	/*
	param int $id
	return int查找到的数据*/
	public function find($id){
		$sql='select * from ' . $this->table . ' where ' . $this->pk . '=' . $id;

		return $this->db->getRow($sql);
	}



}
?>