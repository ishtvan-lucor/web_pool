<?php
	if (!$_POST["login"] || !$_POST["oldpw"] || !$_POST["newpw"] || $_POST["submit"] != "OK") {
		echo "ERROR\n";
		header("Location: index.html",TRUE,301);
		exit(1);
	}
	if (($str = file_get_contents("../private/passwd")) === FALSE) {
		echo "ERROR\n";
		header("Location: index.html",TRUE,301);
		exit(1);
	}
	$data_base = unserialize($str);
	$user_in_base = FALSE;
	foreach ($data_base as $key => $user_data) {
		if ($user_data["login"] == $_POST["login"] && $user_data["passwd"] == hash('whirlpool', $_POST["oldpw"])) {
			$user_in_base = TRUE;
			$data_base[$key]["passwd"] = hash("whirlpool", $_POST["newpw"]);
		}
	}
	if ($user_in_base) {
		file_put_contents("../private/passwd", serialize($data_base));
		echo "OK\n";
		header("Location: index.html",TRUE,301);
	}
	else {
		echo "ERROR\n";
		header("Location: index.html",TRUE,301);
	}
?>
