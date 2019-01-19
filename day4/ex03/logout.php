<?php
	if (session_start() === FALSE) {
		return (FALSE);
	}
	$_SESSION["loggued_on_user"] = "";
?>