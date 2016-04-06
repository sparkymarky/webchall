<?php
session_start();

$con = mysql_connect("fake, "temp", "pass") or die("MySQL Error: " . mysql_error());
$datab = mysql_select_db("temp", $con) or die("MySQL Error: " . mysql_error());
?>
