<html>
<head>
<title>Add Sneaker</title>
</head>
<body>
	<?php
		if (isset($_POST['submit'])) {
			$data_missing = array();
			if (empty($_POST['sneakerType'])) {
				$data_missing[] = 'Sneaker Type';
			} else {
				$sneakerType = trim($_POST['sneakerType']);
			}
			if (empty($_POST['size'])) {
				$data_missing[] = 'Size';
			} else {
				$size = trim($_POST['size']);
			}
			if (empty($_POST['colorway'])) {
				$data_missing[] = 'ColorWay';
			} else {
				$colorway = trim($_POST['colorway']);
			}
			if (empty($_POST['price'])) {
				$data_missing[] = 'Price';
			} else {
				$price = trim($_POST['price']);
			}


			if (empty($data_missing)) {
				require_once('mysqli_connect.php');

				$query = "INSERT INTO sneakers (sneakerID, sneakerType, size, colorway, price) VALUES (NULL,?,?,?,?)";
				$stmt = mysqli_prepare($dbc, $query);
				mysqli_stmt_bind_param($stmt, "sssd", $sneakerType, $size, $colorway, $price);
				mysqli_stmt_execute($stmt);
				$affected_rows = mysqli_stmt_affected_rows($stmt);
				if ($affected_rows == 1) {
					echo 'Sneaker Entered';
					mysqli_stmt_close($stmt);
					mysqli_close($dbc);
				} else {
					echo 'Error Occured<br />';
					echo mysqli_error();
					mysqli_stmt_close($stmt);
					mysqli_close($dbc);
				}
			} else {
				echo 'You need to enter the following data<br />';
				foreach($data_missing as $missing) {
					echo "$missing<br />";
				}
			}
		}
	?>
<form action="http://localhost:8080/dbmsProject/sneakersadded.php" method="post"> 

<b>Add a New Sneaker</b>

<p>Sneaker Type:
<input type="text" name="sneakerType" size="30" value="" />
</p>

<p>Size:
<input type="text" name="size" size="30" maxlength="2" value="" />
</p>

<p>ColorWay:
<input type="text" name="colorway" size="30" value="" />
</p>

<p>Price:
<input type="text" name="price" size="30" value="" />
</p>

<p>
<input type="submit" name="submit" value="Send" />
</p>

</form>
</body>
</html>