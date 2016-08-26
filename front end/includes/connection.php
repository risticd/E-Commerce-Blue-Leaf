<?php

$con = mysql_connect("localhost", "root", "mike911");

if(!$con)
{
  die('Could not connect: ' . mysql_error());


}

mysql_select_db("blueleaf", $con);


?>