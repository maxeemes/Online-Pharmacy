<?php
session_start;
	
	$host = "localhost";
  	$login = "root";
  	$passwd = "";
  	$db = "pharmacy_db";
	

  	$conn = mysqli_connect($host, $login, $passwd, $db);

  	if (!$conn) {
  		die("Connection failed: " . mysqli_connect_error());
      exit;
  	}
	
	$cat = $_GET['cat'];
	
	$query3 = "SELECT category_id FROM category Where category_category = '{$cat}';";
	$result3 = mysqli_query($conn, $query3);
	$UpCatId = mysqli_fetch_assoc($result3);
	
	$UpCatId = $UpCatId["category_id"];
	
	$result = mysqli_query($conn, "Select category_category From category Where category_sub = '{$UpCatId}'");
	
	if($result) {
		echo "<select> <option>---Выберите подкатегорию---</option></option>";
		while($row = mysqli_fetch_array($result))
		{
			echo "<option>{$row['category_category']}</option>";
		}
		echo "</select>";
	}
	else {
		echo "Error";
	}
	
?>