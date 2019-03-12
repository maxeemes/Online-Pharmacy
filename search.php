<?php
session_start();
require_once("assets/Subgroup_info.php");

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
	
	$search = $_GET['search'];
	
	
if(isset($_POST['orderBTN'])){
	$ProductOrderArray = explode(';',$_SESSION['BascketNameString']);
	unset($ProductOrderArray[0]);
	for($i = 1; $i<=count($ProductOrderArray);$i++){
		if($ProductOrderArray[$i] == $_POST['text']){
		  echo "<script>alert(\"Такой товар уже в корзине!\");</script>";
		  $FREEORDER = 1;
			break;
		}
	}
	if($FREEORDER == NULL){
	$_SESSION['BasketCount']++;
	$_SESSION['BascketNameString'] = $_SESSION['BascketNameString'] . ';' . $_POST['text'];
	}
}
if(isset($_POST['orderDelBTN'])){
	$query = "Update product Set product_status = '0' Where product_name = '{$_POST['text']}';";
	$result = mysqli_query($conn, $query);
							echo <<<HTML
		<meta charset='utf-8'>
  <link rel="stylesheet"
  href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
  integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
  crossorigin="anonymous">
		<br>
		<div class="alert alert-success" role="alert">
			Запись помечена на удаление.
		</div>	
HTML;
	sleep(2);
	echo "<script>location.replace('search.php');</script>";
}
if(isset($_POST['orderRedBTN'])){
	$temp = str_replace('_',' ',$_POST['text']);
	echo "<script>location.replace('redProduct.php?name={$temp}');</script>";
}

	?>

<html>
<head>
<title>Аптека</title>
<meta charset=utf-8>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
	<body>
    <?php require_once("assets/header.php") ?>
    <div class="container">
		<div class="Main">
			<div class="Nav">
				<div class="Official">
					<a href="index.php" style="padding-left: 1em;">Главная</a>
				</div>
				<div style="margin-left: 66%">
				<?php require_once("assets/AddProdBTN.php") ?>
				</div>
			</div>
			<div class="Content">
			<?php
			if($_SESSION["status"] != 0){
					if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM product WHERE (product_name LIKE '%{$search}%' OR (SELECT category_category FROM category WHERE category_id=product_category) LIKE '%{$search}%' OR product_description LIKE '%{$search}%' OR product_characteristic LIKE '%{$search}%') AND product_count>0 And product_status='1';")) != 0) {
					$items = mysqli_query($conn, "SELECT * FROM product WHERE (product_name LIKE '%{$search}%' OR (SELECT category_category FROM category WHERE category_id=product_category) LIKE '%{$search}%' OR product_description LIKE '%{$search}%' OR product_characteristic LIKE '%{$search}%') AND product_count>0 And product_status='1' ORDER BY product_name ASC;");
		
		$j=0;
		$productNamesSearch = array();
		$productCostSearch = array();
		$productImageArray = array();
					while($row = mysqli_fetch_array($items))
					{
						$productNamesSearch[$j] = $row['product_name'];
						$productCostSearch[$j] = $row['product_cost'];
						$productImageArray[$j] = $row['product_image'];
						$j++;
					}
					
					for($i=0;$i < count($productNamesSearch); $i++){
												echo <<<CAT
						
					<div class=Products>
					<form method="post">
					<a href="detailProduct.php?ParentProductName={$productNamesSearch[$i]}" title="{$productNamesSearch[$i]}">				
					<div class=ProductsBlockWithIMG style="height:50%">
					<img src="{$productImageArray[$i]}" class=emg>
					</div>
					<div class=ProductsText style="height:10%;">
					{$productNamesSearch[$i]}
					</div>
					<div class=ProductsCost style="height:10%;">
					{$productCostSearch[$i]} руб.
					</div>
					</a>
					<div class=ProductsButton style="height:30%">
					<input type="text" hidden name="text" value="{$productNamesSearch[$i]}">
					<input type="submit"  name="orderBTN" style="width:100%" value="Заказ" class="btn btn-outline-secondary">
					<input type="submit"  name="orderRedBTN" style="width:100%" value="Редактировать" class="btn btn-outline-secondary">
					<input type="submit"  name="orderDelBTN" style="width:100%" value="Удалить" class="btn btn-outline-secondary">
					</div>
					</form>
				</div>
CAT;
					}				
				}
				else {
								echo <<<HTML
		<meta charset='utf-8'>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<br>
		<div class="alert alert-primary" role="alert">
			Ничего не найдено, введите в строке поиска интересующее вас название
		</div>	
HTML;
				}
			}
			else{
					if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM product WHERE (product_name LIKE '%{$search}%' OR (SELECT category_category FROM category WHERE category_id=product_category) LIKE '%{$search}%' OR product_description LIKE '%{$search}%' OR product_characteristic LIKE '%{$search}%') AND product_count>0 And product_status='1';")) != 0) {
					$items = mysqli_query($conn, "SELECT * FROM product WHERE (product_name LIKE '%{$search}%' OR (SELECT category_category FROM category WHERE category_id=product_category) LIKE '%{$search}%' OR product_description LIKE '%{$search}%' OR product_characteristic LIKE '%{$search}%') AND product_count>0 And product_status='1' ORDER BY product_name ASC;");
		
		$j=0;
		$productNamesSearch = array();
		$productCostSearch = array();
		$productImageArray = array();
					while($row = mysqli_fetch_array($items))
					{
						$productNamesSearch[$j] = $row['product_name'];
						$productCostSearch[$j] = $row['product_cost'];
						$productImageArray[$j] = $row['product_image'];
						$j++;
					}
					
					for($i=0;$i < count($productNamesSearch); $i++){
												echo <<<CAT
						
					<div class=Products>
					<form method="post">
					<a href="detailProduct.php?ParentProductName={$productNamesSearch[$i]}" title="{$productNamesSearch[$i]}">				
					<div class=ProductsBlockWithIMG style="height:70%">
					<img src="{$productImageArray[$i]}" class=emg>
					</div>
					<div class=ProductsText style="height:15%;">
					{$productNamesSearch[$i]}
					</div>
					<div class=ProductsCost style="height:15%;">
					{$productCostSearch[$i]} руб.
					</div>
					</a>
					</form>
				</div>
CAT;
					}				
				}
				else {
								echo <<<HTML
		<meta charset='utf-8'>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<br>
		<div class="alert alert-primary" role="alert">
			Ничего не найдено, введите в строке поиска интересующее вас название
		</div>	
HTML;
				}
			}
			
			
				
			?>
			</div>
		</div>
	</div>		
</body>
</html>