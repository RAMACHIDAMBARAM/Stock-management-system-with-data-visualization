<?php
@require 'connection.php';

$query = "SELECT * FROM `stock_management`.`stock_management`";
	$output = mysql_query($query);
		$result_array = array();
		if(mysql_num_rows($output))
		{
			while($row=mysql_fetch_assoc($output))
			{
				$result_array[] = $row;
			}
		}
		
		//$rows = count($result_array);
		
		//var_dump($result_array);
		
		echo json_encode($result_array);
			 
?>