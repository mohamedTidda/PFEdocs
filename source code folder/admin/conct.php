<?php
$dbn='mysql:host=localhost;dbname = PFE_DB';
$user='root';
$pass='';
$option=array(
	PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
);
try{
	$con= new PDO($dbn,$user,$pass,$option);
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
	 echo 'failed'.$e->getMessage();
}
			