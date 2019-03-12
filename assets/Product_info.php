<?php
session_start();

	$host = "localhost";
  	$login = "root";
  	$passwd = "";
  	$db = "pharmacy_db";
	

  	$conn = mysqli_connect($host, $login, $passwd, $db);

  	if (!$conn) {
  		die("Connection failed: " . mysqli_connect_error());
      exit;
  	}
	
	$ParentSubCatetegoryName = $_SESSION["ParentSubCatetegoryName"];
	

	$query = "SELECT category_id FROM category Where category_category = '" . $ParentSubCatetegoryName ."';";
	$result = mysqli_query($conn, $query);
	$ParentSubCatetegoryId = mysqli_fetch_assoc($result);
	
	$ParentSubCatetegoryId = $ParentSubCatetegoryId["category_id"];
	$_SESSION["ParentSubCatetegoryId"] = $ParentSubCatetegoryId;
	
	
	$query2 = "SELECT COUNT(product_id) FROM product;";
	$result2 = mysqli_query($conn, $query2);
	$PruductCount = mysqli_fetch_assoc($result2);
	
	$PruductCount = $PruductCount["COUNT(product_id)"];
	$_SESSION["PruductCount"] = $PruductCount;	

	$query3 = "SELECT product_name from product Where product_category = '" . $ParentSubCatetegoryId . "';";
	$result3 = mysqli_query($conn,$query3);
	$ProductNamesArray = array();
	while ($row = $result3->fetch_array())
    $ProductNamesArray[] = $row[0];
	$_SESSION["ProductNamesArray"] = $ProductNamesArray;
	
	$query4 = "SELECT product_cost from product Where product_category = '" . $ParentSubCatetegoryId . "';";
	$result4 = mysqli_query($conn,$query4);
	$ProductCostsArray = array();
	while ($row = $result4->fetch_array())
    $ProductCostsArray[] = $row[0];
	$_SESSION["ProductCostsArray"] = $ProductCostsArray;

	$query5 = "SELECT product_image from product Where product_category = '" . $ParentSubCatetegoryId . "';";
	$result5 = mysqli_query($conn,$query5);
	$ProductImagesArray = array();
	while ($row = $result5->fetch_array())
    $ProductImagesArray[] = $row[0];
	$_SESSION["ProductImagesArray"] = $ProductImagesArray;
	
	$query6 = "SELECT product_status from product Where product_category = '" . $ParentSubCatetegoryId . "';";
	$result6 = mysqli_query($conn,$query6);
	$ProductStatusArray = array();
	while ($row = $result6->fetch_array())
    $ProductStatusArray[] = $row[0];
	$_SESSION["ProductStatusArray"] = $ProductStatusArray;
?>