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
	

	$query = "SELECT category_category FROM category Where category_sub = 'null';";
	$result = mysqli_query($conn, $query);
	$NullCategoryArray = array();
	while ($row = $result->fetch_array())
    $NullCategoryArray[] = $row[0];
	$_SESSION["NullCategoryArray"] = $NullCategoryArray;

	$query2 = "SELECT category_category FROM category Where category_sub != 'null';";
	$result2 = mysqli_query($conn, $query2);
	$SubCategoryArray = array();
	while ($row = $result2->fetch_array())
    $SubCategoryArray[] = $row[0];
	$_SESSION["SubCategoryArray"] = $SubCategoryArray;
	
	
?>