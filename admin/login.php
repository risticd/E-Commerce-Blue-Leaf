<!------------------------------------------
MMDA - Sheridan College Learning
Modified: Oct 1st 2012
-> Edit Account Page
-------------------------------------------->

<html>
<head>
<title>Administrator Login</title>
<link rel="shortcut icon" href="stylesheet/img/devil-icon.png"> 
<link rel="stylesheet" type="text/css" href="css/style.css"> 
</head>

<style>

h3 {
	margin-left:30px;
}

</style>

<body>
<div id="header">
	<div class="inHeaderLogin"></div>
</div>

<div id="loginForm">
	<div class="headLoginForm">
	Login Administrator
	</div>
	<div class="fieldLogin">
	<form method="POST" action="login.php">
	<label>Username</label><br>
	<input type="text" class="login" name="username"><br>
	<label>Password</label><br>
	<input type="password" class="login" name="password"><br>
	<input type="submit" class="button" value="Login">
	</form>
	</div>
</body>
</html>


<?php

// connection to database blue leaf
include("connection/connect.php"); 

if($_SERVER["REQUEST_METHOD"] == "POST")
{
// username and password sent from form
$username = $_POST['username'];
$pass = $_POST['password'];

// To protect MySQL injection (more detail about MySQL injection)
//$username = stripslashes($username);
//$pass = stripslashes($pass);
//$username = mysql_real_escape_string($username);
//$pass = mysql_real_escape_string($pass);

$encrypted_mypassword=md5($pass);

$sql="SELECT * FROM account WHERE username='$username' and password='$encrypted_mypassword' and account_type='admin' and status ='active'";
$result = mysql_query($sql);

// Mysql_num_row is counting table row
$count = mysql_num_rows($result);

// If result matched $_username and $_password, table row must be 1 row

/// If result matched $username and $password, row must greater than 0
if($count > 0)
{
session_register("username");
$_SESSION['username'] = $username;
$_SESSION['password'] = $pass;

 // login success
header("location:welcome.php");
}
else
{

	// error message

echo '<h3>Username and password is invalid </h3>';

}
}

mysql_close(); 
?>






