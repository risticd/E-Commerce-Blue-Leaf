<?php
	include('includes/connection.php');

	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$companyname = $_POST['companyname'];
	$address = $_POST['address'];
	$city = $_POST['city'];
	$province = $_POST['province'];
	$postalcode = $_POST['postalcode'];
	$phonenumber = $_POST['phonenumber'];
	$phone_ext = $_POST['phone_ext'];
	$cellphonenumber = $_POST['cellphonenumber'];
	$email = $_POST['email'];
	$username = $_POST['username'];

	$updatequery = "UPDATE account SET first_name = '{$firstname}', 
	last_name = '{$lastname}', company_name = '{$companyname}', 
	address = '{$address}', city = '{$city}', province = '{$province}', 
	postal_code = '{$postalcode}', phone_number = '{$phonenumber}', 
	phone_ext = '{$phone_ext}', cell_phone = '{$cellphonenumber}', 
	email = '{$email}' WHERE username = '{$username}';";

	if(!mysql_query($updatequery, $con))
	{
		die('Error: ' . mysql_error());
	}

	else
	{
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}

	mysql_close($con);
?>