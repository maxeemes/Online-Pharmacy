<?php

$array1 = $_SESSION["CategoryName"];
$array2 = $_SESSION["CategoryImage"];
$CatCount = $_SESSION["CatCount"];
$IsNotSubArray = $_SESSION["IsNotSubArray"];
$CategoryStatus = $_SESSION["CategoryStatus"];
if(isset($_SESSION["status"]) && $_SESSION["status"]==0){
				for ($i=0;$i<$CatCount;$i++){
				if($IsNotSubArray[$i] == "null" and $CategoryStatus[$i] == "1"){
echo 			<<<HTML
				<!---<a href="subcat.php?cat={$array1[$i]}">
				<div class=cats>				
					<div class=blockWithIMG>
					<img src="{$array2[$i]}" class=emg>
					</div>
					<div class=text>
					{$array1[$i]}
					</div>
				</div>
				</a>--->
<div class="card col-sm-4 mb-2" style="width: 18rem;">
  <div class="card-body">
    <img class="card-img-top" src="{$array2[$i]}" alt="Card image cap">
    <a href="subcat.php?cat={$array1[$i]}" class="btn btn-primary">{$array1[$i]}</a>
  </div>
</div>
HTML;
				}
			}
}else{
				for ($i=0;$i<$CatCount;$i++){
				if($IsNotSubArray[$i] == "null" and $CategoryStatus[$i] == "1"){
echo 			<<<HTML
<div class="card col-sm-4 mb-2" style="width: 18rem;">
  <div class="card-body">
    <img class="card-img-top" src="{$array2[$i]}" alt="Card image cap">
    <form method="post"><a href="subcat.php?cat={$array1[$i]}" name="text" class="btn btn-primary">{$array1[$i]}</a> <input type="submit"  name="groupDelBTN" value="Удалить" class="btn btn-warning float-right"></form>
  </div>
</div>
HTML;
				}
			}	
}

?>