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
		<b>Контрагент:&nbsp</b>
		<p>{$_SESSION['DealCustomerName']}</p>
		</div>
		<h3 style="display:flex;justify-content:center;">Содержимое заказа</h3>
		<table class="table">
					<thead class="thead-light">
						<tr>
							<th>Наименование товара</td>
							<th>Количество</td>
						</tr>
						</thead>
HTML;
	for($i = 0; $i < count($DealProductNameArray);$i++){
		echo <<<HEREDOC
                    <tr style="    border-bottom: 1px solid;">
                    <td>{$DealProductNameArray[$i]}</td>
                    <td>{$DealCountArray[$i]}</td>                   
                    </tr>
HEREDOC;
	}
	
	
	
	echo <<<HTML
	</table>
	<div style="display:flex;font-size:120%;margin-top: 2%;">
		<b>Тип доставки:&nbsp</b>
		<p>{$Delivery}</p>
	</div>
	<table class="table" style="font-size:2em;">
			<tr>
				<th>Итоговая сумма</td>
				<th>{$_SESSION['DealCost']} руб</td>
			</tr>
HTML;
	  
?>				