<?php
	if (session_start() === FALSE) {
		echo "Session didn't start\n";
		exit();
	}
	if ($_GET["login"] != NULL && $_GET["passwd"] != NULL && $_GET["submit"] == "OK") {
		$_SESSION["login"] = $_GET["login"];
		$_SESSION["passwd"] = $_GET["passwd"];
	}
?>

<html><body>
	<form action="index.php" method="get" name="index.php">
		Username: <input name="login" type="text" value="<?php echo $_SESSION['login'];?>" title="login">
		<br />
		Password: <input name="passwd" type="password" value="<?php echo $_SESSION['passwd'];?>" title="passwd">
		<input type="submit" name="submit" value="OK">
	</form>
</body></html>
