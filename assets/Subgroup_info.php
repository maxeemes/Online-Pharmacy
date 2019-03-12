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
	
	$ParentCategoryName = $_SESSION["ParentCatetegoryName"];
	
	$query = "SELECT category_id FROM category Where category_category = '" . $ParentCategoryName ."';";
	$result = mysqli_query($conn, $query);
	$PatentCategoryId = mysqli_fetch_assoc($result);
	
	$PatentCategoryId = $PatentCategoryId["category_id"];
	$_SESSION["PatentCategoryId"] = $PatentCategoryId;
	
	
	$query0 = "SELECT category_status from category Where category_sub = '" . $PatentCategoryId ."';";
	$result0 = mysqli_query($conn,$query0);
	$SubCategoryStatusArray = array();
	while ($row = $result0->fetch_array())
    $SubCategoryStatusArray[] = $row[0];
	$_SESSION["SubCategoryStatusArray"] = $SubCategoryStatusArray;
	
	$query2 = "SELECT category_category from category Where category_sub = '" . $PatentCategoryId . "';";
	$result2 = mysqli_query($conn,$query2);
	$ParentCategoryNameArray = array();
	while ($row = $result2->fetch_array())
    $ParentCategoryNameArray[] = $row[0];
	$_SESSION["ParentCategoryNameArray"] = $ParentCategoryNameArray;
	
	$query3 = "SELECT COUNT(category_id) FROM category Where category_sub = '" . $PatentCategoryId . "';";
	$result3 = mysqli_query($conn, $query3);
	$SubCatCount = mysqli_fetch_assoc($result3);
	
	$SubCatCount = $SubCatCount["COUNT(category_id)"];
	$_SESSION["SubCatCount"] = $SubCatCount;
	
	$query4 = "SELECT category_image from category Where category_sub = '" . $PatentCategoryId . "';";
	$result4 = mysqli_query($conn,$query4);
	$SubCatImage = array();
	while ($row = $result4->fetch_array())
    $SubCatImage[] = $row[0];
	$_SESSION["SubCatImage"] = $SubCatImage;
	
?>