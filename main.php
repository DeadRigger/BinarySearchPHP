<?php
function binary_search($file_path, $val_key){
	if(file_exists($file_path)) {
		$size = filesize($file_path);
		$fp = fopen($file_path, 'r');
		$up = 0;
		$down = $size;
		$current = $size;
		$key = '';
		while(true) {
			$current = (int)($down+$up)/2;
			fseek($fp, $current);
			fgets($fp);
			$row = fgets($fp);
			$res = explode(chr(9), $row);
			if($key == $res[0]){
				if($up == $current) {
					return 'undef';
				} else {
					$current = $up;
					fseek($fp, $current);
					$row = fgets($fp);
					$res = explode(chr(9), $row);
				}
			}
			$key = $res[0];
			$value = $res[1];
			$cmp = strcmp($val_key, $key);
			if($cmp < 0) {
				$down = $current;
			} elseif($cmp == 0) {
				return $value;
			} else {
				$up = $current;
			}
		}
		
		fclose($fp);
	}
	else echo "File does not exist";
}
?>