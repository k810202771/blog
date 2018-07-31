<?php
	//要访问conn必须设置res为true
	$res = true;
	//引入conn 请在文件结尾 关闭数据库 $conn->close();
	require('conn.php');

	function getChar($num)  // $num为生成汉字的数量
	{
		$b = '';
		for ($i=0; $i<$num; $i++) {
			// 使用chr()函数拼接双字节汉字，前一个chr()为高位字节，后一个为低位字节
			$a = chr(mt_rand(0xB0,0xD0)).chr(mt_rand(0xA1, 0xF0));
			// 转码
			$b .= iconv('GB2312', 'UTF-8', $a);
		}
		return $b;
	}
	for($i=0;$i<5;$i++){
		$sql = 'insert into `babel`(babelName)values("web")';
		$res = $conn->query($sql);
	}

	for($i=0;$i<4000;$i++){
		$sql = 'insert into `articleData`(title,cover,text,volume,replyindex,reg_date,babel)values("'.'我的'.getChar(15).'","","'.getChar(20000).'","'.mt_rand(1,10).'","'.mt_rand(1,10).'",NOW(),"[1]")';
		$res = $conn->query($sql);
	}

	//关闭数据库
	$conn->close();
?>