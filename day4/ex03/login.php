<?php
	require_once("auth.php");

	if (session_start() === FALSE) {
		return (FALSE);
	}
	if (auth($_GET["login"], $_GET["passwd"])) {
		$_SESSION["loggued_on_user"] = $_GET["login"];
		echo "OK\n";
	}
	else {
		$_SESSION["loggued_on_user"] = "";
		echo "ERROR\n";
	}
?>