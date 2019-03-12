<?php
session_start();


if($_SESSION["status"]==0){
			for ($i=0;$i<$_SESSION["PruductCount"];$i++){
				if($_SESSION["ProductStatusArray"][$i] == "1"){
echo 			<<<HTML
				<!---<div class=Products>
					<form method="post">
					<a href="detailProduct.php?ParentProductName={$_SESSION["ProductNamesArray"][$i]}">				
					<div class=ProductsBlockWithIMG>
					<img src="{$_SESSION["ProductImagesArray"][$i]}" class=emg>
					</div>
					<div class=ProductsText>
					{$_SESSION["ProductNamesArray"][$i]}
					</div>
					<div class=ProductsCost>
					{$_SESSION["ProductCostsArray"][$i]} руб.
					</div>
					</a>
					</form>
				</div>--->
<form method="post" class="card col-sm-4 mb-2" style="width: 18rem;">
  <div class="card-body">
    <img class="card-img-top" src="{$_SESSION["ProductImagesArray"][$i]}" alt="Card image cap">
  <h5 class="card-title">{$_SESSION["ProductNamesArray"][$i]}</h5>
  <p class="card-text">{$_SESSION["ProductCostsArray"][$i]} руб.</p>
    <a href="detailProduct.php?ParentProductName={$_SESSION["ProductNamesArray"][$i]}" class="btn btn-primary">Подробнее</a>
    <form method="post">
    <input type="submit"  name="orderBTN" value="Заказ" class="btn btn-primary float-right">
    </form>
  </div>
</form>
HTML;
				}
			}		
}
else{
	for ($i=0;$i<$_SESSION["PruductCount"];$i++){
				if($_SESSION["ProductStatusArray"][$i] == "1"){
echo 			<<<HTML
				<!---<div class=Products>
					<form method="post">
					<a href="detailProduct.php?ParentProductName={$_SESSION["ProductNamesArray"][$i]}">				
					<div class=ProductsBlockWithIMG style="height:50%">
					<img src="{$_SESSION["ProductImagesArray"][$i]}" class=emg>
					</div>
					<div class=ProductsText style="height:10%;">
					{$_SESSION["ProductNamesArray"][$i]}
					</div>
					<div class=ProductsCost style="height:10%;">
					{$_SESSION["ProductCostsArray"][$i]} руб.
					</div>
					</a>
					<div class=ProductsButton style="height:30%">
					<input type="text" hidden name="text" value="{$_SESSION["ProductNamesArray"][$i]}">
					<input type="submit"  name="orderBTN" style="width:100%" value="Заказ" class="btn btn-outline-secondary">
					<input type="submit"  name="orderRedBTN" style="width:100%" value="Редактировать" class="btn btn-outline-secondary">
					<input type="submit"  name="orderDelBTN" style="width:100%" value="Удалить" class="btn btn-outline-secondary">
					</div>
					</form>
				</div>--->
<form method="post" class="card col-sm-4 mb-2" style="width: 18rem;">
<div class="card-body">
<img class="card-img-top" src="{$_SESSION["ProductImagesArray"][$i]}" alt="Card image cap">
<form method="post" class="btn-group" role="group">
    <h5 class="card-title">{$_SESSION["ProductNamesArray"][$i]}</h5>
    <input type="text" hidden name="text" value="{$_SESSION["ProductNamesArray"][$i]}">
    <p class="card-text">{$_SESSION["ProductCostsArray"][$i]} руб.</p>
        <a href="detailProduct.php?ParentProductName={$_SESSION["ProductNamesArray"][$i]}" class="btn btn-primary" role="button">Подробнее</a>
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
HTML;
				}
			}	
}

?>