<?php
	header("Content-type:text/html;charset=utf-8");
	if(@$res !== true){
		echo('服务器禁止了您的访问！');
		exit();
	}

	$conn = new mysqli('localhost',"root","root");
	$conn->set_charset('utf-8');
	$res = $conn->query('create database `postaccess` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci');
	$conn->select_db('postaccess');
	
	$sql = 'create table `fawf`(
		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
		title VARCHAR(255) NOT NULL,
		lastname VARCHAR(30) NOT NULL,
		email VARCHAR(50),
		reg_date TIMESTAMP,
		KEY title (title)
		)CHARSET=utf8;';
	$res = $conn->query($sql);
?>