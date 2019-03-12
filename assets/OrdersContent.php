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
	
	require_once('helper.php');

$ProductOrderArray = explode(';',$_SESSION['BascketNameString']);
unset($ProductOrderArray[0]);
if($ProductOrderArray != Null){
		echo <<<HTML
		<div>
		<h3 style="    text-align: center;">Заключение сделки</h3>
		<form method="post">
			<input type="submit"  name="DelOrderBTN" value="Очистить корзину" style="    width: 100%;
																			border-color: black;
																			color: black;
																			font-size: 100%;" class="btn btn-outline-secondary">				
		</form>
		</div>
		<form method="post">
		<table style="width:100%;" class="table">
HTML;

$ProductCostArray = array();
$FINALYCOST = 0;

for($i = 1; $i <= count($ProductOrderArray);$i++){
	
	$query = "SELECT product_cost FROM product Where product_name = '{$ProductOrderArray[$i]}';";
	$result = mysqli_query($conn, $query);
	$Cost = mysqli_fetch_assoc($result);
	$Cost = $Cost["product_cost"];
	
	$ProductCostArray[$i] = $Cost; 
	
	
	echo <<<HTML
	<tr>
	<td><b>Наименование</b></td>
	<td>{$ProductOrderArray[$i]}</td>
	<td><b>Количество</b></td>
	<td><input type='text' maxlength='4' name="count{$i}"></td>
	</tr>
HTML;
}
 foreach($ProductCostArray as &$productCostArray) {
    $productCostArray = intval($productCostArray);
 }
 $_SESSION['ProductCostArray'] = $ProductCostArray;
	echo <<<HTML
		</table>
		<div style="display:flex;">
		<h3 style="width:30%;">Заказчик</h3>
		<select name='CustomerSelect' style="    margin-left: 0.5%; width:40%;">
		<option>---Выберите заказчика---</option>
HTML;
		for($i=0;$i < count($_SESSION["Customers"]);$i++){
			echo <<<HTML
				<option>{$_SESSION["Customers"][$i]}</option>
HTML;
		}
	echo <<<HTML
		<select>
		<input type="submit"  name="NewCuctomerBTN" value="Новый заказчик" style=" 
									border-color: black;
									color: black; width:30%;
									font-size: 100%;margin-left: 1%;" class="btn btn-outline-secondary">
		</div>
		<div style="display:flex;margin-top: 1%;">
		<h3 style="width:30%;">Тип доставки</h3>
		<select name='DeliveryTypeSelect' style="width:70%;">
			<option>---Выберите тип доставки---</option>
			<option>Самовывоз</option>
			<option>Курьер</option>
		</select>
		</div>
		<input type="submit"  name="AddDealBTN" value="Заключить сделку" style="    width: 100%;margin-top: 1%;
																			border-color: black;
																			color: black;
																			font-size: 100%;" class="btn btn-outline-secondary">
		</form>
HTML;


if(isset($_POST['AddDealBTN'])){
	
	$CountArray = array();
	$BuyCountArray = array();
	$_SESSION['FINALYCOST'] = $FINALYCOST;
	
	for($i=1;$i<=count($ProductOrderArray);$i++){
		

		$sql="Select product_count From product Where product_name = '{$ProductOrderArray[$i]}'";
		$result2 = mysqli_query($conn, $sql);
		$RealProductCount = mysqli_fetch_assoc($result2);
		$RealProductCount = $RealProductCount["product_count"];
		
		
		$Count = 'count' . $i;
		$CountArray[$i] = $_POST[$Count];
		
		
		$RealMinusWriteCount = (int)$RealProductCount - (int)$CountArray[$i];
		
		if($RealMinusWriteCount > 0){
				$_SESSION['FINALYCOST'] += $CountArray[$i] * $_SESSION['ProductCostArray'][$i];
				$BuyCountArray[$i] = $RealMinusWriteCount;
				
				
			if($_POST[$Count] == "" or $_POST['CustomerSelect'] == '---Выберите заказчика---' or
			$_POST['DeliveryTypeSelect'] == '---Выберите тип доставки---'){
				
				echo <<<HTML
				<div class="alert alert-danger" role="alert">
					Не все поля были заполнены!
				</div>
HTML;
			
			$AllRight = 1;
			break;
			}				
		}
		if((int)$RealMinusWriteCount < 0){
				echo <<<HTML
			<div class="alert alert-danger" role="alert">
				В поле номер {$i} было введено количество товара, превышающее его наличие на складе равное {$RealProductCount}!
			</div>
HTML;
		$AllRight = 1;
			}
	}
	$_SESSION['BuyCountArray'] = $BuyCountArray;
	$_SESSION['ProductOrderArray'] = $ProductOrderArray;
	
	if($AllRight == Null){
		$CountArrayToString = implode(";",$CountArray);
		$ProductOrderArrayToString = implode(";",$ProductOrderArray);
		
		$_SESSION['CountArrayToString'] = $CountArrayToString;
		$_SESSION['ProductOrderArrayToString'] = $ProductOrderArrayToString;
		$_SESSION['CustomerSelect'] = $_POST['CustomerSelect'];
		$_SESSION['DeliveryTypeSelect'] = $_POST['DeliveryTypeSelect'];
		
			echo <<<HTML
			<div style="display:flex; font-size:120%;" class="alert alert-primary" role="alert">
				Вы действительно хотите совершить сделку?
				<form method="post" style="width:100%">
				<input style='width:49%;' name='YES' type='submit' value = 'Да' class="btn btn-outline-secondary">
				<input style='width:49%;' name='NO' type='submit' value = 'Нет' class="btn btn-outline-secondary">
				</div>
			</div>
HTML;
	}
}


}else{
	echo <<<HTML
			<div class="alert alert-warning" role="alert">
				Корзина пуста! Добавте товары для заключения сделки.	
			</div>
HTML;
}


if(isset($_POST['YES'])){
	
	$today = date("d.m.y"); 
	
	for($i=1;$i<=count($_SESSION['BuyCountArray']);$i++){
		$sql = "Update product Set product_count = {$_SESSION['BuyCountArray'][$i]} where product_name = '{$_SESSION['ProductOrderArray'][$i]}';";
		$result=mysqli_query($conn, $sql);
	}


	
	if($_SESSION['DeliveryTypeSelect'] == 'Самовывоз'){
		$_SESSION['DeliveryTypeSelect'] = 0;
		$_SESSION['FINALYCOST'] -= $_SESSION['FINALYCOST'] * 0.05;
	}else{
		$_SESSION['DeliveryTypeSelect'] = 1;
		$_SESSION['FINALYCOST'] += $_SESSION['FINALYCOST'] * 0.13;
	}
		
	$query = "Insert Into deal (`deal_name_customer`,
	`deal_product_name`, `deal_count`, `deal_date`,
	`deal_delivery_type`, `deal_cost`,deal_status) Values ('{$_SESSION['CustomerSelect']}'
	,'{$_SESSION['ProductOrderArrayToString']}'
	,'{$_SESSION['CountArrayToString']}','{$today}','{$_SESSION['DeliveryTypeSelect']}',{$_SESSION['FINALYCOST']},'1');";
	$result=mysqli_query($conn, $query);
	if($result == true){
		echo <<<HTML
			<div class="alert alert-success" role="alert">
				Заказ успешно оформлен!	
			</div>
HTML;
	$_SESSION['BasketCount'] = 0;
	$_SESSION['BascketNameString'] = "";
	sleep(1);
	echo "<script>location.replace('Orders.php');</script>";
	}else{
			echo <<<HTML
			<div class="alert alert-danger" role="alert">
				Заказ не был оформлен!
			</div>
HTML;
	}
}

?>