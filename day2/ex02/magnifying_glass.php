#!/usr/bin/php
<?php
	function inside_tag($target) {
		return (strtoupper($target[0]));
	}
	function after_title($target) {
		return (str_replace($target[1], strtoupper($target[1]), $target[0]));
	}
	function to_upper_in_a_tag($target) {
		//print_r($target);
		$back = preg_replace_callback("#>[^<]*<#", "inside_tag", $target[0]);
		$back = preg_replace_callback("#title=\"(.*)\"#", "after_title", $back);
		return ($back);
	}

	if ($argc == 1) {
		exit(1);
	}
	$file = file_get_contents($argv[1]);
	echo preg_replace_callback("#<a[^>]*>(.*?)</a>#is", "to_upper_in_a_tag", $file);