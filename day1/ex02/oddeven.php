#!/usr/bin/php
<?php
    while (TRUE) {
		print("Enter a number: ");
		$str = fgets(STDIN);
		if (!$str) {
			print("\n");
			break;
		}
		$str = trim($str);
		if (!is_numeric($str)) {
			print("'$str' is not a number\n");
		}
		else if ($str % 2 == 0) {
			print("The number $str is even\n");
		}
		else {
			print("The number $str is odd\n");
		}
	}