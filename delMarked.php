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
require_once("assets/delMarked_info.php");
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
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <?php require_once("assets/header.php") ?>
	<div class="container">
		<div class="Main">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page"><a href="index.php">Главная</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Удаление</li>
                </ol>
            </nav>
			<div class="Content">
			<?php require_once("assets/delMarkedContent.php") ?>
			</div>
		</div>
	</div>
	</body>
</html>

