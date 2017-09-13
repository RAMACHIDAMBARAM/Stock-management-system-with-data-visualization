<?php
@require 'connection.php';
@include 'session.php';
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>View Sales - Stock Management</title>
		<link rel="stylesheet" href="../CSS/style-sales.css">
	</head>
	<body>
		<div class="navbar">
			<ul> 
				<li><a href="dashboard.php">
						<img class = "img" src="../IMAGES/report.png" alt="drop.png" width="18px" height="18px"/> DASH BOARD</a></li>
				<li><a href="ViewSales.php">
						<img class = "img" src="../IMAGES/sales.png" alt="drop.png" width="18px" height="18px"/> SALES</a></li>
				<li><a href="purchase.php">
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
		<div class="back_bg">
			<div class = "aside">
				<ul>
					<li id="side_table_top">SALES MANAGEMENT</li>
					<li><a href="ViewSales.php">View Sales</a></li>
				</ul>
			</div>
			<div class="section">
				<h3>SALES</h3>
				<form action="#" method="POST">
					<input class="search" size="10" type="text" name="search" placeholder=" Search" />
					<input class="button" type="submit" name="b_search" value="SEARCH"/>
					<p><b>Records per page</b></p>
					<input class="search" size="10" type="text" name="records" placeholder=" No.of records"/>
					<input class="button" type="submit" name="b_go" value="GO" width="3"/>
					<input class="search" size="7" type="text" name="bill_search" placeholder=" Bill Search" />
					<input class="button" type="submit" name="b_searchbill" value="SEARCH"/>	
					<input class="button" type="submit" name="b_deleteselect" value="DELETE SELECTED" width="15"/>	
					<input class = "button" type = "submit" name="b_update1" value = "UPDATE SELECTED"/>					
					<div class="table">					
						<table>
							<thead>
								<th>SELECT ALL<br><input type="checkbox" id="select_all"/></th>
								<th>BILL NO</th>
								<th>DATE</th>
								<th>CUSTOMER</th>
								<th>CONTACT</th>
								<th>DISCOUNT</th>
								<th>PAYMENT MODE</th>
								<th>ADDRESS</th>
							</thead>
							<tbody>
							<?php
								$query = "SELECT * FROM `sales_management`";
								if(isset($_POST['b_deleteselect']) and !empty($_POST['check']))
								{
									foreach($_POST['check'] as $selected)
									{
										$squery = 'DELETE FROM `sales_management` WHERE `sales_management`.`BILL_NO` = '.$selected.'';
										mysql_query($squery);
									}
								}
								
								if(!empty($_POST['search']) and isset($_POST['b_search']))
								{
									$term = mysql_real_escape_string($_POST['search']);
									$query_search = "SELECT * FROM `stock_management`.`sales_management` WHERE (CONVERT(`DATE` USING utf8) LIKE '%".$term."%' 
													OR CONVERT(`CUSTOMER` USING utf8) LIKE '%".$term."%' 
													OR CONVERT(`BILL_NO` USING utf8) LIKE '%".$term."%' 
													OR CONVERT(`CONTACT` USING utf8) LIKE '%".$term."%' 
													OR CONVERT(`DISCOUNT` USING utf8) LIKE '%".$term."%' 
													OR CONVERT(`PAYMENT_MODE` USING utf8) LIKE '%".$term."%'
													OR CONVERT(`ADDRESS` USING utf8) LIKE '%".$term."%')";
									if($is_query = mysql_query($query_search))
										while($query_data = mysql_fetch_array($is_query))			
											echo '<tr class="row">
												<td><input class="checkbox" type="checkbox" name="check[]" value ="'.$query_data['BILL_NO'].'"></td>
												<td>'.$query_data['BILL_NO'].'</td>
												<td>'.$query_data['DATE'].'</td>
												<td>'.$query_data['CUSTOMER'].'</td>
												<td>'.$query_data['CONTACT'].'</td>
												<td>'.$query_data['DISCOUNT'].'</td>
												<td>'.$query_data['PAYMENT_MODE'].'</td>
												<td>'.$query_data['ADDRESS'].'</td></tr>';
								}
								else if(!empty($_POST['bill_search']) and isset($_POST['b_searchbill']))
								{
									$term = mysql_real_escape_string($_POST['bill_search']);
									$query_search = "SELECT * FROM `stock_management`.`sales_management` WHERE (CONVERT(`BILL_NO` USING utf8) LIKE '%".$term."%')";
									if($is_query = mysql_query($query_search))
										while($query_data = mysql_fetch_array($is_query))			
											echo '<tr class="row">
												<td><input class="checkbox" type="checkbox" name="check[]" value ="'.$query_data['BILL_NO'].'"></td>
												<td>'.$query_data['BILL_NO'].'</td>
												<td>'.$query_data['DATE'].'</td>
												<td>'.$query_data['CUSTOMER'].'</td>
												<td>'.$query_data['CONTACT'].'</td>
												<td>'.$query_data['DISCOUNT'].'</td>
												<td>'.$query_data['PAYMENT_MODE'].'</td>
												<td>'.$query_data['ADDRESS'].'</td></tr>';
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
												<td><input class="checkbox" type="checkbox" name="check[]" value="'.$query_data['BILL_NO'].'"></td>
												<td>'.$query_data['BILL_NO'].'</td>
												<td>'.$query_data['DATE'].'</td>
												<td>'.$query_data['CUSTOMER'].'</td>
												<td>'.$query_data['CONTACT'].'</td>
												<td>'.$query_data['DISCOUNT'].'</td>
												<td>'.$query_data['PAYMENT_MODE'].'</td>
												<td>'.$query_data['ADDRESS'].'</td></tr>';
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
												<td><input class="checkbox" type="checkbox" name="check[]" value="'.$query_data['BILL_NO'].'"></td>
												<td>'.$query_data['BILL_NO'].'</td>
												<td>'.$query_data['DATE'].'</td>
												<td>'.$query_data['CUSTOMER'].'</td>
												<td>'.$query_data['CONTACT'].'</td>
												<td>'.$query_data['DISCOUNT'].'</td>
												<td>'.$query_data['PAYMENT_MODE'].'</td>
												<td>'.$query_data['ADDRESS'].'</td></tr>';
											$no_records++;
										}
								}
							?>
							</tbody>
						</table>
					</div>
					<div class="modal" id="modal">
						<div class="modal-container animate" id="container">
							<h4>UPDATE SALES</h4>	
							<?php
								if(isset($_POST['b_update1']) and !empty($_POST['check']))
								{
									if(count($_POST['check']) < 2)
									{
										echo'
											<script>
												var modal = document.getElementById("modal");
												modal.style.display = "block";
											</script>';
										foreach($_POST['check'] as $selected)
										{
											$_SESSION['sd'] = $selected;
											$query_search = "SELECT * FROM `stock_management`.`sales_management` WHERE `BILL_NO` LIKE '".$selected."'";
											if($is_query = mysql_query($query_search))
												while($query_data = mysql_fetch_array($is_query))			
													echo '
													<ul class = "left">
														<li class = "id1">BILL NUMBER</li>
														<li class = "id1">CUSTOMER</li>
														<li class = "id1">DISCOUNT</li>
														<li class = "id1">ADDRESS</li>
													</ul>
													<ul class = "left-text">
														<li><input size="15" type="text" name="BILL_NO" placeholder ="'.$query_data['BILL_NO'].'" /></li>
														<li><input size="15" type="text" name="CUSTOMER" placeholder ="'.$query_data['CUSTOMER'].'"/></li>
														<li><input size="15" type="text" name="DISCOUNT" placeholder ="'.$query_data['DISCOUNT'].'"/></li>
														<li><input size="15" type="text" name="ADDRESS" placeholder ="'.$query_data['ADDRESS'].'" /></li>
													</ul>
													<ul class = "right">
														<li>DATE</li>
														<li>CONTACT</li>
														<li>PAYMENT MODE</li>
														<li>
															<input class="button1" type="submit" name="b_update" value="UPDATE" width="7"/>
															<input class="button1" id="close" type="button" value="CLOSE" width="7"/>
														</li>
													</ul>
													<ul class = "right-text">
														
														<li><input size="15" type="text" name="DATE" placeholder ="'.$query_data['DATE'].'" /></li>
														<li><input size="15" type="text" name="CONTACT" placeholder ="'.$query_data['CONTACT'].'" /></li>
														<li><input size="15" type="text" name="PAYMENT_MODE" placeholder ="'.$query_data['PAYMENT_MODE'].'" /></li>
													</ul>';
										}
									}
									else
									{
										echo "<script>alert('Please select one row at a time')</script>";
										echo "<script>setTimeout(\"location.href = 'ViewSales.php';\",20);</script>";
									}
								}
								if(isset($_POST['b_update1']) and empty($_POST['check']))
									echo '<script>alert("Please choose 1 entry to update")</script>';
								if(isset($_POST['b_update']))
								{
									$count = '0';
									if(!empty($_POST['BILL_NO']))
									{
										$query = "UPDATE `sales_management` SET `BILL_NO` = '".$_POST['BILL_NO']."' WHERE `sales_management`.`BILL_NO` = '".$_SESSION['sd']."'";
										if($isquery = mysql_query($query))
										{
											$count++;
										}
									}
									 if(!empty($_POST['DATE']))
									{
										$query = "UPDATE `sales_management` SET `DATE`='".$_POST['DATE']."' WHERE `sales_management`.`BILL_NO` = '".$_SESSION['sd']."'";
										if($isquery = mysql_query($query))
										{
											$count++;
										}
									}
									if(!empty($_POST['CUSTOMER']))
									{
										$query = "UPDATE `sales_management` SET `CUSTOMER`='".$_POST['CUSTOMER']."' WHERE `sales_management`.`BILL_NO` = '".$_SESSION['sd']."'";
										if($isquery = mysql_query($query))
										{
											$count++;
										}
									}
									if(!empty($_POST['CONTACT']))
									{
										$query = "UPDATE `sales_management` SET `CONTACT`='".$_POST['CONTACT']."' WHERE `sales_management`.`BILL_NO` = '".$_SESSION['sd']."'";
										if($isquery = mysql_query($query))
										{
											$count++;
										}
									}
									 if(!empty($_POST['DISCOUNT']))
									{
										$query = "UPDATE `sales_management` SET `DISCOUNT`='".$_POST['DISCOUNT']."' WHERE `sales_management`.`BILL_NO` = '".$_SESSION['sd']."'";
										if($isquery = mysql_query($query))
										{
											$count++;
										}
									}
									if(!empty($_POST['PAYMENT_MODE']))
									{
										$query = "UPDATE `sales_management` SET `PAYMENT_MODE`='".$_POST['PAYMENT_MODE']."' WHERE `sales_management`.`BILL_NO` = '".$_SESSION['sd']."'";
										if($isquery = mysql_query($query))
										{
											$count++;
										}
									}
								   if(!empty($_POST['ADDRESS']))
									{
										$query = "UPDATE `sales_management` SET `ADDRESS`='".$_POST['ADDRESS']."' WHERE `sales_management`.`BILL_NO` = '".$_SESSION['sd']."'";
										if($isquery = mysql_query($query))
										{
											$count++;
										}
									}
									if($count>0)
									{
										echo "<script>alert('Updated Successfully')</script>";
										echo "<script>setTimeout(\"location.href = 'ViewSales.php';\",20);</script>";
									}
									else
									{
										echo '<script>alert("No changes made")</script>';
									}
								}
							?>
						</div>
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
					
					var modal = document.getElementById("modal");
					var close = document.getElementById("close");
					
					close.onclick = function(){
						modal.style.display = "none";
					}
				</script>
			</div>
		</div>
		<footer style="color:#DAA520">
			&copy; Copyrights Reserved by RM.R and Team
		</footer>
	</body>
</html>