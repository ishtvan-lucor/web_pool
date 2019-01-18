<?php
	if ($_GET["action"] == "set" && $_GET["name"] && $_GET["value"]) {
		setcookie($_GET["name"], $_GET["value"], time() + 86400);
	}
	else if ($_GET["action"] == "get" && $_GET["name"] && $_COOKIE[$_GET["name"]]) {
		echo $_COOKIE[$_GET["name"]] . "\n";
	}
	else if ($_GET["action"] == "del" && $_GET["name"] && $_COOKIE[$_GET["name"]]) {
		setcookie($_GET["name"], "", time() - 86400);
	}