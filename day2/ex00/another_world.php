#!/usr/bin/php
<?php
	if ($argc == 1) {
		exit(1);
	}
	echo trim(preg_replace("#[ \t\r]+#", " ", $argv[1]))."\n";