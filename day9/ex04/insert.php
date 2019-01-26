<?php
	$fd = fopen("list.csv", 'a+');

	fputcsv($fd, array($_GET['id'], $_GET['task']), ";");
	fclose($fd);
	echo $_GET['id'] . ";" . $_GET['task'];
