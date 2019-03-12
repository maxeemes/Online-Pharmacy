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
	

	$query = "SELECT product_cost FROM product Where product_name = '{$_SESSION['RedProductName']}';";
	$result = mysqli_query($conn, $query);
	$RedProductCost = mysqli_fetch_assoc($result);	
	$RedProductCost = $RedProductCost["product_cost"];
	$_SESSION['RedProductCost'] = $RedProductCost;
	
	$query2 = "SELECT product_description FROM product Where product_name = '{$_SESSION['RedProductName']}';";
	$result2 = mysqli_query($conn, $query2);
	$RedProductDescription = mysqli_fetch_assoc($result2);	
	$RedProductDescription = $RedProductDescription["product_description"];
	$_SESSION['RedProductDescription'] = $RedProductDescription;
	
	$query3 = "SELECT product_image FROM product Where product_name = '{$_SESSION['RedProductName']}';";
	$result3 = mysqli_query($conn, $query3);
	$RedProductImage = mysqli_fetch_assoc($result3);	
	$RedProductImage = $RedProductImage["product_image"];
	$_SESSION['RedProductImage'] = $RedProductImage;
	
	$query4 = "SELECT product_count FROM product Where product_name = '{$_SESSION['RedProductName']}';";
	$result4 = mysqli_query($conn, $query4);
	$RedProductCount = mysqli_fetch_assoc($result4);	
	$RedProductCount = $RedProductCount["product_count"];
	$_SESSION['RedProductCount'] = $RedProductCount;
	
	$query5 = "SELECT product_characteristic FROM product Where product_name = '{$_SESSION['RedProductName']}';";
	$result5 = mysqli_query($conn, $query5);
	$RedProductCharacteristic = mysqli_fetch_assoc($result5);	
	$RedProductCharacteristic = $RedProductCharacteristic["product_characteristic"];
	$_SESSION['RedProductCharacteristic'] = $RedProductCharacteristic;
	
	$query6 = "SELECT product_id FROM product Where product_name = '{$_SESSION['RedProductName']}';";
	$result6 = mysqli_query($conn, $query6);
	$RedProductId = mysqli_fetch_assoc($result6);	
	$RedProductId = $RedProductId["product_id"];
	$_SESSION['RedProductId'] = $RedProductId;
	
	
	/*echo $_SESSION['RedProductCost'];
	echo $_SESSION['RedProductDescription'];
	echo $_SESSION['RedProductImage'];
	echo $_SESSION['RedProductCount'];
	echo $_SESSION['RedProductCharacteristic'];
*/
	
	
?>