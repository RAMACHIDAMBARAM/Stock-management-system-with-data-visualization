<?php 
	@include 'password_generator.php'; 
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="css/forgot.css"">
	</head>
	<body>
		<center>	
			<div class="content">
				<img src="IMAGES/logo.png" alt="logoicon" class="logoicon">
				<form action="forgot.php#" method="post">
					<label class="heading">Email :</label>
					<input name="email" type="text">
					<input class="button" type="submit" name="submit"  value="Reset Password" >
				</form>
				<p><b>NOTE :</b> Enter your account email, password will be sent to your email address.</p>
				<label>Return back to 
				<a class="login" href="index.html">LOGIN</a>
				</label>
			</div>
		</center>
		<footer style="color:#DAA520">
			&copy; Copyrights Reserved by RM.R and Team
		</footer>
	</body>
</html>

