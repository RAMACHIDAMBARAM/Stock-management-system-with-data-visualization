<?php
@require 'connection.php';
@include 'session.php'; 
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>ADD SUPPLIER DATA - Stock Management</title>
		<link rel="stylesheet" href="../CSS/style-addsupplier.css">
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
				<h3>ADD SUPPLIER DATA</h3>
				<form action="#" method="POST">	
					<ul class = "left">
						<li class = "id1">SUPPLIER ID</li>
						<li class = "id1">SUPPLIER NAME</li>
						<li class = "id1">ENTERPRISE NAME</li>
						<li class = "id1">CONTACT NUMBER</li>
						<li class = "id1">ADDRESS</li>
						<li class = "id1">STATE</li>
					</ul>
					<ul class = "left-text">
						<li><input size="15" type="text" name="Supplier_id" required/></li>
						<li><input size="15" type="text" name="Supplier_name" required/></li>
						<li><input size="15" type="text" name="Enterprise_name" required/></li>
						<li><input size="15" type="text" name="Contact_no" required/></li>
						<li><input size="15" type="text" name="Address" required/></li>
						<li><input size="15" type="text" name="State" required/></li>
					</ul>
					<ul class = "right">
						<li>DISTRICT</li>
						<li>CITY/TOWN</li>
						<li>COUNTRY</li>
						<li>CATEGORY</li>
						<li>MATERIALS PROVIDED</li>
						<br>
						<br>
						<li>
							<input class="button" type="submit" name="b_add" value="ADD" width="7"/>
							<input class="button" type="reset" name="b_reset" value="RESET" width="7"/>
						</li>
					</ul>
					<ul class = "right-text">
						
						<li><input size="15" type="text" name="District" required/></li>
						<li><input size="15" type="text" name="City_town" required/></li>
						<li><input size="15" type="text" name="Country" required/></li>
						<li><input size="15" type="text" name="Category" required/></li>
						<li><textarea style="border:1px solid #daa520;" input cols="16.5" rows="5" type="text" name="Materials_provided" required/></textarea></li>
					</ul>
				</form>
				<?php
					if(isset($_POST['b_add']))
					{
						$query = "INSERT INTO `stock_management` (`Supplier_id`, `supplier_name`, `enterprise_name`, `contact_no`,
								 `address`, `state`, `district`, `city_town`, `country`, `materials_provided`,`category`) 
								  VALUES ('".$_POST['Supplier_id']."', '".$_POST['Supplier_name']."', '".$_POST['Enterprise_name']."', 
										  ".$_POST['contact_no'].", '".$_POST['Address']."', '".$_POST['State']."','".$_POST['District']."',
										  '".$_POST['City_town']."','".$_POST['Country']."','".$_POST['Materials_provided']."',
										  '".$_POST['Category']."')";
						if($isquery = mysql_query($query))
						{
							echo "<script language = \"javascript\">alert('Submitted Sucessfully.')</script>";
							echo "<script>setTimeout(\"location.href = 'Viewsupplier.php';\",20);</script>";
						}
						else
							echo '<script>alert("Failed to submit!\n\nNOTE: SUPPLIER ID must be unique.")</script>';	
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

