<?php

$con = mysql_connect("cs10.sheridanc.on.ca", "root", "blueleaf");

if(!$con)
{
  //die('Could not connect: ' . mysql_error());
  header("location:../BLUELEAF/sorry.php");
}

mysql_select_db("blueleaf", $con);


?>