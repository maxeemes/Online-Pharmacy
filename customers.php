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
	

  	$conn = mysqli_connect($host, $login, $passwd, $db);

  	if (!$conn) {
  		die("Connection failed: " . mysqli_connect_error());
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
<!--TODO Сделать такой бредкрамб везде-->
<?php require_once("/assets/header.php") ?>
	<div class="container">
		<div class="Main">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page"><a href="index.php">Главная</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Заказчики</li>
                </ol>
            </nav>
			<div class="Content">
			    <div class="form-group">
			        <h1 class="display-4">Заказчики</h1>
			            <form method="post" >
			                <select name="type_add" class="form-control" style="width: 20%">
			                    <option>Физ. лицо</option>
			                    <option>Юр. лицо</option>
			                </select>
			                <input style="width: 20%" type="submit"  name="addBTN" value="Добавить"  class="btn btn-success form-control">
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
    /*echo <<<HTML
<script>location.replace('customers.php');</script>
HTML;*/

    if($_POST['type_add'] == "Физ. лицо"){
		echo <<<HEREDOC
                        <form method="post" class="form-group container">
                            <h3>Добавление Физического лица</h3>
                            <br>
						    <div>
						        <h5>Фамилия</h5>
						        <input class="form-control" type="text" required name="family_add" value="">			
						    </div>
						    <br>
						    <div>
						        <h5>Имя</h5>
						        <input class="form-control" type="text" required name="name_add" value="">
						        <h5>Адресс</h5>
						        <input class="form-control" type="text" required name="adress_add" maxlength="100" value="">
						    </div>
						    <br>
						    <div>
						        <h5>Отчество</h5>
						        <input class="form-control" type="text" required name="patronymic_add" value="">
						    </div>
						    <br>
						    <div>
						        <h5>Телефон</h5>
						        <input class="form-control" type="tel"  required name="phone_add" pattern='[0-9]{1,}' maxlength="11" value="">
						    </div>
						    <br>
						    <input type="submit" required  name="addBTNFiz" value="Добавить" class="btn btn-success btn-block">
						</form>
                        <form method="post" class="container">
                            <input type="submit"  required name="addCancelBTN" value="Отменить" class="btn btn-secondary btn-block">
                        </form>
                        <br>
HEREDOC;
	}
	if($_POST['type_add'] == "Юр. лицо"){
		echo <<<HEREDOC
						<form method="post" class="form-group container">
						    <h3>Добавление организации</h3>
						    <br>
						    <div>
						        <h5>Наименование организации</h5>
						        <input class="form-control" type="text" required name="organization_add" maxlength="150" value="">		
						    </div>
						    <br>
						    <div>
						        <h5>Адресс</h5>
						        <input class="form-control" type="text" required name="adress_add" maxlength="100" value="">
						    </div>
						    <br>
						    <div>
						        <h5>Телефон</h5>
						        <input class="form-control" type="text" required name="phone_add" pattern='[0-9]{1,}' maxlength="11" value="">
						    </div>
						    <br>
						    <input type="submit"  name="addBTNUr" value="Добавить" class="btn btn-success btn-block">
						</form>
                        <form method="post" class="container">
                            <input type="submit"  name="addCancelBTN" value="Отменить" class="btn btn-secondary btn-block">
                        </form>
                        <br>
HEREDOC;
	}
}

if (isset($_POST['addCancelBTN'])) {
    echo "<script>location.replace('customers.php');</script>";
}
					
if (isset($_POST['addBTNFiz'])) {
    $fio = $_POST['family_add'] . ' ' . $_POST['name_add'] . ' ' . $_POST['patronymic_add'];
    $sql = "Insert Into customer (customer_type,customer_name,customer_adress,customer_phone,customer_status) Values
						('0','{$fio}','{$_POST['adress_add']}','{$_POST['phone_add']}','1');";
    mysqli_query($conn, $sql);
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
    mysqli_query($conn, $sql);
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