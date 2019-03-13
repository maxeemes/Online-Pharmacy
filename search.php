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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<?php require_once("assets/header.php") ?>
	<body>
    <div class="container">
		<div class="Main">
			<div class="Nav">
				<div class="Official">
					<a href="index.php">Главная</a>
				</div>
			</div>
			<div class="Row">
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
						
				<!---<div class=Products>
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
				</div>-->
<form method="post" class="card col-sm-4 mb-2" style="width: 18rem;">
    <div class="card-body">
        <img class="card-img-top" src="{$productImageArray[$i]}" alt="Card image cap">
        <form method="post" class="btn-group" role="group">
            <h5 class="card-title">{$productNamesSearch[$i]}</h5>
            <input type="text" hidden name="text" value="{$productNamesSearch[$i]}">
            <p class="card-text">{$productCostSearch[$i]} руб.</p>
            <a href="detailProduct.php?ParentProductName={$productNamesSearch[$i]}" class="btn btn-primary" role="button">Подробнее</a>
            <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Управление
            </button>
            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
    	        <input type="submit"  name="orderBTN" value="Заказ" class="btn btn-primary btn-block">
                <input type="submit"  name="orderRedBTN" value="Редактировать" class=" btn btn-info btn-block">
                <input type="submit"  name="orderDelBTN" value="Удалить" class=" btn btn-danger btn-block">
            </div>
      </form>
    </div>
</form>

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
						
					<!---<div class=Products>
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
				</div>--->
<form method="post" class="card col-sm-4 mb-2" style="width: 18rem;">
  <div class="card-body">
    <img class="card-img-top" src="{$productImageArray[$i]}" alt="Card image cap">
  <h5 class="card-title">{$productNamesSearch[$i]}</h5>
  <p class="card-text">{$productCostSearch[$i]} руб.</p>
    <a href="detailProduct.php?ParentProductName={$_SESSION["ProductNamesArray"][$i]}" class="btn btn-primary">Подробнее</a>
    <form method="post">
        <input type="text" hidden name="text" value="{$productNamesSearch[$i]}">
        <input type="submit"  name="orderBTN" value="Заказ" class="btn btn-primary float-right">
    </form>
  </div>
</form>
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