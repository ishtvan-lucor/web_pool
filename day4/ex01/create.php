<?php
	if ($_POST["submit"] == "OK" && $_POST["login"] != NULL && $_POST["passwd"] != NULL) {
		if (!file_exists("../private")) {
			mkdir("../private");
		}
		$current_user = array();
		if (file_exists("../private/passwd")) {
			$data_base = unserialize(file_get_contents('../private/passwd'));
			foreach ($data_base as $user) {
				if ($user["login"] === $_POST["login"]) {
					echo "ERROR\n";
					exit(1);
				}
			}
		}
		$current_user["login"] = $_POST["login"];
		$current_user["passwd"] = hash("whirlpool", $_POST["passwd"]);
		$data_base[] = $current_user;
		file_put_contents("../private/passwd", serialize($data_base));
		echo "OK\n";
	}
	else
	{
		echo "ERROR\n";
	}
?>