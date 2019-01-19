<?php
	function auth($login, $passwd) {
		if (!$login || !$passwd) {
			return (FALSE);
		}
		if (($str = file_get_contents("../private/passwd")) === FALSE) {
			return (FALSE);
		}
		$data_passwd = unserialize($str);
		$current_pass = hash("whirlpool", $passwd);
		foreach ($data_passwd as $combo) {
			if ($combo["login"] == $login && $combo["passwd"] == $current_pass) {
				return (TRUE);
			}
		}
		return (FALSE);
	}
?>