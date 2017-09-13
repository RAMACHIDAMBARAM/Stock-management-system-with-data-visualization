<?php
   @include 'connection.php';
   session_start();
   
   $username = $_SESSION['login'];
   
   $check ="select*from stock_management.billing where username = '$username'";
   
    $result = mysql_query($check);
	
   
   $login_session = $result['username'];
   
   if(!isset($_SESSION['login'])){
		header("location:index.html");
	}s
?>