<?php
	header("Content-type:text/html;charset=utf-8");
	if(@$res !== true){
		echo('服务器禁止了您的访问！');
		exit();
	}

	$conn = new mysqli('127.0.0.1',"root","root");
	$conn->set_charset('utf-8');
	$res = $conn->query('create database `postaccess` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci');
	$conn->select_db('postaccess');
	
	$sql = 'create table `fawf`(
		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
		cover VARCHAR(1024),
		title VARCHAR(255) NOT NULL,
		text TEXT NOT NULL,
		volume INT NOT NULL,
		replyindex INT NOT NULL,
		reg_date TIMESTAMP 
		)CHARSET=utf8;';
	$res = $conn->query($sql);
?>