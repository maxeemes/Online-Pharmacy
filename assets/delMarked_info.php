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
	
	$query = "SELECT category_category FROM category Where category_status = '0' And category_sub = 'null';";
	$result = mysqli_query($conn, $query);
	$_SESSION["DelMarkedCategory"] = $result;
	
	$query2 = "SELECT category_category FROM category Where category_status = '0' And category_sub != 'null';";
	$result2 = mysqli_query($conn, $query2);
	$_SESSION["DelMarkedSubCategory"] = $result2;
	
	$query3 = "SELECT product_name FROM product Where product_status = '0';";
	$result3 = mysqli_query($conn, $query3);
	$_SESSION["DelMarkedProduct"] = $result3;
	
	$query4 = "SELECT customer_name FROM customer Where customer_status = '0';";
	$result4 = mysqli_query($conn, $query4);
	$_SESSION["DelMarkedCustomer"] = $result4;
	
	$query5 = "SELECT deal_name_customer,deal_date FROM deal Where deal_status = '0';";
	$result5 = mysqli_query($conn, $query5);
	$_SESSION["DelMarkedDeal"] = $result5;

?>