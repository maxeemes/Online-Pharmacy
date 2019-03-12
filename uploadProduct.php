<?php
session_start();
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
	if($_SESSION['ResultProductAdd']==true){
		echo <<<HTML
		<br>
		<div class="alert alert-success" role="alert">
			<h1>Запись успешно добавлена!</h1>
				<form method='post'>
				<input class="btn btn-outline-success btn-lg btn-block" name='back' type='submit' value = 'Вернуться назад'>
				</form>
		</div>
HTML;

	}
	else{
		echo <<<HTML
		<br>
		<divclass="alert alert-danger" role="alert">
			<h1>Запись не была добавлена!</h1>
				<form method='post'>
				<input class="btn btn-outline-warning btn-lg btn-block" name='back' type='submit' value = 'Вернуться назад'>
				</form>
		</div>
HTML;

	}
	echo <<<HTML
	</body>
</html>
HTML;

	if(isset($_POST['back'])){
		echo "<script>location.replace('addProduct.php');</script>";
	}
?>

