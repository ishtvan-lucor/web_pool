#!/usr/bin/php
<?php
	if ($argc != 4) {
		echo "Wrong amount of arguments!\n";
		return ;
	}
	$left = trim($argv[1]);
	$right = trim($argv[3]);
	$sign = trim($argv[2]);

	if (!is_numeric($left) || !is_numeric($right)) {
	    echo "Wrong input: one or two not number!\n";
	    return ;
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
        echo "Wrong sign!\n";
    }