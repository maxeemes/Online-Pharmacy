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
  <link rel="stylesheet"
  href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
  integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
  crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body style="background-color:#e3e8e8;">
	<div class="container">
			<?php require_once("/assets/header.php") ?>
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
			<div style="display:flex;">
			<h1 class="display-4">Заказчики</h1>
			<form method="post" style="    display: contents;">
			<select style="margin-left: 60%;" name="type_add">
			<option>Физ. лицо</option>
			<option>Юр. лицо</option>
			</select>
			<input type="submit"  name="addBTN" value="Добавить"  class="btn btn-outline-secondary">
			</form>
			</div>
			<?php require_once("/customersAssets/customersContent.php") ?>
			</div>
		</div>
	</div>
	</body>
</html>

<?php
if (isset($_POST['addBTN'])) {
	if($_POST['type_add'] == "Физ. лицо"){
		echo <<<HEREDOC
						<h3>Добавление Физического лица</h3>
						<form method="post">
						<div class = "redactor">
						<h5>Фамилия</h5>
						<input type="text" required name="family_add" value="" style="margin-left: 2%;">			
						</div>
						<br>
						<div class = "redactor">
						<h5>Имя</h5>
						<input type="text" required name="name_add" value="" style="margin-left: 29%;">
						<h5 style="margin-left:10%">Адресс</h5>
						<input type="text" required name="adress_add" maxlength="100" value="" style="margin-left: 2%;width:19em;">
						</div>
						<br>
						<div class = "redactor">
						<h5>Отчество</h5>
						<input type="text" required name="patronymic_add" value="" style="margin-left: 2%;">
						<h5 style="margin-left:2%">Телефон</h5>
						<input type="text" required name="phone_add" pattern='[0-9]{1,}' maxlength="11" value="" style="margin-left: 2%;">
						</div>
						
						<input type="submit" required  name="addBTNFiz" value="Добавить" style="width: 13%;margin-left: 25%; color: black; 
						border-color:#010508;" class="btn btn-outline-secondary">
						<input type="submit"  required name="addCanselBTN" value="Отменить" style="width: 13%;margin-left: 1%; color: black; 
						border-color:#010508;" class="btn btn-outline-secondary">
						</form>
HEREDOC;
	}
	if($_POST['type_add'] == "Юр. лицо"){
		echo <<<HEREDOC
						<form method="post">
						<div class = "redactor">
						<h5>Наименование организации</h5>
						<input type="text" required name="organization_add" maxlength="150" value="" style="margin-left: 4%;width:32em;">		
						</div>
						<br>
						<div class = "redactor">
						<h5>Адресс</h5>
						<input type="text" required name="adress_add" maxlength="100" value="" style="margin-left: 4%;width: 32em;">
						<h5 style="margin-left:3.5%">Телефон</h5>
						<input type="text" required name="phone_add" pattern='[0-9]{1,}' maxlength="11" value="" style="margin-left: 3%;width: 7em;">
						</div>
						<br>
						
						<input type="submit"  name="addBTNUr" value="Добавить" style="width: 13%;margin-left: 73%; color: black; 
						border-color:#010508;" class="btn btn-outline-secondary">
						<input type="submit"  name="addCanselBTN" value="Отменить" style="width: 13%;margin-left: 1%; color: black; 
						border-color:#010508;" class="btn btn-outline-secondary">
						</form>
HEREDOC;
	}
}

					if (isset($_POST['addCanselBTN'])) {
					   echo "<script>location.replace('customers.php');</script>";
				    }
					
					if (isset($_POST['addBTNFiz'])) {
						$fio = $_POST['family_add'] . ' ' . $_POST['name_add'] . ' ' . $_POST['patronymic_add'];
						$sql = "Insert Into customer (customer_type,customer_name,customer_adress,customer_phone,customer_status) Values
						('0','{$fio}','{$_POST['adress_add']}','{$_POST['phone_add']}','1');";
						mysqli_query($conn,$sql);
						echo <<<HTML
		<br>
		<div class="alert alert-success" role="alert">
			Запись успешно добавлена!
		</div>	
HTML;
						sleep(1);
						echo "<script>location.replace('customers.php');</script>";
					}
					
					if (isset($_POST['addBTNUr'])) {
						$sql = "Insert Into customer (customer_type,customer_name,customer_adress,customer_phone,customer_status) Values
						('1','{$_POST['organization_add']}','{$_POST['adress_add']}','{$_POST['phone_add']}','1');";
						mysqli_query($conn,$sql);
						echo <<<HTML
		<br>
		<div class="alert alert-success" role="alert">
			Запись успешно добавлена!
		</div>	
HTML;
						sleep(1);
						echo "<script>location.replace('customers.php');</script>";
					}
?>					