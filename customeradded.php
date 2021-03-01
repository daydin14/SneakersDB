<html>
<head>
<title>Add Customer</title>
</head>
<body>
<?php

    if(isset($_POST['submit'])){

        $data_missing = array();

        if(empty($_POST['firstName'])){
            $data_missing[] = 'First Name';

        } else {
            $firstName = trim($_POST['firstName']);
        }
        if(empty($_POST['lastName'])){
            $data_missing[] = 'Last Name';

        } else {
            $lastName = trim($_POST['lastName']);
        }
        if(empty($_POST['email'])){
            $data_missing[] = 'Email';

        } else {
            $email = trim($_POST['email']);
        }
        if(empty($_POST['street'])){
            $data_missing[] = 'Street';

        } else {
            $street = trim($_POST['street']);
        }
        if(empty($_POST['city'])){
            $data_missing[] = 'City';

        } else {
            $city = trim($_POST['city']);
        }
        if(empty($_POST['state'])){
            $data_missing[] = 'State';

        } else {
            $state = trim($_POST['state']);
        }
        if(empty($_POST['zipCode'])){
            $data_missing[] = 'Zip Code';

        } else {
            $zipCode = trim($_POST['zipCode']);
        }
        if(empty($_POST['phoneNumber'])){
            $data_missing[] = 'Phone Number';

        } else {
            $phoneNumber = trim($_POST['phoneNumber']);
        }
        if(empty($_POST['sex'])){
            $data_missing[] = 'Sex';

        } else {
            $sex = trim($_POST['sex']);
        }
    



    if(empty($data_missing)){

        require_once('mysqli_connect.php');

        $query = "INSERT INTO customers (customerID, firstName, lastName, email, street, city, state, zipCode, phoneNumber, sex) VALUES (NULL, ?,?,?,?,?,?,?,?,?)";

        $stmt = mysqli_prepare($dbc, $query);
        mysqli_stmt_bind_param($stmt, "ssssssiss", $firstName, $lastName, $email, $street, $city, $state, $zipCode, $phoneNumber, $sex);

        mysqli_stmt_execute($stmt);

        $affected_rows = mysqli_stmt_affected_rows($stmt);

        if($affected_rows == 1){

            echo 'Customer Entered';
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
<form action="http://localhost:8080/dbmsProject/customeradded.php" method="post"> 

<b>Add a New Customer</b>

<p>First Name:
<input type="text" name="firstName" size="30" value="" />
</p>

<p>Last Name:
<input type="text" name="lastName" size="30" value="" />
</p>

<p>Email:
<input type="text" name="email" size="60" value="" />
</p>

<p>Street:
<input type="text" name="street" size="50" value="" />
</p>

<p>City:
<input type="text" name="city" size="40" value="" />
</p>

<p>State (2 Characters):
<input type="text" name="state" size="2" maxlength="2" value="" />
</p>

<p>Zip Code:
<input type="text" name="zipCode" size="5" maxlength="5" value="" />
</p>

<p>Phone Number:
<input type="text" name="phoneNumber" size="20" value="" />
</p>

<p>Sex (M or F):
<input type="text" name="sex" size="30" maxlength="1" value="" />
</p>

<p>Submit:
<input type="submit" name="submit" value="Send" />
</p>

</form>
</body>
</html>