#!/usr/bin/php
<?php
	if ($argc != 2) {
		echo "Incorrect Parameters\n";
		exit (1);
	}
	$temp = str_replace(" ", "", $argv[1]);
	$signs = "+-*/%";
	$temp2 = strpbrk($temp, $signs);
	if ($temp2 === FALSE) {
		echo "Syntax Error\n";
		exit(1);
	}
	$sign = $temp2[0];
	$left = strstr($temp, $sign, TRUE);
	$right = substr(strstr($temp2, $sign), 1, strlen($temp2));
	if (!is_numeric($left) || !is_numeric($right)) {
		echo "Syntax Error\n";
		exit(1);
	}
	if (!strcmp($sign, "+")) {
		echo $left + $right ."\n";
	}
	else if (!strcmp($sign, "-")) {
		echo $left - $right ."\n";
	}
	else if (!strcmp($sign, "*")) {
		echo $left * $right ."\n";
	}
	else if (!strcmp($sign, "/")) {
		if ($right == 0) {
			echo "ZERO division!\n";
			exit (1);
		}
		echo $left / $right ."\n";
	}
	else if ((!strcmp($sign, "%"))) {
		if ($right == 0.0) {
			echo "ZERO module!\n";
			exit (1);
		}
		echo $left % $right ."\n";
	}
	else {
		echo "Syntax Error\n";
}

