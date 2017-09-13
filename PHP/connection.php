<?php

$mysql_hostname= "localhost";
$mysql_username= "root";
$mysql_password= "";

if(@mysql_connect($mysql_hostname, $mysql_username, $mysql_password))
	@mysql_select_db('stock_management') or die("Database not found");
else
	die("Cannot connect to database");
?>