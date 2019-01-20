

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Modify product</title>
	<meta charset="utf-8">
</head>
<body>
<header>
	<a href="#" ></a>
	<a href="#" ></a>
	<a href="#" ></a>
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
			$id = $_GET["id"];
		$result = mysqli_query($port, "SELECT * FROM `book-shop`");
		if (!$result) {
			echo "fail DB\n";
		}
		$all_rows = mysqli_num_rows($result);

		for ( $i = 0; $i < $all_rows; $i++) {
			mysqli_data_seek($result, $i);
			$row = mysqli_fetch_array($result, MYSQLI_NUM);
			if ($row[0] == $id) {
				echo <<<_END
			<div>	
				<form action="modif-data.php" method="post"><pre>
					<p>Name:    	<input type="text" name="name" value="$row[1]"></p>
					<p>Description: <input type="text" name="descript" value="$row[2]"></p>
					<p>Price: 	<input type="number" name="price" value="$row[3]"></p>
					<p>Image: 	<input type="text" name="img" value="$row[4]"></p>
					<p>Amount: 	<input type="number" name="amount" value="$row[5]"></p>
					<p>Categories: 	<input type="text" name="category" value="$row[6]"></p>
					<input type="hidden" name="id" value="$id">
					<input type="submit" name="submit" value="CHANGE BOOK"></pre>
					<hr>
				</form>
			</div>	
_END;
			}
		}
	if ($_POST["submit"] == "CHANGE BOOK" &&
		$_POST["name"] != NULL && $_POST["descript"] != NULL &&
		$_POST["price"] != NULL && $_POST["img"] != NULL &&
		$_POST["amount"] != NULL && $_POST["category"] != NULL) {

		$name = prepare_for_sql($port, "name");
		$descript = prepare_for_sql($port, "descript");
		$price = prepare_for_sql($port, "price");
		$img = prepare_for_sql($port, "img");
		$amount = prepare_for_sql($port, "amount");
		$category = prepare_for_sql($port, "category");
		$id = prepare_for_sql($port, "id");

		$query = "UPDATE `book-shop` SET name='$name', descript='$descript', price=$price, img='$img', amount=$amount, category='$category' WHERE id=$id";
		$result = mysqli_query($port, $query);
		if (!$result) {
			echo $id."INSERT failed: $query<br>" .
				mysqli_error($port) . "<br><br>";
		}
		else {
			header("Location: admin-manage-books.php");
		}
	}
	mysqli_close($port);
	?>
</body>
</html>
