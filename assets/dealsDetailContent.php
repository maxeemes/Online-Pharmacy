<?php
session_start();

	$host = "localhost";
  	$login = "root";
  	$passwd = "";
  	$db = "pharmacy_db";
	

  	$conn = mysqli_connect($host, $login, $passwd, $db);

  	if (!$conn) {
  		die("Connection failed: " . mysqli_connect_error());
  	}

	$_SESSION['deal_id'] = $_GET['red_id'];
	
	require_once("assets/dealsDetail_info.php");
	
	if($_SESSION['DealDeliveryType'] == 0){
		$Delivery = 'Самовывоз';
	}else{
		$Delivery = 'Курьер';
	}
		
	$DealProductNameArray = explode(';',$_SESSION['DealProductName']);
	$DealCountArray = explode(';',$_SESSION['DealCount']);
	
	echo <<<HTML
		<h2>Заказ № {$_SESSION['deal_id']} от {$_SESSION['DealDate']}</h2>
		<div style="display:flex;font-size:120%;margin-top: 2%;">
		<b>Заказчик:&nbsp</b>
		<p>{$_SESSION['DealCustomerName']}</p>
		</div>
		<h3 style="justify-content:center;">Содержимое заказа</h3>
		<table class="table table-hover">
					<thead class="thead-dark">
						<tr>
							<th>Наименование товара</td>
							<th>Количество</td>
						</tr>
						</thead>
HTML;
	for($i = 0; $i < count($DealProductNameArray);$i++){
		echo <<<HEREDOC
                    <tr>
                    <td>{$DealProductNameArray[$i]}</td>
                    <td>{$DealCountArray[$i]}</td>                   
                    </tr>
HEREDOC;
	}
	
	
	
	echo <<<HTML
	</table>
	<div>
		<h3>Тип доставки:&nbsp{$Delivery}</h3>
	</div>
	<table class="table table-hover">
			<tr>
				<th><h3>Итоговая сумма</h3></td>
				<th><h3>{$_SESSION['DealCost']} руб</h3></td>
			</tr>
HTML;
	  
?>				