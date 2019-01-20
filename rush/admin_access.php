<?php

	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	if ($_POST["login"] && $_POST["pass"] && $_POST["submit"] == "OK") {
		if ($_POST["login"] == "admin" && $_POST["pass"] == "0987654321") {
			$_SESSION["user_online"] = "ADMIN_HERE";
			header("admin-user-manage.php",TRUE,301);
		}
	}
	else {
		$_SESSION["loggued_on_user"] = "";
		header("admin.php",TRUE,301);
	}



//function auth($login, $passwd) {
//	if (!$login || !$passwd) {
//		return (FALSE);
//	}
//	if (($str = file_get_contents("../private/passwd")) === FALSE) {
//		return (FALSE);
//	}
//	$data_passwd = unserialize($str);
//	$current_pass = hash("whirlpool", $passwd);
//	foreach ($data_passwd as $combo) {
//		if ($combo["login"] == $login && $combo["passwd"] == $current_pass) {
//			return (TRUE);
//		}
//	}
//	return (FALSE);
//}
?>