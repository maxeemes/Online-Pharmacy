<?php 
session_start();
if(empty($_SESSION['login'])){
	header('Location: login.php');
}
if(isset($_POST['loguotBTN'])){
	require_once "logout.php";
}
if(isset($_POST['RecordDelBTN'])){
	echo "<script>location.replace('delMarked.php');</script>";
}


	$host = "localhost";
  	$login = "root";
  	$passwd = "";
  	$db = "pharmacy_db";
	

  	$conn = mysqli_connect($host, $login, $passwd, $db);

  	if (!$conn) {
  		die("Connection failed: " . mysqli_connect_error());
      exit;
  	}
	
	$_SESSION['RedProductName'] = $_GET['name'];
	require_once('assets/redProduct_info.php');
	
	
	if(isset($_POST['RedInsertProduct'])){
		$CHARACTERISTICS = '';
		
		$ProductCharacteristicCount = explode(';',$_SESSION['RedProductCharacteristic']);
		
		for($i=0;$i<count($ProductCharacteristicCount);$i++){
			$_POST['CharacteristicName' . $i] = str_replace(';',',',$_POST['CharacteristicName' . $i]);
			$_POST['ProductNameValue' . $i] =str_replace(';',',',$_POST['ProductNameValue' . $i]);
			if($i==0){
				$CHARACTERISTICS=$_POST['CharacteristicName' . $i] . '-' . $_POST['ProductNameValue'. $i];
			}
			else{
				$CHARACTERISTICS = $CHARACTERISTICS . ';' . $_POST['CharacteristicName' . $i] . '-' . $_POST['ProductNameValue'. $i];
			}
		}	
		//write your code here

		$uploaddir = 'img/products/';
		if($_FILES['uploadfile']['name'] != ''){
		$uploadfile = $uploaddir.basename($_FILES['uploadfile']['name']);
		copy($_FILES['uploadfile']['tmp_name'], $uploadfile);
		}
		else{
			$uploadfile = $_SESSION['RedProductImage'];
		}
		$sql = "UPDATE `product` SET `product_name`='{$_POST['ProductName']}',`product_cost`={$_POST['ProductCost']},
	`product_description`='{$_POST['ProductDescription']}',`product_image`='{$uploadfile}',
		`product_count`={$_POST['ProductCount']},`product_characteristic`='{$CHARACTERISTICS}'
		 WHERE `product_id` = {$_SESSION['RedProductId']};";
		 //var_dump($sql);
		//$result = mysqli_query($conn, $sql);
		//	echo "<script>location.replace('detailProduct.php?ParentProductName={$_POST['ProductName']}');</script>";							
			
			}
	
	
		
?>


<!doctype.html>
<html>
<head>
<title>Аптека</title>
<meta charset=utf-8>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="css/style.css">
<script src="js/addProduct.js"></script>
</head>
<body>
    <?php require_once("/assets/header.php") ?>
    <div class="container">
		<div class="Main">
			<div class="Nav">
				<div class="Official">
					<a href="index.php" style="padding-left: 1em;">Главная</a>
				</div>
			</div>
			<div class="Content">		
				<h1 class="display-4">Редактирование товара</h1>	
				<form method='post' enctype=multipart/form-data>								
				<div style="display:flex; width:100%;">
					<h3>Наименование товара</h3>
					<input class="form-control" maxlength=100 type='text' value="<?php echo $_SESSION['RedProductName']; ?>" name='ProductName' required readonly>
					<h3>Стоимость товара</h3>
					<input class="form-control" maxlength=6 type='text' pattern='[0-9]{1,}' name='ProductCost' value="<?php echo $_SESSION['RedProductCost']; ?>" required>
				</div>
				<div>
					<h3>Количество на складе</h3>
					<input class="form-control"  maxlength=10 pattern='[0-9]{1,}' type='text' required value="<?php echo $_SESSION['RedProductCount']; ?>" name='ProductCount' required>
					<h3>Фотография</h3>
					<input type=file name=uploadfile value="<?php echo $_SESSION['RedProductImage']; ?>">
				</div>
				<h3>Характеристики</h3>
				<div id='charact'>
				<?php
					$ProductCharacteristicArray = explode(';',$_SESSION['RedProductCharacteristic']);
					for($i=0;$i< count($ProductCharacteristicArray);$i++){
					$ProductCharArr = explode('-',$ProductCharacteristicArray[$i]);
						echo <<<HTML
						<b>Наименование</b>
						<input class="form-control"  type='text' maxlength=50 name='CharacteristicName{$i}' value='{$ProductCharArr[0]}' required>
						<b>Значение</b>
						<input class="form-control"  type='text' maxlength=15 name='ProductNameValue{$i}' value='{$ProductCharArr[1]}' required>
HTML;
					}
				?>
				</div>
				<h3>Описание товара</h3>
				<textarea name="ProductDescription" maxlength=512 required style="width: 100%; height: 8em;"><?php echo $_SESSION['RedProductDescription'];?></textarea>
				<input class="btn btn-outline-primary" type="submit" value="Редактировать товар" name="RedInsertProduct">
				</form>				
			</div>
		</div>
	</div>
	</body>
</html>



				