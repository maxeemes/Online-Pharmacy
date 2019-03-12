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
?>
<!doctype.html>
<html>
<head>
<title>Аптека</title>
<meta charset=utf-8>
  <link rel="stylesheet"
  href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
  integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
  crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body style="background-color:#e3e8e8;">
	<div class="container">
			<?php require_once("assets/header.php") ?>
		<div class="Main">
			<div class="Nav">
				<div class="Official">
					<a href="index.php" style="padding-left: 1em;">Главная</a>
				</div>
				<div style="margin-left: 66%">
				<?php require_once("assets/AddProdBTN.php") ?>
				</div>
			</div>
			<div class="Content">
				<h1 style="display: flex; justify-content: center;" class="display-4">Покупки</h1>
				<?php require_once("assets/dealsContent.php") ?>
			</div>
		</div>
	</div>
	</body>
	
</html>

