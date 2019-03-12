<?php 
session_start();
if(empty($_SESSION['login'])){
	header('Location: login.php');
}
if(isset($_POST['loguotBTN'])){
	require_once "logout.php";
}
if(isset($_POST['RecordDelBTN'])){
	echo "<script>location.replace('delMarked.php');</script>";
}

require_once("assets/addProduct_info.php");


	$host = "localhost";
  	$login = "root";
  	$passwd = "";
  	$db = "pharmacy_db";
	

  	$conn = mysqli_connect($host, $login, $password, $db);

  	if (!$conn) {
  		die("Connection failed: " . mysqli_connect_error());
      exit;
  	}
?>
<!doctype.html>
<html>
<head>
<title>Аптека</title>
<meta charset=utf-8>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
function get() {
				var slct = document.getElementById('categoryProduct').value;
				var result = document.getElementById('two');
				var xhr = new XMLHttpRequest();

				var uri = "changer.php" + "?cat=" + slct;
				
				xhr.open("POST", uri, true);

				xhr.onreadystatechange = function() {
					if ((xhr.readyState==4) && (xhr.status==200)) {
						result.innerHTML = xhr.responseText;
					}
				}
				
				xhr.send();
			}
			
			var CharacteristicCount = 0;
</script>
</head>
<body>
<?php require_once("/assets/header.php") ?>
<div class="container">
		<div class="Main">
            <div class="Nav">
                <div class="Official">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Главная</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="Content">
				<h1>Добавление товара</h1>
					<form method='post'>
						<input type="submit" class="btn btn-outline-primary" name="addCat" value="Добавить категорию">
						<input type="submit" class="btn btn-outline-primary" name="addSubCat" value="Добавить подкатегорию">
					</form>
            </div>
				<?php
///////////////////////////////////////////////////////
//Раздел с подкатегорией
//////////////////////////////////////////////////////	
					if(isset($_POST['addCat'])){ 
					echo "<script>document.getElementById('form').style.background-color = 'red';</script>";
					echo	<<<HTML
						<form method='post'>
						<h4>Название категории</h4>
						<input type="text" name="inputCatName">
							<form  method=post enctype=multipart/form-data>
							    <input type="submit" class="form-control"  name="addCatImg" value="Далее">
							    <input type="submit"  class="form-control" name="addCatCansel" value="Отмена">
							</form>					
						</form>
						
HTML;
					}
					else if(isset($_POST['addCatImg'])){ //Добавить изображение категории
					$_SESSION['inputCatName'] = $_POST['inputCatName'];	
					
					echo	<<<HTML
						<h6>Выбрать изображение для подкатегории</h6>
						<form action=uploadcatImg.php method=post enctype=multipart/form-data>
						<input type=file class="form-control" name=uploadfile>
						<input type=submit class="form-control" value=Завершить></form>
						
HTML;
					}			
					else if(isset($_POST['addSubCatImg'])){ // Загрузка фотографии в папку subcats и добавление подкатегори
									
						$_SESSION['catSelect'] = $_POST['catSelect'];
						$_SESSION['inputSubCatName'] = $_POST['inputSubCatName'];	
						//var_dump($_SESSION['inputSubCatName']);
						echo	<<<HTML
						<h6>Выбрать изображение для подкатегории</h6>
						<form action=uploadSubcatImg.php method=post enctype=multipart/form-data>
						<input class="form-control" type=file name=uploadfile>
						<input class="form-control" type=submit name=addSubCatAdd value=Завершить></form>						
HTML;
				    }
					else if(isset($_POST['addSubCat'])){
										echo <<<HTML
						<form method='post' enctype=multipart/form-data>
						<h3 id="out">Выберите категорию</h3>		
						<select class="form-control" id="categoryProduct" name="catSelect">
						<option>---Выберите категорию---</option>
HTML;
					for($i=0;$i < count($_SESSION["NullCategoryArray"]);$i++){
					echo <<<HTML
					<option>{$_SESSION["NullCategoryArray"][$i]}</option>
HTML;
				    }
					echo <<<HTML
						</select>		
						<h4>Название подкатегории</h4>
						<input type="text" name="inputSubCatName">
							<form  method=post enctype=multipart/form-data>
							<input class="form-control" type="submit"  name="addSubCatImg" value="Далее">
							<input class="form-control" type="submit"  name="addSubCatCansel" value="Отмена">
							</form>										
						</form>						
HTML;
				    }else {
                        echo <<<HTML
					<form method='post' enctype=multipart/form-data id="form">
				<h3 id="out">Выберите категорию</h3>		
				<select class="form-control" id="categoryProduct" name="catSelect" onClick="get();">
					<option>---Выберите категорию---</option>
HTML;
                        for ($i = 0; $i < count($_SESSION["NullCategoryArray"]); $i++) {
                            echo <<<HTML
					<option>{$_SESSION["NullCategoryArray"][$i]}</option>
HTML;
                        }
                        echo <<<HTML
				</select>
				<script>
				function CharacteristicAdd(){
				CharacteristicCount++;
				var slct = document.getElementById('charact').value = CharacteristicCount +1;
				var result = document.getElementById('hered');
				var xhr = new XMLHttpRequest();

				var uri = "changerChar.php" + "?cat=" + CharacteristicCount;
				
				xhr.open("POST", uri, true);

				xhr.onreadystatechange = function() {
					if ((xhr.readyState==4) && (xhr.status==200)) {
						result.innerHTML += xhr.responseText;
					}
				}
				
				xhr.send();
				
}

function CharacteristicDel(){
				var temt = "char" + CharacteristicCount;
				var elem = document.getElementById(temt);
				elem.remove();
				CharacteristicCount--;	
				var slct = document.getElementById('charact').innerHTML = CharacteristicCount +1;				
}			
</script>	
				<h3>Выберите подкатегорию</h3>				
				<select class="form-control" id="two" name="subSelect">
					<option>---Выберите подкатегорию---</option>				
				</select>				
				<div>
					<h3>Наименование товара</h3>
					<input class="form-control" maxlength=100 type='text' name='ProductName' required>
					<h3>Стоимость товара</h3>
					<input class="form-control" maxlength=6 type='text' pattern='[0-9]{1,}'  name='ProductCost' required>
				</div>
				<div>
					<h3>Количество на складе</h3>
					<input class="form-control" style="margin-left: 0.6%;" pattern='[0-9]{1,}' maxlength=10 type='text' name='ProductCount' required>
					<h3 >Фотография</h3>
					<input class="form-control" type=file name=uploadfile>
				</div>
				<h3>Характеристики</h3>
				<div>
				<input hidden id='charact' name = "charact" value="1" class="form-control">
				</div>
				<b>Наименование</b>
				<input class="form-control" type='text' maxlength=50 name='CharacteristicName0' required>
				<b>Значение</b>
				<input class="form-control" type='text' maxlength=15 name='ProductNameValue0' required>
				<div id='hered'></div>
				<input class="form-control" type='button' value='Добавить новую характеристику' onClick="CharacteristicAdd()" name='AddCharacteristic'>
				<input class="form-control" type='button' value='Удалить последнее' name='ResetCharacteristic' onClick="CharacteristicDel()" >
				
				<h3 style="margin-top: 1.3%">Описание товара</h3>
				<textarea class="form-control" name="ProductDescription" maxlength=512 required></textarea>
				<input class="btn btn-primary btn-lg btn-block" type="submit" value="Добавить товар" name="InsertProduct">
				</form>
HTML;
                    }
///////////////////////////////////////////////////////
//Раздел заполнения товара
//////////////////////////////////////////////////////
				?>		
				
				<?php									
					if(isset($_POST['InsertProduct'])){						
						/*echo $_POST['ProductName'];
						echo $_POST['ProductCost'];
						echo $_POST['ProductCount'];
						*/
						//var_dump($_FILE['filename']['name']); Сделать проверку
						//echo $_POST['ProductDescription'];
						
						if($_POST['catSelect']=="---Выберите категорию---" || $_POST['subSelect']=="---Выберите подкатегорию---"){
							if($_POST['catSelect']=="---Выберите категорию---")
                            {
                                echo <<<HTML
		<div class="alert alert-danger" role="alert">
			Не была выбрана категория!				
		</div>
HTML;
                            }
							if($_POST['subSelect']=="---Выберите подкатегорию---"){
								echo <<<HTML
			<div class="alert alert-danger" role="alert">
				Не была выбрана подкатегория!				
			</div>
HTML;
							}
						}
						else{
							$query = "SELECT product_id FROM product Where product_name = '" . $_POST['ProductName'] ."';";
							$result = mysqli_query($conn, $query);
							$TwiceProductNameId = mysqli_fetch_assoc($result);							
							$TwiceProductNameId = $TwiceProductNameId["product_id"];
														
							if($TwiceProductNameId == NULL){
								
							$CHARACTERISTICS = '';
							for($i=0;$i<$_POST['charact'];$i++){
								$_POST['CharacteristicName' . $i] = str_replace(';',',',$_POST['CharacteristicName' . $i]);
								$_POST['ProductNameValue' . $i] =str_replace(';',',',$_POST['ProductNameValue' . $i]);
								if($i==0){
									$CHARACTERISTICS=$_POST['CharacteristicName' . $i] . '-' . $_POST['ProductNameValue'. $i];
								}
								else{
									$CHARACTERISTICS = $CHARACTERISTICS . ';' . $_POST['CharacteristicName' . $i] . '-' . $_POST['ProductNameValue'. $i];
								}
							}		
								
							$query2 = "SELECT category_id FROM category Where category_category = '" . $_POST['subSelect'] ."';";
							$result2 = mysqli_query($conn, $query2);
							$Category = mysqli_fetch_assoc($result2);							
							$Category = $Category["category_id"];
								
								$uploaddir = 'img/products/';
							if($_FILES['uploadfile']['name'] != ''){
							$uploadfile = $uploaddir.basename($_FILES['uploadfile']['name']);
							copy($_FILES['uploadfile']['tmp_name'], $uploadfile);
							}
							else{
								$uploadfile = 'img/products/5.png';
							}
							$sql = "INSERT INTO `product`(`product_name`,
							`product_cost`, `product_description`, `product_image`,
							`product_count`, `product_characteristic`, `product_category`,
							`product_status`) Values ('{$_POST['ProductName']}',{$_POST['ProductCost']},
							'{$_POST['ProductDescription']}','{$uploadfile}',{$_POST['ProductCount']},
							'{$CHARACTERISTICS}',{$Category},'1');";
							$result = mysqli_query($conn, $sql);
							$_SESSION['ResultProductAdd'] = $result;
							echo "<script>location.replace('uploadProduct.php');</script>";
							}
							else{
								echo <<<HTML
			<div class="alert alert-danger" role="alert">
				Товар с таким названием уже существует!			
			</div>
HTML;
							}
						}
					}
				?>
			</div>
		</div>
	</div>
	</body>
</html>



				