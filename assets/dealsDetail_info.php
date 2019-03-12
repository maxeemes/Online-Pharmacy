<?php
session_start();

	$host = "localhost";
  	$login = "root";
  	$passwd = "";
  	$db = "pharmacy_db";
	

  	$conn = mysqli_connect($host, $login, $password, $db);

  	if (!$conn) {
  		die("Connection failed: " . mysqli_connect_error());
      exit;
  	}

	$query = "SELECT deal_name_customer FROM deal Where deal_id = {$_SESSION['deal_id']};";
	$result = mysqli_query($conn, $query);
	$DealCustomerName = mysqli_fetch_assoc($result);	
	$DealCustomerName = $DealCustomerName["deal_name_customer"];
	$_SESSION['DealCustomerName'] = $DealCustomerName;
	
	$query2 = "SELECT deal_product_name FROM deal Where deal_id = {$_SESSION['deal_id']};";
	$result2 = mysqli_query($conn, $query2);
	$DealProductName = mysqli_fetch_assoc($result2);
	$DealProductName = $DealProductName["deal_product_name"];
	$_SESSION['DealProductName'] = $DealProductName;
	
	$query3 = "SELECT deal_count FROM deal Where deal_id = {$_SESSION['deal_id']};";
	$result3 = mysqli_query($conn, $query3);
	$DealCount = mysqli_fetch_assoc($result3);	
	$DealCount = $DealCount["deal_count"];
	$_SESSION['DealCount'] = $DealCount;
	
	$query4 = "SELECT deal_date FROM deal Where deal_id = {$_SESSION['deal_id']};";
	$result4 = mysqli_query($conn, $query4);
	$DealDate = mysqli_fetch_assoc($result4);	
	$DealDate = $DealDate["deal_date"];
	$_SESSION['DealDate'] = $DealDate;
	
	$query5 = "SELECT deal_delivery_type FROM deal Where deal_id = {$_SESSION['deal_id']};";
	$result5 = mysqli_query($conn, $query5);
	$DealDeliveryType = mysqli_fetch_assoc($result5);	
	$DealDeliveryType = $DealDeliveryType["deal_delivery_type"];
	$_SESSION['DealDeliveryType'] = $DealDeliveryType;
	
	$query6 = "SELECT deal_cost FROM deal Where deal_id = {$_SESSION['deal_id']};";
	$result6 = mysqli_query($conn, $query6);
	$DealCost = mysqli_fetch_assoc($result6);	
	$DealCost = $DealCost["deal_cost"];
	$_SESSION['DealCost'] = $DealCost;
	  
?>				