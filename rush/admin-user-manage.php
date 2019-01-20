<!DOCTYPE html>
<html>
<head>
	<title>Users management</title>
	<meta charset="utf-8">
</head>
<body>
	<header>
		<a href="admin-manage-books.php" >Manage books</a>
		<a href="admin-user-manage.php" >Manage users</a>
		<a href="admin-manage-books.php" >Manage basket</a>
	</header>
	<div>
		<form action="admin-user-manage.php" method="post">
			<h3>Add new user:</h3>
			<input type="text" name="login" value="" placeholder="username">
			<input type="password" name="passwd" value="" placeholder="password">
			<input type="submit" name="add" value="ADD NEW USER">
		</form>
	</div>
	<?php
		if (!file_exists("private/passwd")) {
			echo "<h3>No users</h3>";
		}
		else {
			$data_users = unserialize(file_get_contents("private/passwd"));
			foreach ($data_users as $user) {
				$login = $user["login"];
				echo <<<_END
<div>
	<form action="admin-user-manage.php" method="post">
		<span>User login: $login</span>
		<input type="hidden" name="login" value="$login">
		<input type="submit" name="delete" value="DELETE USER">	
	</form>
</div>
_END;
			}
			if ($_POST["delete"] == "DELETE USER") {
				$data_users = unserialize(file_get_contents("private/passwd"));
				foreach ($data_users as $key => $user) {
					if ($user["login"] == $_POST["login"]) {
						unset($data_users[$key]);
						break;
					}
				}
				file_put_contents("private/passwd", serialize($data_users));
				header("Location: admin-user-manage.php");
			}
			if ($_POST["add"] == "ADD NEW USER" && $_POST["login"] != NULL && $_POST["passwd"] != NULL) {
				if (!file_exists("private")) {
					mkdir("private");
				}
				if (!file_exists("private/passwd")) {
					file_put_contents("private/passwd", null);
				}
				$data_users = unserialize(file_get_contents("private/passwd"));
				foreach ($data_users as $key => $user) {
					if ($user["login"] === $_POST["login"]) {
						header("Location: admin-user-manage.php");
					}
				}
				$user["login"] = $_POST["login"];
				$user["passwd"] = hash('whirlpool', $_POST['passwd']);
				$data_users[] = $user;
				file_put_contents("private/passwd", serialize($data_users));
				header("Location: admin-user-manage.php");
			}
		}
	?>
</body>
</html>