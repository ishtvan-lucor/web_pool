<?php
	require_once ("connect-db.php");

	function get_all_prod() {
		$port = connect_db();

		$result = mysqli_query($port, "SELECT * FROM `book-shop`");
		$data = mysqli_fetch_array($result);
		//print_r(mysqli_fetch_array($result));
		mysqli_close($port);
		return ($data);
	}
?>