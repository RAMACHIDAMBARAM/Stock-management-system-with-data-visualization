<?php
@require 'connection.php';
session_start();


$user = $_SESSION['login'];
if ($user)

{

//user is logged in

		if(isset($_POST['submit']))
		{
		//check fields
		
		$oldpassword = sha1($_POST['oldpassword']);
		$newpassword = sha1($_POST['newpassword']);
		$repeatnewpassword = sha1($_POST['repeatnewpassword']);
		
		
		$queryget = mysql_query("SELECT password FROM stock_management.users WHERE username='$user'") or die("Query didn't work");
		$row = mysql_fetch_assoc($queryget);
		
		$oldpassworddb = $row['password'];
		echo $oldpassword;
		echo $oldpassworddb;
			
		
		//check oldpasswords
		if ($oldpassword==$oldpassworddb)
		{
		
		
		//check two new passwords
		if ($newpassword==$repeatnewpassword)
		{
		//success
		//change pass in db
	
		 if (!preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,16}$/', $newpassword))
		{
			echo '<script>alert("Valid password must contain:\n\nLength of 8-16\nAt least one lowercase char\nAt least one uppercase char\nAt least one digit\nAt least one special sign of   @#-_$%^&+=§!? \n\n")</script>';
			echo "<script>setTimeout(\"location.href = 'change_password.php';\",10);</script>";	
		}

		else
		{
			$querychange = mysql_query("UPDATE users SET password='$newpassword' WHERE username='$user'");
			session_destroy();
			echo '<script>alert("Password Changed Sucessfully!\n\nClick OK to login.")</script>';
			echo "<script>setTimeout(\"location.href = 'index.html';\",10);</script>";		
		}
		}
		else
		{
			echo "<script language = \"javascript\">alert('New password Doesnot Match')</script>";
			echo "<script>setTimeout(\"location.href = 'change_password.php';\",10);</script>";
		}
						
		}
		else
		{
			echo "<script language = \"javascript\">alert('Old password Doesnot Match')</script>";
			echo "<script>setTimeout(\"location.href = 'change_password.php';\",10);</script>";
		}		
		}
}		else
		   die("You must be logged in to change your password");
?>