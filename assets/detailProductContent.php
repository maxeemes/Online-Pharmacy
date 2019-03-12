<?php
//$PatentCategoryId = $_SESSION["PatentCategoryId"];
//$ParentCategoryNameArray = $_SESSION["ParentCategoryNameArray"];
//$SubCatImage = $_SESSION["SubCatImage"];
//$SubCatCount = $_SESSION["SubCatCount"];
//$IsNotSubArray = $_SESSION["IsNotSubArray"];
//$CategoryStatus = $_SESSION["CategoryStatus"];

$DetailProductCharecteristicArray = explode(';',$_SESSION["DetailProductCharecteristic"]);
for ($i = 0; $i < count($DetailProductCharecteristicArray); $i++){
$DetailProductCharecteristicArrayElement = $DetailProductCharecteristicArray[$i];
$template = explode('-',$DetailProductCharecteristicArrayElement);

if($_SESSION["DetailProductCount"] < 1)$_SESSION["DetailProductCount"]='Товар закончился';
$PrintCount;
if($_SESSION["DetailProductCount"]=='Товар закончился'){
	$PrintCount = '<h4 style="color:red">Товар закончился</h4>';
}else{
	$PrintCount = '<h4>Осталось на складе: ' . $_SESSION["DetailProductCount"] . ' шт.</h4>';
}

$str = 
	<<<HTML
	
			<tr style="border-bottom: 1px solid;">
			<td>{$template[0]}</td>
			<td>{$template[1]}</td>
			</tr>			
			
HTML;
$str2  = $str2 . $str;
}
if($_SESSION["status"] != 0){
		echo 			<<<HTML
				<h1>{$_SESSION["ParentProductName"]}</h1>
				<div class="Product">
					<div class="ProductImage">
						<img src="{$_SESSION["DetailProductImage"]}" class="emg">
					</div>
					<div class="ProductCostAndCharacteristic">
						<div class="ProductCost">
							<i style="font-size:1.5em;">Цена</i> <h1 class="display-5"> {$_SESSION["DetailProductCost"]} руб. </h1>
						</div>
						{$PrintCount}
						<form method="post">
						<input type="text" hidden name="text" value="{$_SESSION["ParentProductName"]}">
						<input type="submit"  name="orderBTN"  value="Заказ" class="btn btn-primary btn-lg btn-block">
						<div class="btn-group btn-block" role="group">
    <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Управление
    </button>
    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
      <input type="submit"  name="orderRedBTN" value="Редактировать" class=" btn btn-info btn-block">
      <input type="submit"  name="orderDelBTN" value="Удалить" class=" btn btn-danger btn-block">
    </div>
  </div>
					
                        </form>
						<div class="ProductCharacteristic">
							<h1 class="display-4">Характеристики</h1>
							<table style="width:100%">
							<tbody style = "font-size:22px;">
							{$str2}
							</tbody>
							</table>							
						</div>
						
					</div>
				</div>
HTML;

echo    		<<<HTML
				<div class = "Description">
				<h1 class="display-4">Описание</h1>
				<article>
				{$_SESSION["DetailProductDescription"]}
				</article>
				</div>
HTML;
}
else{
	echo 			<<<HTML
				<form method="post" style="display:flex;justify-content: space-between;">
				<h1 class="display-3">{$_SESSION["ParentProductName"]}</h1>
				</form>
				<div class="Product">
					<div class="ProductImage">
						<img src="{$_SESSION["DetailProductImage"]}" class="emg">
					</div>
					<div class="ProductCostAndCharacteristic">
						<div class="ProductCost">
							<i style="font-size:1.5em;">Цена</i> <h1 class="display-5"> {$_SESSION["DetailProductCost"]} руб. </h1>
						</div>
						{$PrintCount}					
						<div class="ProductCharacteristic">
							<h1 class="display-4">Характеристики</h1>
							<table style="width:100%">
							<tbody style = "font-size:22px;">
							{$str2}
							</tbody>
							</table>							
						</div>
						
					</div>
				</div>
HTML;

echo    		<<<HTML
				<div class = "Description">
				<h1 class="display-4">Описание</h1>
				<article>
				{$_SESSION["DetailProductDescription"]}
				</article>
				</div>
HTML;
}



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
?>