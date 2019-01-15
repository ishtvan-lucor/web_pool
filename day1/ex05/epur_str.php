#!/usr/bin/php
<?php
	if ($argc != 2) {
		return;
	}
	$arr = array_filter(explode(' ', $argv[1]));
	foreach ($arr as $value) {
        $res .= " ".$value;
    }
    print(trim($res)."\n");
