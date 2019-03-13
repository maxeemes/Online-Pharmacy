<?php
	session_start();
	if(!empty($_SESSION['login']))
	{
		header('Location: index.php');
	}
	else{
	    //обработчик нажатия loginBTN
	if(isset($_POST['loginBTN'])) {
	$host = "localhost";
  	$login = "root";
  	$passwd = "";
  	$db = "pharmacy_db";

  	$conn = mysqli_connect($host, $login, $passwd, $db);

  	if (!$conn) {
  		die("Connection failed: " . mysqli_connect_error());
      exit;
  	}
	
	$InputLogin = $_POST['login'];
	$InputPassword = $_POST['password'];
	$query = "Select password from login where login = '".$InputLogin."';";
	$result = mysqli_query($conn, $query);
	$pas = mysqli_fetch_assoc($result);
	
	$query2 = "Select salt from login where login = '".$InputLogin."';";
	$result2 = mysqli_query($conn, $query2);
	$salt = mysqli_fetch_assoc($result2);
	
	$query3 = "Select status from login where login = '".$InputLogin."';";
	$result3 = mysqli_query($conn, $query3);
	$status = mysqli_fetch_assoc($result3);
	
	$salt = $salt["salt"];
	$pas = $pas["password"];
	$status = $status["status"];

	if($pas == myhash($InputPassword,$salt)){
		$_SESSION['login']=$InputLogin;
		$_SESSION['status']=$status;
		header('Refresh: 2; url=index.php');
        $_SESSION['BascketNameString'] = "";
		echo <<<HTML
		<br>
		<div class="alert alert-success" role="alert">
			Welcome!
		</div>	
        
HTML;
		
		
	}
	else{
		echo <<<HTML
		<br>
		<div class="alert alert-danger" role="alert">
			Неправильный логин или пароль!
		</div>
HTML;
	}
}
}	
		function myhash($passwd, $SALT) { 
	
        $hash = md5($SALT . $passwd);  

        sleep(1);  
		
        return $hash;  
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
</head>
	<body class="container">
	<div class="jumbotron">
		<h1>Авторизация</h1>
	</div>
		<div class="reg">
			<form class="container" method="post">
				<div class="form-group">
				<h3>Логин</h3>
				<input type="text" name="login" class="form-control" required>
				<h3>Пароль</h3>
				<input type="password" name="password" class="form-control" required>
				</div>
				<input type="submit"  name="loginBTN" value="Войти" class="btn btn-outline-success btn-lg btn-block">
				<a href="register.php" class="btn btn-outline-primary btn-lg btn-block">Регистрация</a>
			</form>
		</div>
		
	</body>
</html>