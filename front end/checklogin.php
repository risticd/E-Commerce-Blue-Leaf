<?php session_start(); ?>
<?php include('includes/connection.php'); ?>
<?php
	if(isset($_POST["username"]) & isset($_POST["pass"]))
	{
		$username = $_POST["username"];
		$pass = $_POST["pass"];

		$encrypted_mypassword = md5($pass);

		$sql = "SELECT * FROM account WHERE username='$username' and password='$encrypted_mypassword';";
		$result = mysql_query($sql);
		$count = mysql_num_rows($result);

		if($count > 0)
		{
			$_SESSION['username'] = $username;
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}

		else
		{
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
	}
?>