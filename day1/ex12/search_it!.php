#!/usr/bin/php
<?php
	if ($argc < 2) {
		exit(1);
	}
	$needle = $argv[1];
	$storage = array();
	array_shift($argv);
	foreach ($argv as $item) {
		$first_in = strpos($item, ':');
		if ($first_in === FALSE) {
			continue ;
		}
		else {
			$key = substr($item, 0, $first_in);
			$value = substr($item, $first_in + 1);
			$storage[$key] = $value;
		}
	}
	if ($storage[$needle]) {
		echo $storage[$needle]."\n";
	}