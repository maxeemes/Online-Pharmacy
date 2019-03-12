<?php
//session_start();
$host = "localhost";
  	$login = "root";
  	$passwd = "";
  	$db = "pharmacy_db";
	

  	$conn = mysqli_connect($host, $login, $passwd, $db);

  	if (!$conn) {
  		die("Connection failed: " . mysqli_connect_error());
      exit;
  	}
	
	$query = "SELECT COUNT(category_id) FROM category;";
	$result = mysqli_query($conn, $query);
	$CatCount = mysqli_fetch_assoc($result);
	
	$CatCount = $CatCount["COUNT(category_id)"];
	$_SESSION["CatCount"] = $CatCount;
	
	
	$query2 = "SELECT category_category from category;";
	$result2 = mysqli_query($conn,$query2);
	$array1 = array();
	while ($row = $result2->fetch_array())
    $array1[] = $row[0];
	$_SESSION["CategoryName"] = $array1;
	
	$query3 = "SELECT category_image from category;";
	$result3 = mysqli_query($conn,$query3);
	$array2 = array();
	while ($row = $result3->fetch_array())
    $array2[] = $row[0];
	$_SESSION["CategoryImage"] = $array2;
	
	$query4 = "SELECT category_sub from category;";
	$result4 = mysqli_query($conn,$query4);
	$IsNotSubArray = array();
	while ($row = $result4->fetch_array())
    $IsNotSubArray[] = $row[0];
	$_SESSION["IsNotSubArray"] = $IsNotSubArray;
	
	$query5 = "SELECT category_status from category;";
	$result5 = mysqli_query($conn,$query5);
	$CategoryStatus = array();
	while ($row = $result5->fetch_array())
    $CategoryStatus[] = $row[0];
	$_SESSION["CategoryStatus"] = $CategoryStatus;
?>