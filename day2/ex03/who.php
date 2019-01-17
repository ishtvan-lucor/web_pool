#!/usr/bin/php
<?php
	date_default_timezone_set('Europe/Kiev');
	$fd = fopen("/var/run/utmpx", "r");
	fseek($fd, 1256);
	$date = array();
	for ( ; TRUE; ) {
    	$string_628 = fread($fd, 628);
    	if ($string_628 == NULL) {
        	break;
    	}
    	$unpacked_date = unpack("a256user/a4id/a32terminal/ipid/itype/itime/iend", $string_628);
    	array_push($date, $unpacked_date);
	}
	foreach ($date as $item) {
    	$item["terminal"] = trim($item["terminal"]);
    	if ($item["terminal"] == "console" && $item["type"] == 7) {
        	printf("%s %s  %s\n", trim($item["user"]), trim($item["terminal"]), date("M d H:i", $item["time"]));
    	}
	}
	foreach ($date as $item) {
    	$item["terminal"] = trim($item["terminal"]);
    	if ($item["terminal"] != "console" && $item["type"] == 7) {
        	printf("%s %s  %s\n", trim($item["user"]), trim($item["terminal"]), date("M d H:i", $item["time"]));
    	}
	}
	fclose($fd);