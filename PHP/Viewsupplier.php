<?php
@require 'connection.php';
@include 'session.php';
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Purchase - Stock Management</title>
		<link rel="stylesheet" href="../CSS/style-viewsupplier.css">
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
				<h3>PURCHASE</h3>
				<form action="#" method="POST">
					<input class="search" size="10" type="text" name="search" placeholder=" Search" />
					<input class="button" type="submit" name="b_search" value="SEARCH"/>
					<p><b>Records per page</b></p>
					<input class="search" size="10" type="text" name="records" placeholder=" No.of records"/>
					<input class="button" type="submit" name="b_go" value="GO" width="3"/>
					<input class="search" size="7" type="text" name="bill_search" placeholder=" supplier_Id" />
					<input class="button" type="submit" name="b_searchbill" value="SEARCH"/>	
					<input class="button" type="submit" name="b_deleteselect" value="DELETE SELECTED" width="15"/>				
					<div class="table">					
						<table>
							<thead>
								<th>SELECT ALL<br><input type="checkbox" id="select_all"/></th>
								<th>SUPPLIER ID</th>
								<th>SUPPLIER NAME</th>
								<th>ENTERPRISE NAME</th>
								<th>CONTACT NUMBER</th>
								<th>ADDRESS</th>
								<th>STATE</th>
								<th>DISTRICT</th>
								<th>CITY/TOWN</th>
								<th>COUNTRY</th>
								<th>MATERIALS PROVIDED</th>
								<th>CATEGORY</th>
							</thead>
							<tbody>
							<?php
								$query = "SELECT * FROM `supplier_management`";
								if(isset($_POST['b_deleteselect']) and !empty($_POST['check']))
								{
									foreach($_POST['check'] as $selected)
									{
										$squery = 'DELETE FROM `supplier_management` WHERE `supplier_management`.`supplier_id` = '.$selected.'';
										mysql_query($squery);
									}
								}
								
								if(!empty($_POST['search']) and isset($_POST['b_search']))
								{
									$term = mysql_real_escape_string($_POST['search']);
									$query_search = "SELECT * FROM `stock_management`.`supplier_management` WHERE (CONVERT(`supplier_id` USING utf8) LIKE '%".$term."%'  
													OR CONVERT(`supplier_name` USING utf8) LIKE '%".$term."%' 													
													OR CONVERT(`enterprise_name` USING utf8) LIKE '%".$term."%' 
													OR CONVERT(`contact_no` USING utf8) LIKE '%".$term."%' 
													OR CONVERT(`address` USING utf8) LIKE '%".$term."%' 
													OR CONVERT(`state` USING utf8) LIKE '%".$term."%' 
													OR CONVERT(`district` USING utf8) LIKE '%".$term."%' 
													OR CONVERT(`city_town` USING utf8) LIKE '%".$term."%' 
													OR CONVERT(`country` USING utf8) LIKE '%".$term."%'
													OR CONVERT(`materials_provided` USING utf8) LIKE '%".$term."%'
													OR CONVERT(`category` USING utf8) LIKE '%".$term."%')";
									if($is_query = mysql_query($query_search))
										while($query_data = mysql_fetch_array($is_query))			
											echo '<tr class="row">
												<td><input class="checkbox" type="checkbox" name="check[]" value ="'.$query_data['supplier_id'].'"></td>
												<td>'.$query_data['supplier_id'].'</td>
												<td>'.$query_data['supplier_name'].'</td>
												<td>'.$query_data['enterprise_name'].'</td>
												<td>'.$query_data['contact_no'].'</td>
												<td>'.$query_data['address'].'</td>
												<td>'.$query_data['state'].'</td>
												<td>'.$query_data['district'].'</td>
												<td>'.$query_data['city_town'].'</td>
												<td>'.$query_data['country'].'</td>
												<td>'.$query_data['materials_provided'].'</td>
												<td>'.$query_data['category'].'</td></tr>';
								}
								else if(!empty($_POST['bill_search']) and isset($_POST['b_searchbill']))
								{
									$term = mysql_real_escape_string($_POST['bill_search']);
									$query_search = "SELECT * FROM `stock_management`.`supplier_management` WHERE (CONVERT(`supplier_id` USING utf8) LIKE '%".$term."%')";
									if($is_query = mysql_query($query_search))
										while($query_data = mysql_fetch_array($is_query))			
											echo '<tr class="row">
												<td><input class="checkbox" type="checkbox" name="check[]" value ="'.$query_data['supplier_id'].'"></td>
												<td>'.$query_data['supplier_id'].'</td>
												<td>'.$query_data['supplier_name'].'</td>
												<td>'.$query_data['enterprise_name'].'</td>
												<td>'.$query_data['contact_no'].'</td>
												<td>'.$query_data['address'].'</td>
												<td>'.$query_data['state'].'</td>
												<td>'.$query_data['district'].'</td>
												<td>'.$query_data['city_town'].'</td>
												<td>'.$query_data['country'].'</td>
												<td>'.$query_data['materials_provided'].'</td>
												<td>'.$query_data['category'].'</td></tr>';
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
												<td><input class="checkbox" type="checkbox" name="check[]" value ="'.$query_data['supplier_id'].'"></td>
												<td>'.$query_data['supplier_id'].'</td>
												<td>'.$query_data['supplier_name'].'</td>
												<td>'.$query_data['enterprise_name'].'</td>
												<td>'.$query_data['contact_no'].'</td>
												<td>'.$query_data['address'].'</td>
												<td>'.$query_data['state'].'</td>
												<td>'.$query_data['district'].'</td>
												<td>'.$query_data['city_town'].'</td>
												<td>'.$query_data['country'].'</td>
												<td>'.$query_data['materials_provided'].'</td>
												<td>'.$query_data['category'].'</td></tr>';
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
												<td><input class="checkbox" type="checkbox" name="check[]" value ="'.$query_data['supplier_id'].'"></td>
												<td>'.$query_data['supplier_id'].'</td>
												<td>'.$query_data['supplier_name'].'</td>
												<td>'.$query_data['enterprise_name'].'</td>
												<td>'.$query_data['contact_no'].'</td>
												<td>'.$query_data['address'].'</td>
												<td>'.$query_data['state'].'</td>
												<td>'.$query_data['district'].'</td>
												<td>'.$query_data['city_town'].'</td>
												<td>'.$query_data['country'].'</td>
												<td>'.$query_data['materials_provided'].'</td>
												<td>'.$query_data['category'].'</td></tr>';
											$no_records++;
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

