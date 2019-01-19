<?php
	if (session_start() === FALSE) {
		return (FALSE);
	}
	if ($_SESSION["loggued_on_user"]) {
		echo $_SESSION["loggued_on_user"] . "\n";
	}
	else {
		echo "ERROR\n";
	}
?>