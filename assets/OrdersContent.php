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
	require_once('helper.php');
$ProductOrderArray = explode(';',$_SESSION['BascketNameString']);
unset($ProductOrderArray[0]);
if($ProductOrderArray != Null) {
    echo <<<HTML
		<div>
		<h3>Заключение сделки</h3>
		<form method="post">
			<input type="submit"  name="DelOrderBTN" value="Очистить корзину" class="btn btn-secondary btn-block">				
		</form>
		</div>
		<form method="post">
		<table class="table table-hover">
HTML;

    $ProductCostArray = array();
    $FINALYCOST = 0;

    echo <<<HTML
<thead class="thead-dark">
    <tr>
        <th><b>Наименование</b></th>
        <th><b>Цена</b></th>
        <th><b>Количество</b></th>
    </tr>
</thead>
HTML;
//TODO make deleting from basket
    for ($i = 1; $i <= count($ProductOrderArray); $i++) {

        $query = "SELECT product_cost FROM product Where product_name = '{$ProductOrderArray[$i]}';";
        $result = mysqli_query($conn, $query);
        $Cost = mysqli_fetch_assoc($result);
        $Cost = $Cost["product_cost"];

        $ProductCostArray[$i] = $Cost;


        echo <<<HTML
	<tr>
	    <td>{$ProductOrderArray[$i]}</td>
	    <td>{$ProductCostArray[$i]}</td>
	    <td><input class="form-control" type='text' maxlength='4' name="count{$i}" style="width: 20%" value="1"></td>
	</tr>
HTML;
    }
    foreach ($ProductCostArray as &$productCostArray) {
        $productCostArray = intval($productCostArray);
    }
    $_SESSION['ProductCostArray'] = $ProductCostArray;
    echo <<<HTML
		</table>
		<div>
		<h3>Заказчик</h3>
		<select class="form-control" name='CustomerSelect'>
		<option>---Выберите заказчика---</option>
HTML;
    for ($i = 0; $i < count($_SESSION["Customers"]); $i++) {
        echo <<<HTML
				<option>{$_SESSION["Customers"][$i]}</option>
HTML;
    }
    echo <<<HTML
		<select>
		    <input type="submit"  name="NewCuctomerBTN" value="Новый заказчик" class="btn btn-outline-primary float-right">
		</div>
		<br>
		<div>
		<h3>Тип доставки</h3>
		<select class="form-control" name='DeliveryTypeSelect'>
			<option>---Выберите тип доставки---</option>
			<option>Самовывоз</option>
			<option>Курьер</option>
		</select>
		</div>
		<br>
		<input type="submit"  name="AddDealBTN" value="Заключить сделку" class="btn btn-primary btn-block">
		</form>
HTML;


    if (isset($_POST['AddDealBTN'])) {

        $CountArray = array();
        $BuyCountArray = array();
        $_SESSION['FINALYCOST'] = $FINALYCOST;

        for ($i = 1; $i <= count($ProductOrderArray); $i++) {


            $sql = "Select product_count From product Where product_name = '{$ProductOrderArray[$i]}'";
            $result2 = mysqli_query($conn, $sql);
            $RealProductCount = mysqli_fetch_assoc($result2);
            $RealProductCount = $RealProductCount["product_count"];



            if ($RealMinusWriteCount >= 0) {

                if ($_POST['count'.$i] == "" or $_POST['CustomerSelect'] == '---Выберите заказчика---' or
                    $_POST['DeliveryTypeSelect'] == '---Выберите тип доставки---') {

                    echo <<<HTML
				<div class="alert alert-danger" role="alert">
					Не все поля были заполнены!
				</div>
HTML;

                    $AllRight = 1;
                    break;
                } else {
                    $Count = 'count' . $i;
                    $CountArray[$i] = $_POST[$Count];
                    $RealMinusWriteCount = (int)$RealProductCount - (int)$CountArray[$i];
                    $_SESSION['FINALYCOST'] += $CountArray[$i] * $_SESSION['ProductCostArray'][$i];
                    $BuyCountArray[$i] = $RealMinusWriteCount;
                }
            }else {
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

        if ($AllRight == Null) {
            $CountArrayToString = implode(";", $CountArray);
            $ProductOrderArrayToString = implode(";", $ProductOrderArray);

            $_SESSION['CountArrayToString'] = $CountArrayToString;
            $_SESSION['ProductOrderArrayToString'] = $ProductOrderArrayToString;
            $_SESSION['CustomerSelect'] = $_POST['CustomerSelect'];
            $_SESSION['DeliveryTypeSelect'] = $_POST['DeliveryTypeSelect'];

            if($_SESSION['DeliveryTypeSelect'] == 'Самовывоз'){
                $_SESSION['DeliveryTypeSelect'] = 0;
                $_SESSION['FINALYCOST'] -= $_SESSION['FINALYCOST'] * 0.05;
            }else{
                $_SESSION['DeliveryTypeSelect'] = 1;
                $_SESSION['FINALYCOST'] += $_SESSION['FINALYCOST'] * 0.13;
            }

            echo <<<HTML
			<div class="alert alert-primary" role="alert">
				Вы действительно хотите совершить сделку?
				Сумма сделки с доставкой составит {$_SESSION['FINALYCOST']} рублей
				<form method="post">
				<input style='width:49%;' name='YES' type='submit' value = 'Да' class="btn btn-success">
				<input style='width:49%;' name='NO' type='submit' value = 'Нет' class="btn btn-secondary">
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


	$query = "Insert Into deal (`deal_name_customer`, `deal_product_name`, `deal_count`, `deal_date`, `deal_delivery_type`, `deal_cost`,deal_status) Values (
                              '{$_SESSION['CustomerSelect']}',
                                                    '{$_SESSION['ProductOrderArrayToString']}'
	                                                                      ,'{$_SESSION['CountArrayToString']}',
                                                                                        '{$today}',
                                                                                                      '{$_SESSION['DeliveryTypeSelect']}',
                                                                                                                               {$_SESSION['FINALYCOST']},
                                                                                                                                               '1');";
	$result=mysqli_query($conn, $query);
	var_dump($result);
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