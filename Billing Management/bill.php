<?php
@require 'connection.php';
@require 'session.php';
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>HTML invoice</title>
     <link rel="stylesheet" href="css/hello.css">
	<link rel='stylesheet' type='text/css' href='CSS/print.css' media="print" />
	<script type='text/javascript' src='js/jquery-1.3.2.min.js'></script>
	<script type='text/javascript' src='js/example.js'></script>
  
</head>

<body>
  
<html>
	<head>
		<meta charset="utf-8">
		<title>Invoice</title>
		<link rel="stylesheet" href="style.css">
		<script src="script.js"></script>
	</head>
	<body>
		<header>
			<h1>Invoice</h1>
			<address contenteditable="false">
				<p>RM.R AND TEAM</p>
				<p>NIIT UNIVERSITY<br>NEEMRANA , RAJASTHAN</p>
				<p>INDIA - 301705</p>
				<p>+91-1234567890</p>
			</address>
			<span><img alt="" src="IMAGES/logo.png" style="float:right"></span>
		</header>
		<form action="print.php" method="post">
		<div style="clear:both"></div>
		
		<div id="customer">
		<h5>CUSTOMER DETAILS :</h5>
<table id="meta" style="float:left">
				 <tr>
                    <td class="meta-head">Name</td>
                    <td><textarea name="customer_name"></textarea></td>
                </tr>
                <tr>

                    <td class="meta-head">Address</td>
                    <td><textarea name="address"></textarea></td>
                </tr>
              <tr>
                    <td class="meta-head">Contact</td>
                    <td><textarea name="contact_no"></textarea></td>
                </tr>
				</table>

            <table id="meta">
                <tr>
                    <td class="meta-head">Invoice ID</td>
                    <td><textarea name="bill_id"></textarea></td>
                </tr>
                <tr>

                    <td class="meta-head">Date</td>
                   <td><textarea id="date" name="date" readonly></textarea></td>
                </tr>
                <tr>
                    <td class="meta-head">Amount Due </td>
                    <td><div class="due" name="balance"></div></td>
                </tr>

            </table>
			</div>
			<br>
			<br>
			<div class="inventory">
			<table id="items">
		
		  <tr>
		      <th>Product Name</th>
			  <th>Barcode</th>
		      <th>Category</th>
		      <th>Unit Cost</th>
		      <th>Quantity</th>
		      <th>Price</th>
		  </tr>
		  	</div>
		  <tr class="item-row">
		      <td class="item-name"><div class="delete-wpr"><textarea name="itemname"></textarea><a class="delete" href="javascript:;" style="float:left" title="Remove row">X</a></div></td>
		      <td class="description1"><textarea name="description1"></textarea></td>
			  <td class="description"><textarea name="description"></textarea></td>
		      <td><textarea placeholder="₹" class="cost" name="cost"></textarea></td>
		      <td><textarea class="qty" name="qty"></textarea></td>
		      <td><span class="price" name="price"></span></td>
		  </tr>
		  
		 
		  <tr id="hiderow">
		    <td colspan="6"><a id="addrow" href="javascript:;" title="Add a row">Add a row</a></td>
		  </tr>
		  </table>
		  <br>
		  <br>
		  <table style="float:right ">
		  
		  <tr>
		      <td colspan="2" class="total-line">Subtotal</td>
		      <td class="total-value"><div id="subtotal"></div></td>
		  </tr>
		  <tr>
		      <td colspan="2" class="total-line">Total</td>
		      <td class="total-value" name="total"><div id="total"></div></td>
		  </tr>
		  <tr>
		      <td colspan="2" class="total-line">Amount Paid</td>
			  <td class="total-value"><a>₹</a><input id="paid" name="paid"></input></td>
		  </tr>
		  <tr>
		      <td colspan="2" class="total-line balance">Balance Due</td>
		      <td class="total-value balance"><div class="due"></div></td>
		  </tr>
	</table>
	<div>
	
	<header>
		<address contenteditable="false">
		<label>Signature</label>
				<p>Cashier</p>
				<p>RM.R And Team</p>
			</address>
		</header>
		</div>
		<div id="terms">
		  <h5 style="color:#daa520;">Terms</h5>
		  <textarea>NET 30 Days. Finance Charge of 1.5% will be made on unpaid balances after 30 days.</textarea>
		</div>
	
	</div>
	<a href="logout.php">LOGOUT</a>
	<input style="float:right" class="button1" type="submit" name="submit"  value="PRINT" >
	</form>
</body>

</html>