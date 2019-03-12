<?php
session_start();
$PatentCategoryId = $_SESSION["PatentCategoryId"];
$ParentCategoryNameArray = $_SESSION["ParentCategoryNameArray"];
$SubCatImage = $_SESSION["SubCatImage"];
$SubCatCount = $_SESSION["SubCatCount"];

if($_SESSION["status"]==0) {
    for ($i = 0; $i < $SubCatCount; $i++) {
        if ($_SESSION["SubCategoryStatusArray"][$i] == "1") {
            echo <<<HTML
				<!--<a href="product.php?subcat={$ParentCategoryNameArray[$i]}">
				<div class=cats>				
					<div class=blockWithIMG>
					<img src="{$SubCatImage[$i]}" class=emg>
					</div>
					<div class=text>
					{$ParentCategoryNameArray[$i]}
					</div>
				</div>
				</a>--->
<div class="card col-sm-4 mb-2" style="width: 18rem;">
  <div class="card-body">
    <img class="card-img-top" src="{$SubCatImage[$i]}" alt="Card image cap">
    <a href="product.php?subcat={$ParentCategoryNameArray[$i]}" class="btn btn-primary">{$ParentCategoryNameArray[$i]}</a>
  </div>
</div>
HTML;
        }
    }
}else{
				for ($i=0;$i<$SubCatCount;$i++){
				if($_SESSION["SubCategoryStatusArray"][$i] == "1"){
echo 			<<<HTML
				<!---<a href="product.php?subcat={$ParentCategoryNameArray[$i]}">
				<div class=cats style="height:23rem;">	
					<form method="post">
					<div class=blockWithIMG style="height:80%;">
					<img src="{$SubCatImage[$i]}" class=emg>
					</div>
					<div class=text>
					{$ParentCategoryNameArray[$i]}
					</div>
					</a>
					<div class=ProductsButton style="height:20%">
					<input type="text" hidden name="text" value="{$ParentCategoryNameArray[$i]}">
					<input type="submit"  name="subGroupDelBTN" style="width:100%" value="Удалить" class="btn btn-outline-secondary">
					</div>
					</form>
				</div>--->
<div class="card col-sm-4 mb-2" style="width: 18rem;">
  <div class="card-body">
    <img class="card-img-top" src="{$SubCatImage[$i]}" alt="Card image cap">
    <form method="post">
    <a href="product.php?subcat={$ParentCategoryNameArray[$i]}" name="text" class="btn btn-primary">{$ParentCategoryNameArray[$i]}</a>
    <input type="text" hidden name="text" value="$ParentCategoryNameArray[$i]">
    <input type="submit"  name="subGroupDelBTN" value="Удалить" class="btn btn-warning float-right">
    </form>
  </div>
</div>

HTML;
				}
			}
}
?>