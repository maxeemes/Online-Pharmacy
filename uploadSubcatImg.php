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

if($_SESSION['inputSubCatName'] != ''){
	
	$query2 = "SELECT category_id FROM category Where category_category = '" . $_SESSION['inputSubCatName'] ."';";
	$result2 = mysqli_query($conn, $query2);
	$Category = mysqli_fetch_assoc($result2);							
	$Category = $Category["category_id"];
	
	$query3 = "SELECT category_id FROM category Where category_category = '" . $_SESSION['catSelect'] ."';";
	$result3 = mysqli_query($conn, $query3);
	$ParentCategoryId = mysqli_fetch_assoc($result3);							
	$ParentCategoryId = $ParentCategoryId["category_id"];
	
	
	
	
	if($Category == NULL){
		// Каталог, в который мы будем принимать файл:
$uploaddir = './img/subcats/';
if($_FILES['uploadfile']['name'] != ''){
$uploadfile = $uploaddir.basename($_FILES['uploadfile']['name']);
$result = copy($_FILES['uploadfile']['tmp_name'], $uploadfile);
}
else{
	$uploadfile = 'img/subcats/5.png';
}

	$sql = "Insert Into category (category_category,category_status
,category_sub,category_image) Values ('{$_SESSION['inputSubCatName']}','1','{$ParentCategoryId}','{$uploadfile}');";
	$result = mysqli_query($conn, $sql);
echo "<script>location.replace('addProduct.php');</script>";
	}
	else{
		echo <<<HTML
		<meta charset='utf-8'>
  <link rel="stylesheet"
  href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
  integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
  crossorigin="anonymous">
		<br>
		<div style='    display: flex;
						width: 50%;
						height: 10%;
						margin-top: 14rem;
						margin-left: 25%;'class="alert alert-danger" role="alert">
			Податегория с таким названием уже существует!	
				<form method='post'>
				<input style='margin-left: 10rem;' name='back' type='submit' value = 'Вернуться назад'>
				</form>
		</div>

HTML;
	}

}
else{
										echo <<<HTML
		<meta charset='utf-8'>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<br>
		<div style='    display: flex;
						width: 50%;
						height: 10%;
						margin-top: 14rem;
						margin-left: 25%;'class="alert alert-danger" role="alert">
			Не было заполнено поле названиe подкатегории!
				<form method='post'>
				<input style='margin-left: 10rem;' name='back' type='submit' value = 'Вернуться назад'>
				</form>
		</div>

HTML;
	}
	
	if(isset($_POST['back'])){
		echo "<script>location.replace('addProduct.php');</script>";
	}
?>

