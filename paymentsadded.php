<html>
<head>
<title>Add Payment</title>
</head>
<body>
	<?php
		if (isset($_POST['submit'])) {
			$data_missing = array();
			if (empty($_POST['paymentDate'])) {
				$data_missing[] = 'Payment Date';
			} else {
				$paymentDate = trim($_POST['paymentDate']);
			}
			if (empty($_POST['paymentAmount'])) {
				$data_missing[] = 'Payment Amount';
			} else {
				$paymentAmount = trim($_POST['paymentAmount']);
			}

			if (empty($data_missing)) {
				require_once('mysqli_connect.php');

				$query = "INSERT INTO payments (paymentsID, paymentDate, paymentAmount) VALUES (NULL,?,?)";
				$stmt = mysqli_prepare($dbc, $query);
				mysqli_stmt_bind_param($stmt, "ss", $paymentDate, $paymentAmount);
				mysqli_stmt_execute($stmt);
				$affected_rows = mysqli_stmt_affected_rows($stmt);
				if ($affected_rows == 1) {
					echo 'Payment Entered';
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
<form action="http://localhost:8080/dbmsProject/paymentsadded.php" method="post"> 

<b>Add a New Payment</b>

<p>Payment Date:
<input type="text" name="paymentDate" size="30" value="" />
</p>

<p>Payment Amount:
<input type="text" name="paymentAmount" size="30" value="" />
</p>

<p>
<input type="submit" name="submit" value="Send" />
</p>

</form>
</body>
</html>