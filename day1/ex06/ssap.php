#!/usr/bin/php
<?php
	array_shift($argv);
	$arr = array();
	foreach ($argv as $value) {
		$temp = array_filter(explode(' ', $value));
		foreach ($temp as $members) {
			array_push($arr, $members);
		}
	}
	sort($arr);
	foreach ($arr as $word) {
		print($word."\n");
	}