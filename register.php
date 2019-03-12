<?php
session_start();
if(isset($_SESSION['status']) && $_SESSION['status'] == 0 ){
    header('Location: login.php');
}
    if (isset($_POST['registerbtn'])) {
        if ($_POST['password'] != $_POST['passwordConfirm']) {
            echo <<<HTML
		<div class="alert alert-danger" role="alert">
			Вводимые пароли не совпадают!
		</div>
HTML;
        } else {
            $host = "localhost";
            $login = "root";
            $passwd = "";
            $db = "pharmacy_db";


            $conn = mysqli_connect($host, $login, $passwd, $db);

            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
                exit;
            }

            define("SALT_LENGHT", 10);
            $r_min = 0;
            $r_max = 21;


            $SALT = substr(md5(uniqid() . time), mt_rand($r_min, $r_max), SALT_LENGHT);

            $log = $_POST['log'];
            $pas = $_POST['password'];
            $status = $_POST['status'];
            $hash = myhash($pas, $SALT);

            if (isset($_SESSION['status']) && $_SESSION['status'] >= 1) {
                if ($status == 'Пользователь') {
                    $status = 0;
                } else if ($status == 'Админ') {
                    $status = 1;
                } else if ($status == 'root пользователь') {
                    $status = 2;
                }
            }
            else $status = 0;
            $query = "INSERT INTO login (login, password,salt,status ) VALUES ('" . $log . "', '" . $hash . "', '" . $SALT . "','{$status}')";
            if ($result = mysqli_query($conn, $query)) {
                if (isset($_SESSION['status']) && $_SESSION['status'] >= 1) {
                    header('Refresh: 2; url=users.php');
                }
                else
                {
                    header('Refresh: 2; url=login.php');
                }
                echo <<<HTML
		<div class="alert alert-success" role="alert">
			Зарегестрирован!
		</div>		
HTML;
            }

        }
    }

    function myhash($passwd, $SALT)
    {

        $hash = md5($SALT . $passwd);

        sleep(1);


        return $hash;
    }
  ?>
<!Doctype>
<html>
<head>
  <title>Аптека</title>
  <meta charset="utf-8">
  <link rel="stylesheet"
  href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
  integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
  crossorigin="anonymous">
</head>
<body class="container">
  <div class="jumbotron">
	  <h1>Регистрация</h1>
  </div>
  <form class="container" method="post" >
      <div class="form-group">
        <h3>Логин:</h3>
		<input type="text" name="log" placeholder="Логин" class="form-control" required>
        <h3>Пароль:</h3>
		<input type="text" id="password"name="password" placeholder="Password" class="form-control" required>
        <h3>Подтвердите пароль:<input id="passwordConfirm" type="text" name="passwordConfirm" placeholder="Password confirm" class="form-control" required></h3>
		<?php if(isset($_SESSION["status"]) && ($_SESSION["status"] >= 1)) {
            echo <<<HTML
        <h3>Выбериет привелегию:
		<select name="status" class="form-control">
		<option>Пользователь</option>
HTML;
            if($_SESSION["status"] == 2) {
                echo <<<HTML
		<option>Админ</option>
		<option>root пользователь</option>
HTML;
            }
            echo <<<HTML
		</select>
		</h3>
HTML;
        }
?>

      </div>
      <input type="submit" name="registerbtn" value="<?php if(isset($_SESSION["status"]) && ($_SESSION["status"] == 0)) echo 'Регистрация'; else echo 'Зарегистрировать пользователя';?>" class="btn btn-outline-success btn-lg btn-block">
<?php if(isset($_SESSION["status"]) && ($_SESSION["status"] == 0)) {
    echo <<<HTML
	  <a href="index.php" class="btn btn-outline-primary btn-lg btn-block">Авторизация</a>
HTML;
    }
    ?>
  </form>
</body>
</html>
