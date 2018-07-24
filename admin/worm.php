<?php
	class worm{
		public function utf8_strlen($string = null) {
			// 将字符串分解为单元
			preg_match_all("/./us", $string, $match);
			// 返回单元个数
			return count($match[0]);
		}
		//取文本中间
		public function str_center($str){
			$array = array();
			$length = $this -> utf8_strlen($str);
			switch($length){
				case 1:
					array_push($array,$str);
					return $array;
				 break;
				default:
					for($i=0;$i< $length - 1;$i++){
						array_push($array,mb_substr($str,$i,2,'utf8'));
					}
					return $array;
				break;
			}
		}
	}
?>