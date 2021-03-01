<html>
<head>
<title>Delete Customer</title>
</head>
<body>
	<?php
		if(isset($_POST['submit'])){

        $data_missing = array();

        if(empty($_POST['customerID'])){
            $data_missing[] = 'Customer ID';

        } else {
            $customerID = trim($_POST['customerID']);
        }
        if(empty($data_missing)){

        require_once('mysqli_connect.php');

        $query = "DELETE FROM customers WHERE customerID = $customerID";

        $stmt = mysqli_prepare($dbc, $query);
        mysqli_stmt_bind_param($stmt, "i", $customerID);

        mysqli_stmt_execute($stmt);

        $affected_rows = mysqli_stmt_affected_rows($stmt);

        if($affected_rows == 1){

            echo 'Customer Deleted';
            mysqli_stmt_close($stmt);
            mysqli_close($dbc);

        } else {

            echo 'Error Occurred<br />';
            echo mysqli_error();
            mysqli_stmt_close($stmt);
            mysqli_close($dbc);
        }
	} else {

        	echo 'You need to enter the following data<br />';
        	foreach($data_missing as $missing){
            	echo "$missing<br />";
            }
    	}
    }
	?>
	<form action="http://localhost:8080/dbmsProject/customerdeleted.php" method="post"> 

	<b>Delete a Customer</b>

	<p>Customer ID:
	<input type="text" name="customerID" size="5" value="" />
	</p>

	<p>Submit:
<input type="submit" name="submit" value="Send" />
</p>
	</form>
	</body>
</html>