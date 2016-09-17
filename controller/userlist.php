<?php 

define('ACC',true);

require('../include/init.php');

$xy=new TestModel();

$list=$xy->select();

//print_r($xy->select());


include(ROOT . 'view/userlist.html');
?>