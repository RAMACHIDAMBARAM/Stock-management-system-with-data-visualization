<?php
@require 'change_password_validation.php';
@include 'session.php';

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Change Password - Stock Management</title>
		<link rel="stylesheet" href="../CSS/change_password.css">
	</head>
	<body>
		<div class="navbar">
			<ul> 
				<li><a href="dashboard.php">
						<img class = "img" src="../IMAGES/report.png" alt="drop.png" width="18px" height="18px"/> DASH BOARD</a></li>
				<li><a href="ViewSales.php">
						<img class = "img" src="../IMAGES/sales.png" alt="drop.png" width="18px" height="18px"/> SALES</a></li>
				<li><a href="Viewpurchase.php">
						<img class = "img" src="../IMAGES/suppliers.png" alt="drop.png" width="18px" height="18px"/> PURCHASE</a></li>
				<li><a href="ViewStock.php">
						<img class = "img" src="../IMAGES/stock.png" alt="drop.png" width="18px" height="18px"/> STOCK LIST</a></li>
				<li class="dropdown">
					<a href="javascript:void(0)" class="dropbtn" onclick="myFunction()">
						<img class = "img" src="../IMAGES/accounts.png" alt="drop.png" width="18px" height="18px"/> ACCOUNT </a>
					<div class="dropdown-content" id="myDropdown">
						<a class="dropDown" href="change_password.php">
							<img class = "img" src="../IMAGES/change_password.png" alt="drop.png" width="15px" height="15px"/> CHANGE PASSWORD</a>
						<a class="dropDown" href="logout.php"> 
							<img class = "img" src="../IMAGES/logout.png" alt="drop.png" width="15px" height="15px"/>  LOGOUT</a>
					</div>
				</li>
			</ul>
		</div>
		<div class = "back_bg">
			<form action='change_password_validation.php' method='POST'>
				<h3>Change Password</h3>
				<ul class = "text">
					<li>Old password:</li>                    
					<li>New password:</li>	                     
					<li>Repeat new password:</li>
				</ul>
				<ul class = "input">
					<li><input type='password' name='newpassword' required><p>
					<li><input type='password' name='oldpassword' required><p>			
					<li><input type='password' name='repeatnewpassword' required><p>
				</ul>
				<center><button class="button" type='submit' name='submit'>Reset</button></center>
			</form>
		</div>
		<script language = "javascript">
			function myFunction() {
				document.getElementById("myDropdown").classList.toggle("show");
			}
			
			window.onclick = function(e) {
				if (!e.target.matches('.dropbtn')) {
					var dropdowns = document.getElementsByClassName("dropdown-content");
						for (var d = 0; d < dropdowns.length; d++) {
							var openDropdown = dropdowns[d];
								if (openDropdown.classList.contains('show')) {
									openDropdown.classList.remove('show');
								}
						}
				}
			}
		</script>
		<footer style="color:#DAA520">
			&copy; Copyrights Reserved by RM.R and Team
		</footer>
	</body>
</html>

		