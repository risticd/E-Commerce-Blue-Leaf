<?php

// Include the database connection.
include('includes/connection.php');

// Capture all fields sent from the form into variables.
$firstName = $_POST["firstname"];
$lastName = $_POST["lastname"];
$companyName = $_POST["companyname"];
$address = $_POST["address"];
$city = $_POST["city"];
$province = $_POST["province"];
$postalCode = $_POST["postalcode"];
$phoneNumber = $_POST["phonenumber"];
$phoneExt = $_POST["phone_ext"];
$cellphoneNumber = $_POST["cellphonenumber"];
$email = $_POST["email"];
$username = $_POST["username"];
// Encrypted password.
$password = md5($_POST["password"]);

// Account type and status are set by default.
$accountType = "User";
$status = "Active";

// SQL Statement
$createAccount = "INSERT INTO account VALUES 
(null, '$firstName', '$lastName', '$companyName', '$address', 
'$city', '$province', '$postalCode', '$phoneNumber', '$phoneExt', 
'$cellphoneNumber', '$email', '$username', '$password', '$accountType', 
'$status');";

// Execute the SQL.
if(!mysql_query($createAccount, $con))
{
	die('Error: ' . mysql_error());
}

else
{
	header('Location: ' . $_SERVER['HTTP_REFERER']);
}

mysql_close($con);

?>
