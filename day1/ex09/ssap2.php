#!/usr/bin/php
<?php
	function my_compare($str1, $str2) {
		$sort_logic = "abcdefghijklmnoprstuvwxyz0123456789!\"#$%&'()*+,-./:;<=>?@[\\]^_`{|}~";
		for ($i = 0; $str1[$i] && $str2[$i]; $i++) {
			$location1 = strpos($sort_logic, strtolower($str1[$i]));
			$location2 = strpos($sort_logic, strtolower($str2[$i]));
			if ($location1 > $location2) {
				return (TRUE);
			} else if ($location1 < $location2) {
				return (FALSE);
			}
		}
		if (!$str2[$i]) {
			return (TRUE);
		}
		return (FALSE);
	}
	$arr = array();
	array_shift($argv);
	foreach ($argv as $value) {
		$temp = array_filter(explode(' ', $value));
		foreach ($temp as $members) {
			array_push($arr, $members);
		}
	}
	$arr_length = count($arr) - 1;
	for ($iter = 0; $iter < $arr_length; $iter++) {
		for ($index = 0; $index < $arr_length; $index++) {
			if (my_compare($arr[$index], $arr[$index + 1])) {
				$temp = $arr[$index];
				$arr[$index] = $arr[$index + 1];
				$arr[$index + 1] = $temp;
			}
		}
	}
	foreach ($arr as $value) {
		echo $value . "\n";
	}