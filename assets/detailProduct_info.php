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
	

	$query = "SELECT product_cost FROM product Where product_name = '" . $_SESSION["ParentProductName"] ."';";
	$result = mysqli_query($conn, $query);
	$DetailProductCost = mysqli_fetch_assoc($result);
	
	$DetailProductCost = $DetailProductCost["product_cost"];
	$_SESSION["DetailProductCost"] = $DetailProductCost;

	
	$query2 = "SELECT product_characteristic FROM product Where product_name = '" . $_SESSION["ParentProductName"] ."';";
	$result2 = mysqli_query($conn, $query2);
	$DetailProductCharecteristic = mysqli_fetch_assoc($result2);
	
	$DetailProductCharecteristic = $DetailProductCharecteristic["product_characteristic"];
	$_SESSION["DetailProductCharecteristic"] = $DetailProductCharecteristic;
		
	
	$query3 = "SELECT product_description FROM product Where product_name = '" . $_SESSION["ParentProductName"] ."';";
	$result3 = mysqli_query($conn, $query3);
	$DetailProductDescription = mysqli_fetch_assoc($result3);
	
	$DetailProductDescription = $DetailProductDescription["product_description"];
	$_SESSION["DetailProductDescription"] = $DetailProductDescription;
	
	$query4 = "SELECT product_count FROM product Where product_name = '" . $_SESSION["ParentProductName"] ."';";
	$result4 = mysqli_query($conn, $query4);
	$DetailProductCount = mysqli_fetch_assoc($result4);
	
	$DetailProductCount = $DetailProductCount["product_count"];
	$_SESSION["DetailProductCount"] = $DetailProductCount;
	
	$query5 = "SELECT product_image FROM product Where product_name = '" . $_SESSION["ParentProductName"] ."';";
	$result5 = mysqli_query($conn, $query5);
	$DetailProductImage = mysqli_fetch_assoc($result5);
	
	$DetailProductImage = $DetailProductImage["product_image"];
	$_SESSION["DetailProductImage"] = $DetailProductImage;
	

?>