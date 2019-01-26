<?php
	$data = file_get_contents("list.csv");
	$tasks = explode("\n", $data);

	foreach ($tasks as $key => $item) {
		$tasks[$key] = explode(";", $item);
	}
	unset($tasks[count($tasks) - 1]);
	$data = json_encode($tasks);
	echo $data;
