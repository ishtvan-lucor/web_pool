<?php

$privatdir = "private";
$passwddir = $privatdir."/passwd";


if (!$_POST['login']) {
	echo "ERROR. Login field is empty.\n";
	exit;
}
if (!$_POST['passwd']) {
	echo "ERROR. Password field is empty.\n";
	exit;
}

if ($_POST['login'] && $_POST['passwd'] && $_POST['submit'] && $_POST['submit'] == "OK") {
	if (!file_exists($privatdir)) {
		mkdir($privatdir);
	}
	if (!file_exists($passwddir)) {
		file_put_contents($passwddir, null);
	}
	$account = unserialize(file_get_contents($passwddir));
	if ($account) {
		$exist = 0;
		foreach ($account as $acc => $value) {
			if ($value['login'] === $_POST['login']) {
				$exist = 1;
				break;
			}
		}
	}
	if ($exist) {
		echo "ERROR. Username submitted already exist.\n";
	}
	else {
		$temp['login'] = $_POST['login'];
		$temp['passwd'] = hash('whirlpool', $_POST['passwd']);
		$account[] = $temp;
		file_put_contents($passwddir, serialize($account));
	}
	header(include 'mainpage.html');
}
else {
	echo "ERROR. Something went wrong. Please, try again.\n";
}
?>