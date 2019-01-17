#!/usr/bin/php
<?php
	if ($argc != 2) {
		exit(1);
	}
	$directory_name = parse_url($argv[1], PHP_URL_HOST);
	if (!$directory_name) {
	    exit(1);
	}
	if (file_exists($directory_name)) {
	    $dir_handle = opendir($directory_name);
	    while (FALSE !== ($file = readdir($dir_handle))) {
	        if ($file != "." && $file != "..") {
	            unlink($directory_name . "/" . $file);
	        }
	    }
	    closedir($dir_handle);
	    rmdir($directory_name);
	}
	mkdir($directory_name);
	$curl_descript = curl_init($argv[1]);
	curl_setopt($curl_descript, CURLOPT_RETURNTRANSFER, TRUE);
	$html = curl_exec($curl_descript);
	preg_match_all("@<img.*?src=\"(.*?)\".*?>@", $html, $images);
	$component = parse_url($argv[1], PHP_URL_SCHEME);
	$pattern = "/" . $component . "/";
	for ($i = 0; $i < count($images[1]); $i++) {
	    $ref = $images[1][$i];
	    if (preg_match($pattern, $images[1][$i])) {
	    }
	    else {
	        $ref = parse_url($argv[1], PHP_URL_SCHEME) . "://" . parse_url($argv[1], PHP_URL_HOST) . $images[1][1];
	    }
	    $curl_desc2 = curl_init($ref);
	    curl_setopt($curl_desc2, CURLOPT_RETURNTRANSFER, TRUE);
	    $data = curl_exec($curl_desc2);
	    $temp = explode("/", $images[1][$i]);
	    $file_flow = fopen($directory_name . "/" . end($temp), 'w');
	    fwrite($file_flow, $data);
	    curl_close($curl_desc2);
	}
	curl_close($curl_descript);
