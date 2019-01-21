<?php

function auth($login, $passwd) {
	$privatdir = "private";
	$passwddir = $privatdir."/passwd";
	if (!$login || !$passwd) {
		return false;
	}
	$account = unserialize(file_get_contents($passwddir));
	if ($account) {
		foreach ($account as $acc => $value) {
			if ($value['login'] === $login && $value['passwd'] === hash('whirlpool', $passwd)) {
				return true;
			}
		}
	}
	return false;
}

session_start();

if ($_GET['login'] && $_GET['passwd'] && auth($_GET['login'], $_GET['passwd'])) {
	$_SESSION['loggued_on_user'] = $_GET['login'];
}
else {
	$_SESSION['loggued_on_user'] = "";
}
/*header(include 'mainpage.html');*/

require "mainpage.html";

?>