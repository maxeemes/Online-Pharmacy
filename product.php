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

$label = 'subcat';
$ParentSubCatetegoryName;
if (  !empty( $_GET[ $label ] )  )
{
  $ParentSubCatetegoryName = $_GET[ $label ];
}
$_SESSION["ParentSubCatetegoryName"] = $ParentSubCatetegoryName;

require_once("assets/Product_info.php");

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
		<br>
		<div class="alert alert-success" role="alert">
		<a href="product.php?subcat={$_SESSION["ParentSubCatetegoryName"]}">
			Запись помечена на удаление.
		</a>
		</div>	
HTML;
	//sleep(2);
	//echo "<script>location.replace('product.php?subcat={$_SESSION["ParentSubCatetegoryName"]}');</script>";
}
if(isset($_POST['orderRedBTN'])){
	$temp = str_replace('_',' ',$_POST['text']);
	echo "<script>location.replace('redProduct.php?name={$temp}');</script>";
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
</head>
<body>
<?php require_once("assets/header.php") ?>
<div class="container">
		<div class="Main">
			<div class="Nav">
				<div class="Official">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item" aria-current="page"><a href="index.php">Главная</a></li>
                            <?php
                            if(isset($_SESSION["ParentSubCatetegoryName"]))
                            {
                                echo <<<HTML
                        <li class="breadcrumb-item" aria-current="page"><a href="subcat.php?cat={$_SESSION["ParentCatetegoryName"]}">{$_SESSION["ParentCatetegoryName"]}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{$_SESSION["ParentSubCatetegoryName"]}</li>
HTML;
                            }
                            else
                            {
                                echo <<<HTML
                        <li class="breadcrumb-item active" aria-current="page">{$_SESSION["ParentCatetegoryName"]}</li>
HTML;
                            }
                            ?>
                        </ol>
                    </nav>
				</div>
				<!---<div class="group">
					<a href="subcat.php?cat=<?php echo $_SESSION["ParentCatetegoryName"];?>"> - <?php echo $_SESSION["ParentCatetegoryName"]; ?></a>
				</div>--->
			</div>
            <div align="right">
                <?php require_once("assets/AddProdBTN.php") ?>
            </div>
            <br>
            <div class="row">
				<?php require_once("assets/productContent.php") ?>
			</div>
		</div>
	</div>
	</body>
	
</html>

