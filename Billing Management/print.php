<?php
 @include 'connection.php';
 session_start();

 if($_SERVER["REQUEST_METHOD"] == "POST")
 {
	if ($_POST['itemname']) {
foreach ( $_POST['itemname'] as $key=>$value ) {
$values = mysql_real_escape_string($value);
echo $values;
 }
 }
 }
 ?>