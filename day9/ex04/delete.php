<?php
	$fd = fopen("list.csv", 'r');
	$tasks = array();
	$id = $_GET['id'];

	while (($line = fgetcsv($fd))) {
		$tasks[] = $line;
	}
	foreach ($tasks as $key => $value) {
		$temp = explode(";", $value[0]);
		if ($temp[0] == $id) {
			unset($tasks[$key]);
		}
	}
	file_put_contents("list.csv", "");
	foreach ($tasks as $value) {
		file_put_contents("list.csv", $value[0] . "\n", FILE_APPEND);
	}
