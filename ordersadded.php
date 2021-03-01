<html>
<head>
<title>Add Order</title>
</head>
<body>
	<?php
		if (isset($_POST['submit'])) {
			$data_missing = array();
			if (empty($_POST['orderDate'])) {
				$data_missing[] = 'Order Date';
			} else {
				$orderDate = trim($_POST['orderDate']);
			}
			if (empty($_POST['expectedDeliveryDate'])) {
				$data_missing[] = 'Expected Delivery Date';
			} else {
				$expectedDeliveryDate = trim($_POST['expectedDeliveryDate']);
			}
			if (empty($_POST['shippedDate'])) {
				$data_missing[] = 'Shipped Date';
			} else {
				$shippedDate = trim($_POST['shippedDate']);
			}
			if (empty($_POST['orderStatus'])) {
				$data_missing[] = 'Order Status';
			} else {
				$orderStatus = trim($_POST['orderStatus']);
			}


			if (empty($data_missing)) {
				require_once('mysqli_connect.php');

				$query = "INSERT INTO orders (orderID, orderDate, expectedDeliveryDate, shippedDate, orderStatus) VALUES (NULL,?,?,?,?)";
				$stmt = mysqli_prepare($dbc, $query);
				mysqli_stmt_bind_param($stmt, "ssss", $orderDate, $expectedDeliveryDate, $shippedDate, $orderStatus);
				mysqli_stmt_execute($stmt);
				$affected_rows = mysqli_stmt_affected_rows($stmt);
				if ($affected_rows == 1) {
					echo 'Order Entered';
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
<form action="http://localhost:8080/dbmsProject/ordersadded.php" method="post"> 

<b>Add a New Order</b>

<p>Order Date:
<input type="text" name="orderDate" size="30" value="" />
</p>

<p>Expected Delivery Date:
<input type="text" name="expectedDeliveryDate" size="30" value="" />
</p>

<p>Shipped Date:
<input type="text" name="shippedDate" size="30" value="" />
</p>

<p>Order Status:
<input type="text" name="orderStatus" size="30" value="" />
</p>

<p>
<input type="submit" name="submit" value="Send" />
</p>

</form>
</body>
</html>