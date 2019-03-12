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
$label = 'cat';
$ParentCatetegoryName;
if (  !empty( $_GET[ $label ] )  )
{
  $ParentCatetegoryName = $_GET[ $label ];
}
$_SESSION["ParentCatetegoryName"] = $ParentCatetegoryName;

$host = "localhost";
$login = "root";
$passwd = "";
$db = "pharmacy_db";

$conn = mysqli_connect($host, $login, $passwd, $db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    //exit;
}


if(isset($_POST['subGroupDelBTN'])){
	$query = "Update category Set category_status = '0' Where category_category = '{$_POST['text']}';";
	$result = mysqli_query($conn, $query);
							echo <<<HTML
		<div class="alert alert-success" role="alert">
			Запись помечена на удаление.
		</div>	
HTML;
	sleep(2);
	echo "<script>location.replace('subcat.php?cat={$ParentCatetegoryName}');</script>";
}
require_once("assets/Subgroup_info.php");
echo <<<HTML

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
HTML;
			require_once("assets/header.php");
                echo <<<HTML
<div class="container">
		<div class="Main">
            <div class="Nav">
                <div class="Official">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item" aria-current="page"><a href="index.php">Главная</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{$ParentCatetegoryName}</li>
                        </ol>
                    </nav>
                </div>
            </div>
			<div class="Row">
HTML;
				require_once("assets/subgroup.php");
				echo <<<HTML
			</div>
		</div>
	</div>
	</body>
</html>

HTML;
?>