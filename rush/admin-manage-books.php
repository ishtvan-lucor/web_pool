<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Modify product</title>
		<meta charset="utf-8">
		<style>
			body {
				background-color:#afeaed;
			}

		</style>
	</head>
	<body>
		<header>
            <a href="admin-manage-books.php" >Manage books</a>
            <a href="admin-user-manage.php" >Manage users</a>
            <a href="admin-manage-books.php" >Manage basket</a>
		</header>
		<?php
			require_once "connect-db.php";
			require_once "work-with-sql.php";
			require_once "glob.php";

			function prepare_for_sql($port, $var) {
				return (mysqli_real_escape_string($port, $_POST[$var]));
			}

			$port = connect_db();
			if ($port == FALSE) {
				echo "fail DB\n";
			}
			if ($_POST["submit"] == "DELETE BOOK") {
				$id = prepare_for_sql($port, "id");
				$query = "DELETE FROM `book-shop` WHERE id='$id'";
				$result = mysqli_query($port, $query);
				if (!$result) {
					echo "No DELETE. fail DB\n";
				}
			}
			if ($_POST["submit"] == "MODIFY BOOK") {
				$id_put = $_POST["id"];
				header("Location: modif-data.php?id=$id_put");
			}
			if ($_POST["submit"] == "ADD BOOK" &&
				$_POST["name"] != NULL && $_POST["descript"] != NULL &&
				$_POST["price"] != NULL && $_POST["img"] != NULL &&
				$_POST["amount"] != NULL && $_POST["category"] != NULL) {

				$name = prepare_for_sql($port, "name");
				$descript = prepare_for_sql($port, "descript");
				$price = prepare_for_sql($port, "price");
				$img = prepare_for_sql($port, "img");
				$amount = prepare_for_sql($port, "amount");
				$category = prepare_for_sql($port, "category");

				$query = "INSERT INTO `book-shop` " . "(`name`, `descript`, `price`, `img`, `amount`, `category`)".
				" VALUES " . "('$name', '$descript', $price, '$img', $amount, '$category')";
				$result = mysqli_query($port, $query);
				if (!$result) {
					echo "INSERT failed: $query<br>" .
						mysqli_error($port) . "<br><br>";
				}
			}
			echo <<<_END
<div><form action="admin-manage-books.php" method="post"><pre>
	<p>Name:    	<input type="text" name="name"></p>
	<p>Description: <input type="text" name="descript"></p>
	<p>Price: 	<input type="number" name="price"></p>
	<p>Image: 	<input type="text" name="img"></p>
	<p>Amount: 	<input type="number" name="amount"></p>
	<p>Categories: 	<input type="text" name="category"></p>
	<input type="submit" name="submit" value="ADD BOOK"></pre>
	<hr>
</form></div>	
_END;

		$result = mysqli_query($port, "SELECT * FROM `book-shop`");
		if (!$result) {
			echo "fail DB\n";
		}
		$all_rows = mysqli_num_rows($result);

		for ( $i = 0; $i < $all_rows; $i++) {
			mysqli_data_seek($result, $i);
			$row = mysqli_fetch_array($result, MYSQLI_NUM);
			ECHO <<<_END
<div>
	<p>ID: $row[0]      Name: $row[1] Price: $row[3]      Amount: $row[5]</p>
	<p>Description: $row[2]</p>
	<p>Img: $row[4]</p>
	<p>Categories: $row[6]</p>
</div>
<form action="admin-manage-books.php" method="post">
	<input type="hidden" name="delete" value="del">
	<input type="hidden" name="id" value="$row[0]">
	<input type="submit" name="submit" value="DELETE BOOK">
	<input type="submit" name="submit" value="MODIFY BOOK"> 
</form>
<hr>
_END;
		}
		mysqli_close($port);
		?>
	</body>
</html>