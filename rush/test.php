<?php

	$connect = mysqli_connect('localhost', 'root', '123456', 'book-shop');

	if (!($connect))
	{
		echo mysqli_connect_error();
	}

	$query_data = mysqli_query($connect, "SELECT * FROM `book-shop`");

	var_dump(mysqli_fetch_assoc($query_data));
?>