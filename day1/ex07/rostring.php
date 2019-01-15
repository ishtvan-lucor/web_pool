#!/usr/bin/php
<?php
	if ($argc < 2) {
		return;
	}
	$arr = array_values(array_filter(explode(' ', $argv[1])));
	$temp = $arr[0];
	unset($arr[0]);
	array_push($arr, $temp);
	foreach ($arr as $value) {
		$res .= ' '.$value;
	}
	print(trim($res)."\n");