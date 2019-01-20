<?php
	require_once ("glob.php");

	function connect_db() {
		$port = mysqli_connect(SERVER_NAME, USER_NAME, PASSWORD, DB_NAME);

		if (!($port))
		{
			echo mysqli_connect_error();
		}
		return ($port);
	}
?>


