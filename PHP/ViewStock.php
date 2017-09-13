<?php
@require 'connection.php';
@include 'session.php';
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>View Stocks - Stock Management</title>
		<link rel="stylesheet" href="../CSS/style-stock.css">
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
					<li><a href="bar.php">Generate Barcode</a></li>
					</ul>
			</div>
			<div class="section">
				<h3>STOCKS</h3>
				<form action="#" method="POST">
					<input class="search" size="10" type="text" name="stock_search" placeholder=" Stock Search" />
					<input class="button" type="submit" name="b_search" value="SEARCH"/>
					<p><b>Records per page</b></p>
					<input class="search" size="10" type="text" name="records" placeholder=" No.of records"/>
					<input class="button" type="submit" name="b_go" value="GO" width="3"/>
					<input class="search" size="13" type="text" name="category_search" placeholder=" Category_Id" />
					<input class="button" type="submit" name="b_searchcat" value="SEARCH"/>	
					<input class="button" type="submit" name="b_deleteselect" value="DELETE SELECTED" width="15"/>	
					<input class = "button" type = "submit" name="b_update1" value = "UPDATE SELECTED"/>						
					<div class="table">					
						<table>
							<thead>
								<th>SELECT ALL<br><input type="checkbox" id="select_all"/></th>
								<th>STOCK ID</th>
								<th>STOCK NAME</th>
								<th>CATEGORY ID</th>
								<th>CATERGORY</th>
								<th>SELLING PRICE</th>
								<th>PURCHASE PRICE</th>
								<th>QUANTITY</th>
							</thead>
							<tbody>
							<?php
								$query = "SELECT * FROM `stock_management`";
								
								if(isset($_POST['b_deleteselect']) and !empty($_POST['check']))
								{
									foreach($_POST['check'] as $selected)
									{
										$squery = "DELETE FROM `stock_management` WHERE `stock_management`.`Stock ID` = '".$selected."'";
										mysql_query($squery);
									}
								}
								
								if(!empty($_POST['stock_search']) and isset($_POST['b_search']))
								{
									$term = mysql_real_escape_string($_POST['stock_search']);
									$query_search = "SELECT * FROM `stock_management`.`stock_management` WHERE (CONVERT(`Stock ID` USING utf8) LIKE '%".$term."%' 
													OR CONVERT(`StockName` USING utf8) LIKE '%".$term."%' 
													OR CONVERT(`Category ID` USING utf8) LIKE '%".$term."%' 
													OR CONVERT(`Category` USING utf8) LIKE '%".$term."%' 
													OR CONVERT(`Selling Price` USING utf8) LIKE '%".$term."%' 
													OR CONVERT(`Purchase Price` USING utf8) LIKE '%".$term."%' 
													OR CONVERT(`Quantity` USING utf8) LIKE '%".$term."%')";
									if($is_query = mysql_query($query_search))
										while($query_data = mysql_fetch_array($is_query))			
											echo '<tr class="row">
												<td><input class="checkbox" type="checkbox" name="check[]" value ="'.$query_data['Stock ID'].'"></td>
												<td>'.$query_data['Stock ID'].'</td>
												<td>'.$query_data['StockName'].'</td>
												<td>'.$query_data['Category ID'].'</td>
												<td>'.$query_data['Category'].'</td>
												<td>'.$query_data['Selling Price'].'</td>
												<td>'.$query_data['Purchase Price'].'</td>
												<td>'.$query_data['Quantity'].'</td></tr>';
								}
								else if(!empty($_POST['category_search']) and isset($_POST['b_searchcat']))
								{
									$term = mysql_real_escape_string($_POST['category_search']);
									$query_search = "SELECT * FROM `stock_management`.`stock_management` WHERE (CONVERT(`Category` USING utf8) LIKE '%".$term."%')";
									if($is_query = mysql_query($query_search))
										while($query_data = mysql_fetch_array($is_query))			
											echo '<tr class="row">
												<td><input class="checkbox" type="checkbox" name="check[]" value ="'.$query_data['Stock ID'].'"></td>
												<td>'.$query_data['Stock ID'].'</td>
												<td>'.$query_data['StockName'].'</td>
												<td>'.$query_data['Category ID'].'</td>
												<td>'.$query_data['Category'].'</td>
												<td>'.$query_data['Selling Price'].'</td>
												<td>'.$query_data['Purchase Price'].'</td>
												<td>'.$query_data['Quantity'].'</td></tr>';
								}
								else if(!empty($_POST['records']) and isset($_POST['b_go']))
								{
									$_SESSION['records'] = $_POST['records'];
									$no_records = $_SESSION['records'];
									$count = 1;
									if($is_query = mysql_query($query))
										while($query_data = mysql_fetch_assoc($is_query) and $count <= $no_records)			
										{
											echo '<tr class="row">
												<td><input class="checkbox" type="checkbox" name="check[]" value ="'.$query_data['Stock ID'].'"></td>
												<td>'.$query_data['Stock ID'].'</td>
												<td>'.$query_data['StockName'].'</td>
												<td>'.$query_data['Category ID'].'</td>
												<td>'.$query_data['Category'].'</td>
												<td>'.$query_data['Selling Price'].'</td>
												<td>'.$query_data['Purchase Price'].'</td>
												<td>'.$query_data['Quantity'].'</td></tr>';
											$count++;
										}
								}
								else
								{
									if(isset($_SESSION['records']))
										$count = $_SESSION['records'];
									else 
										$count = 10;
									$no_records = 1;
									if($is_query = mysql_query($query))
										while($query_data = mysql_fetch_assoc($is_query) and $no_records <= $count)
										{
											echo '<tr class="row">
											  <td><input class="checkbox" type="checkbox" name="check[]" value ="'.$query_data['Stock ID'].'"></td>
												<td>'.$query_data['Stock ID'].'</td>
												<td>'.$query_data['StockName'].'</td>
												<td>'.$query_data['Category ID'].'</td>
												<td>'.$query_data['Category'].'</td>
												<td>'.$query_data['Selling Price'].'</td>
												<td>'.$query_data['Purchase Price'].'</td>
												<td>'.$query_data['Quantity'].'</td></tr>';	
											$no_records ++;
										}
								}
								if(isset($_POST['b_update1']) and empty($_POST['check']))
									echo '<script>alert("Please choose 1 entry to update")</script>';
								if(isset($_POST['b_update']))
								{
									$count = '0';
									if(!empty($_POST['Stock ID']))
									{
										$query = "UPDATE `stock_management` SET `Stock ID` = '".$_POST['Stock ID']."' WHERE `stock_management`.`Stock ID` = '".$_SESSION['sd']."'";
										if($isquery = mysql_query($query))
										{
											$count++;
										}
									}
									 if(!empty($_POST['StockName']))
									{
										$query = "UPDATE `stock_management` SET `StockName`='".$_POST['StockName']."' WHERE `stock_management`.`Stock ID` = '".$_SESSION['sd']."'";
										if($isquery = mysql_query($query))
										{
											$count++;
										}
									}
									if(!empty($_POST['Category ID']))
									{
										$query = "UPDATE `stock_management` SET `Category ID`='".$_POST['Category ID']."' WHERE `stock_management`.`Stock ID` = '".$_SESSION['sd']."'";
										if($isquery = mysql_query($query))
										{
											$count++;
										}
									}
									if(!empty($_POST['Category']))
									{
										$query = "UPDATE `stock_management` SET `Category`='".$_POST['Category']."' WHERE `stock_management`.`Stock ID` = '".$_SESSION['sd']."'";
										if($isquery = mysql_query($query))
										{
											$count++;
										}
									}
									 if(!empty($_POST['Selling Price']))
									{
										$query = "UPDATE `stock_management` SET `Selling Price`='".$_POST['Selling Price']."' WHERE `stock_management`.`Stock ID` = '".$_SESSION['sd']."'";
										if($isquery = mysql_query($query))
										{
											$count++;
										}
									}
									if(!empty($_POST['Purchase Price']))
									{
										$query = "UPDATE `stock_management` SET `Purchase Price`='".$_POST['Purchase Price']."' WHERE `stock_management`.`Stock ID` = '".$_SESSION['sd']."'";
										if($isquery = mysql_query($query))
										{
											$count++;
										}
									}
								   if(!empty($_POST['Quantity']))
									{
										$query = "UPDATE `stock_management` SET `Quantity`='".$_POST['Quantity']."' WHERE `stock_management`.`Stock ID` = '".$_SESSION['sd']."'";
										if($isquery = mysql_query($query))
										{
											$count++;
										}
									}
									if($count>0)
									{
										echo "<script>alert('Updated Successfully')</script>";
										echo "<script>setTimeout(\"location.href = 'ViewStock.php';\",20);</script>";
									}
									else
									{
										echo '<script>alert("No changes made")</script>';
									}
								}
							?>
							</tbody>
						</table>
					</div>
				</form>
				<script language = "javascript">
					var select_all = document.getElementById("select_all"); //select all checkbox
					var checkboxes = document.getElementsByClassName("checkbox"); //checkbox items

					//select all checkboxes
					select_all.addEventListener("change", function(e){
						for (i = 0; i < checkboxes.length; i++) { 
							checkboxes[i].checked = select_all.checked;
						}
					});


					for (var i = 0; i < checkboxes.length; i++) {
						checkboxes[i].addEventListener('change', function(e){ //".checkbox" change 
							//uncheck "select all", if one of the listed checkbox item is unchecked
							if(this.checked == false){
								select_all.checked = false;
							}
							//check "select all" if all checkbox items are checked
							if(document.querySelectorAll('.checkbox:checked').length == checkboxes.length){
								select_all.checked = true;
							}
						});
					}
					
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

