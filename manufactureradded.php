<html>
<head>
<title>Add manufacturer</title>
</head>
<body>
	<?php
		if (isset($_POST['submit'])) {
			$data_missing = array();
			if (empty($_POST['manufacturerName'])) {
				$data_missing[] = 'Manufacturer Name';
			} else {
				$manufacturerName = trim($_POST['manufacturerName']);
			}
			if (empty($_POST['manufacturerLocation'])) {
				$data_missing[] = 'Manufacturer Location';
			} else {
				$manufacturerLocation = trim($_POST['manufacturerLocation']);
			}
			if (empty($_POST['manufacturerRevenue'])) {
				$data_missing[] = 'Manufacturer Revenue';
			} else {
				$manufacturerRevenue = trim($_POST['manufacturerRevenue']);
			}


			if (empty($data_missing)) {
				require_once('mysqli_connect.php');

				$query = "INSERT INTO manufacturer (manufacturerID, manufacturerName, manufacturerLocation, manufacturerRevenue) VALUES (NULL, ?,?,?)";

				$stmt = mysqli_prepare($dbc, $query);
				mysqli_stmt_bind_param($stmt, "sss", $manufacturerName, $manufacturerLocation, $manufacturerRevenue);

				mysqli_stmt_execute($stmt);

				$affected_rows = mysqli_stmt_affected_rows($stmt);

				if ($affected_rows == 1) {
					echo 'Manufacturer Entered';
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
<form action="http://localhost:8080/dbmsProject/manufactureradded.php" method="post"> 

<b>Add a New manufacturer</b>

<p>Manufacturer Name:
<input type="text" name="manufacturerName" size="30" value="" />
</p>

<p>Manufacturer Location:
<input type="text" name="manufacturerLocation" size="50" value="" />
</p>

<p>Manufacturer Revenue:
<input type="text" name="manufacturerRevenue" size="30" value="" />
</p>

<p>
<input type="submit" name="submit" value="Send" />
</p>

</form>
</body>
</html>