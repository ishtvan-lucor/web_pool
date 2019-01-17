#!/usr/bin/php
<?php
    if ($argc == 1) {
        exit(1);
    }
	date_default_timezone_set('Europe/Paris');
    $days = "([Ll]undi|[Mm]ardi|[Mm]ercredi|[Jj]eudi|[Vv]endredi|[Ss]amedi|[Dd]imanche)";
    $months = "([Jj]anvier|[Ff]évrier|[Mm]ars|[Aa]vril|[Mm]ai|[Jj]uin|[Jj]uillet|[Aa]oût|[Ss]eptembre|[Oo]ctobre|[Nn]ovembre|[Dd]écembre)";
    $mouth_nbr = array(
            1 => "janvier",
            2 => "février",
            3 => "mars",
            4 => "avril",
            5 => "mai",
            6 => "juin",
            7 => "juillet",
            8 => "août",
            9 => "septembre",
            10 => "octobre",
            11 => "novembre",
            12 => "décembre");
    $looking_pattern = "/^" . $days . " ([1-9]|(1|2)\d{1}|3(0|1)) " . $months .  " (\d{4} \d{2}:\d{2}:\d{2})$/";
    if (!$what = preg_match($looking_pattern, $argv[1])) {
        print("Wrong Format\n");
        exit(1);
    }
    $date = explode(' ', $argv[1]);
    $current_month = array_search(strtolower($date[2]), $mouth_nbr);
    $date_right_format = $date[3] . "-" . $current_month . "-" . $date[1] . "T" . $date[4];
    $result = strtotime($date_right_format);
    if ($result === FALSE) {
		print("Wrong Format\n");
    }
    else if ($result < 0) {
        echo "Wrong date lower than January 1, 1970 = ".$result."/n";
    }
    else {
        echo $result."\n";
    }