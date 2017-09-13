<?php
@require 'connection.php';
@include 'session.php'; 
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>ADD PURCHASE DATA - Stock Management</title>
		<link rel="stylesheet" href="../CSS/style-addpurchase.css">
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
							<img class = "img" src="../IMAGES/logout.png" alt="drop.png" width="15px" height="15px"/> LOGOUT</a>
					</div>
				</li>
			</ul>
		</div>
		<div class="back_bg">
			<div class = "aside">
				<ul>
					<li id="side_table_top">PURCHASE MANAGEMENT</li>
					<li><a href="Viewpurchase.php">View Purchase Data</a></li>
					<li><a href="Addpurchase.php">Add Purchase Data</a></li>
					<li><a href="Viewsupplier.php">View Supplier Data</a></li>
					<li><a href="Addsupplier.php">Add Supplier Data</a></li>
				</ul>
			</div>
			<div class="section">
				<h3>ADD PURCHASE DATA</h3>
				<form action="#" method="POST">	
					<ul class = "left">
						<li class = "id1">PURCHASE ID</li>
						<li class = "id1">CATEGORY</li>
						<li class = "id1">DATE</li>
						<li class = "id1">PRODUCT NAME</li>
						<li class = "id1">QUANTITY</li>
						<li class = "id1">AMOUNT PAID</li>
					</ul>
					<ul class = "left-text">
						<li><input size="15" type="text" name="purchase_id" required/></li>
						<li><input size="15" type="text" name="category" required/></li>
						<li><input size="15" type="date" name="date" required/></li>
						<li><input size="15" type="text" name="product_name" required/></li>
						<li><input size="15" type="text" name="quantity" required/></li>
						<li><input size="15" type="text" name="amount_paid" required/></li>
					</ul>
					<ul class = "right">
						<li>AMOUNT DUE</li>
						<li>CONTACT PERSON</li>
						<li>ENTERPRISE</li>
						<li>CONTACT NO</li>
						<li>DISCOUNT</li>
						<li>PAYMENT MODE</li>
						<li>
							<input class="button" type="submit" name="b_add" value="ADD" width="7"/>
							<input class="button" type="reset" name="b_reset" value="RESET" width="7"/>
						</li>
					</ul>
					<ul class = "right-text">
						
						<li><input size="15" type="text" name="amount_due" required/></li>
						<li><input size="15" type="text" name="seller_name" required/></li>
						<li><input size="15" type="text" name="enterprise_name" required/></li>
						<li><input size="15" type="text" name="contact_no" required/></li>
						<li><input size="15" type="text" name="discount" required/></li>
						<li><input size="15" type="text" name="mode_of_payment" required/></li>
					</ul>
				</form>
				<?php
					if(isset($_POST['b_add']))
					{
						$query = "INSERT INTO `purchase_management` (`purchase_id`, `date`, `category`, `product_name`,
								 `quantity`, `amount_paid`, `amount_due`, `seller_name`, `contact_no`,`mode_of_payment`, `discount`, `enterprise_name`) 
								  VALUES ('".$_POST['purchase_id']."', '".$_POST['date']."', '".$_POST['category']."', 
										  '".$_POST['product_name']."', '".$_POST['quantity']."', ".$_POST['amount_paid'].",
										  ".$_POST['amount_due'].",'".$_POST['seller_name']."',".$_POST['contact_no'].",
										  '".$_POST['mode_of_payment']."',".$_POST['discount'].",'".$_POST['enterprise_name']."')";
						if($isquery = mysql_query($query))
						{
							echo "<script language = \"JavaScript\">alert('Submitted Successfully.')</script>";
							echo "<script>setTimeout(\"location.href = 'ViewStock.php';\",20);</script>";
						}
						else
							echo '<script>alert("Failed to submit!\n\nNOTE: PURCHASE ID must be unique.")</script>';	
					}		
				?>
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
			</div>
		</div>
		<footer style="color:#DAA520">
			&copy; Copyrights Reserved by RM.R and Team
		</footer>
	</body>
</html>

