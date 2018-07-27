<?php

	/*
	* s:搜索词 不可与id重复
	* id：重这里开始搜索
	* pageindex ： 页面下标
	* pagemax ：一页最多显示
	* column ： 单独获取某一列或某几列的数据 用逗号分隔 例如 id,title
	* textmin：处理摘要，只取150个文字元素
	*/
	function gettime() {
	list($t1, $t2) = explode(' ', microtime());
	return (float)sprintf('%.0f',(floatval($t1)+floatval($t2))*1000);
	}

	$pageindex = 0;
	$pagemax = 5;
	if(isset($_GET['pageindex'])){
		$pageindex = $_GET['pageindex'];
	}
	if(isset($_GET['pagemax'])){
		$pagemax = $_GET['pagemax'];
	}

	if(isset($_GET['textmin'])){
		$textmin = boolval($_GET['textmin']);
	}else{
		$textmin = false;
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
	if(isset($_GET['column'])){
		$column = $_GET['column'];
	}else{
		$column = '*';
	}

	if(isset($_GET['id'])){
		$id = 'id <='. $_GET['id'];
	}else{
		$id = '';
	}
	$where = ($id?' WHERE '.$id:($text?' WHERE '.$id:''));
	//执行mysql查询
	if(isset($_GET['s'])){
		$sql = 'select '.$column.' from `fawf` '. $where;
	}else{
		$sql = 'select '.$column.' from `fawf` '. $where ." order by id desc ". "limit ". ((int)$pageindex * (int)$pagemax).",".($pagemax);
	}
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
		if($textmin == true && isset($row["text"]))$row["text"] = mb_substr($row["text"],0,100,"utf-8") . "…";
		//转换后插入查询总结果数组
		array_push($basedata,$row);
	}

	//输出结果
	if(isset($_GET['s'])){
		//排序数组SORT_DESC为倒叙，相似度越大越靠前
		array_multisort($sort,SORT_DESC,$basedata);

		$echodata = [];
		for($i=$pageindex*$pagemax;$i<($pageindex+1)*$pagemax;$i++){
			if(isset($basedata[$i]) === true){
				array_push($echodata,$basedata[$i]);
			}
		}
		
		echo(json_encode($echodata,JSON_UNESCAPED_UNICODE));
	}else{
		echo(json_encode($basedata,JSON_UNESCAPED_UNICODE));
	}
	//输出错误
	//echo($conn->error);
	//清空res缓存
	$res->close();
	$conn->close();
?>