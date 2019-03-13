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
	
    if($_SESSION["status"] != 0) {
        $query = "SELECT customer_name FROM customer;";
        $result = mysqli_query($conn, $query);
        $Customers = array();
        while ($row = $result->fetch_array())
            $Customers[] = $row[0];
        $_SESSION["Customers"] = $Customers;
    }else{
        $query = "SELECT customer_adress FROM customer WHERE customer_user ='{$_SESSION["login"]}';";
        $result = mysqli_query($conn, $query);
        $Customers = array();
        if($result) {
            while ($row = $result->fetch_array())
                $Customers[] = $row[0];
            $_SESSION["Customers"] = $Customers;
        }else $_SESSION["Customers"] = null;
    }


?>