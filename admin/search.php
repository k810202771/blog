<?php
	$pageindex = 0;
	$pagemax = 5;
	if(isset($_GET['pageindex'])){
		$pageindex = $_GET['pageindex'];
	}
	if(isset($_GET['pagemax'])){
		$pagemax = $_GET['pagemax'];
	}
	//引入文件
	//要访问conn必须设置res为true
	$res = true;
	//引入conn 请在文件结尾 关闭数据库 $conn->close();
	require('conn.php');
	require('worm.php');

	//创建实例
	$worm = new worm();
	if(isset($_GET['s'])){
		$search = $_GET['s'];
	}else{
		$search = '';
	}
	//分割字符串成 N 个词组 N = strlen - 1
	$seo = $worm -> str_center($search);
	//初始化查询条件字符串
	$text = '';
	//for 拼接查询条件字符串
	for($i=0;$i<count($seo);$i++){
		$text.= 'title like "%'.$seo[$i].'%"'.($i==count($seo)-1?'':' or ');
	}
	//执行mysql查询
	$sql = 'select * from `fawf` '.($text?' WHERE '.$text:'');

	//. ' limit '.$pageindex.','.$pagemax

	//res为查询结果 记得清除res的查询结果，res -> close()
	$res = $conn->query($sql);
	//查询总结果数组初始化数据
	$basedata = [];
	//查询结果排序数组初始化数据
	$sort = [];
	while($row = $res->fetch_object()){
		//插入相似度数值
		array_push($sort,similar_text($row->title,$search));
		//PHP object转array 利用 php 的 json 方法处理
		$row = json_encode($row,JSON_UNESCAPED_UNICODE);
		$row = json_decode($row,true);
		//转换后插入查询总结果数组
		array_push($basedata,$row);
	}
	//排序数组SORT_DESC为倒叙，相识度越大越靠前
 	array_multisort($sort,SORT_DESC,$basedata);

	$echodata = [];
	for($i=$pageindex*$pagemax;$i<($pageindex+1)*$pagemax;$i++){
		if(isset($basedata[$i]) === true){
			array_push($echodata,$basedata[$i]);
		}
	}
	//输出结果
	echo(json_encode($echodata,JSON_UNESCAPED_UNICODE));
	//输出错误
	//echo($conn->error);
	//清空res缓存
	$res->close();
	$conn->close();
?>