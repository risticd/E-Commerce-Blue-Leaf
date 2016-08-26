<?php
session_start();

include("connection/connect.php"); 


if (!$_SESSION["username"])
        {
        // User not logged in, redirect to login page
        header("Location: login.php");

}

?>