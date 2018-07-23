<?php
	header("Content-type:text/html;charset=utf-8");
	$conn = new mysqli('localhost',"root","root");
	$conn->set_charset('utf-8');
	$res = $conn->query('create database `postaccess` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci');
	$conn->select_db('postaccess');
	
	/*$sql = 'create table `fawf`(
		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
		title VARCHAR(255) NOT NULL,
		lastname VARCHAR(30) NOT NULL,
		email VARCHAR(50),
		reg_date TIMESTAMP,
		KEY title (title)
		)CHARSET=utf8;';
	$res = $conn->query($sql);
	$sql = 'insert into `fawf`(title,lastname,email,reg_date)values("没有人能够突破我的枪围","赵信","",NOW())';
	$res = $conn->query($sql);*/
	$search = '我的枪';
	$seo = ['我的枪','娃'];
	$text = '';
	for($i=0;$i<count($seo);$i++){
		$text.= '(title like "%'.$seo[$i].'%")'.($i==count($seo)-1?'':' or ');
	}
	$sql = 'select * from fawf WHERE '.$text;
	$res = $conn->query($sql);
	$basedata = [];
	$sort = [];
	while($row = $res->fetch_object()){
		array_push($sort,similar_text($row->title,$search));
		$row = json_encode($row,JSON_UNESCAPED_UNICODE);
		$row = json_decode($row,true);
		array_push($basedata,$row);
	}
	//asort($basedata['index']);
 	array_multisort($sort,SORT_DESC,$basedata);
	echo(json_encode($basedata,JSON_UNESCAPED_UNICODE));
	//similar_text ( 'title' ,$search)
	echo($conn->error);
	//$res = $conn->query('select * from user');
	//$res->close();
	$conn->close();
?>