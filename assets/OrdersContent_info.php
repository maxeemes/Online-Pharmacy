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
	

	$query = "SELECT customer_name FROM customer;";
	$result = mysqli_query($conn, $query);
	$Customers = array();
	while ($row = $result->fetch_array())
    $Customers[] = $row[0];
	$_SESSION["Customers"] = $Customers;
	
	
	
?>