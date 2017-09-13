<?php
@require 'connection.php';
@include 'session.php'; 
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>ADD STOCK DATA - Stock Management</title>
		<link rel="stylesheet" href="../CSS/style-addstock.css">
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
					<li id="side_table_top">STOCK MANAGEMENT</li>
					<li><a href="ViewStock.php">View Stock Data</a></li>
					<li><a href="AddStock.php">Add Stock Data</a></li>
				</ul>
			</div>
			<div class="section">
				<h3>ADD STOCK DATA</h3>
				<form action="#" method="POST">	
					<ul class = "left">
						<li class = "id1">STOCK ID</li>
						<li class = "id1">CATEGORY ID</li>
						<li class = "id1">SELLING PRICE</li>
						<li class = "id1">QUANTITY</li>
					</ul>
					<ul class = "left-text">
						<li><input size="15" type="text" name="stock_id" required/></li>
						<li><input size="15" type="text" name="category_id" required/></li>
						<li><input size="15" type="text" name="selling_price" required/></li>
						<li><input size="15" type="text" name="quantity" required/></li>
					</ul>
					<ul class = "right">
						<li>STOCK NAME</li>
						<li>CATEGORY NAME</li>
						<li>PURCHASE PRICE</li>
						<li>
							<input class="button" type="submit" name="b_add" value="ADD" width="7"/>
							<input class="button" type="reset" name="b_reset" value="RESET" width="7"/>
						</li>
					</ul>
					<ul class = "right-text">
						
						<li><input size="15" type="text" name="stock_name" required/></li>
						<li><input size="15" type="text" name="category_name" required/></li>
						<li><input size="15" type="text" name="purchase_price" required/></li>
					</ul>
				</form>
				<?php
					if(isset($_POST['b_add']))
					{
						$query = "INSERT INTO `stock_management` (`Stock ID`, `Category`, `Category ID`, `StockName`,
								 `Selling Price`, `Purchase Price`, `Quantity`) 
								  VALUES ('".$_POST['stock_id']."', '".$_POST['category_name']."', '".$_POST['category_id']."', 
										  '".$_POST['stock_name']."', '".$_POST['selling_price']."', '".$_POST['purchase_price']."',
										  '".$_POST['quantity']."')";
						if($isquery = mysql_query($query))
						{
							echo "<script language = \"javascript\">alert('Submitted Sucessfully.')</script>";
							echo "<script>setTimeout(\"location.href = 'ViewStock.php';\",20);</script>";
						}
						else
							echo '<script>alert("Failed to submit!\n\nNOTE: STOCK ID must be unique.")</script>';	
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

