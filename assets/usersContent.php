<?php
session_start();

	$host = "localhost";
  	$login = "root";
  	$passwd = "";
  	$db = "pharmacy_db";
	

  	$conn = mysqli_connect($host, $login, $password, $db);

  	if (!$conn) {
  		die("Connection failed: " . mysqli_connect_error());
      exit;
  	}
	
		function myhash($passwd, $SALT) { 
	
        $hash = sha1($SALT . $passwd);  
			
        return $hash;  
    }
	
	if(isset($_POST['addUser'])){
		echo "<script>location.replace('register.php');</script>";		
	}
/////////////////////

				   if (isset($_GET['del_id'])) {

					   	echo <<<HTML
					<br>
							<div class="alert alert-danger" role="alert">
								Вы действительно хотите удалить запись пользователя '{$_GET['del_id']}'?
							</div>
							<form method="post">
							<input type="submit"  name="delYesBTN" value="Да" style="width: 49%;color: black; 
						border-color:#010508;" class="btn btn-outline-secondary">
						<input type="submit"  name="delNoBTN" value="Нет" style="width: 49%;color: black; 
						border-color:#010508;" class="btn btn-outline-secondary">
							</form>
HTML;
					if (isset($_POST['delYesBTN'])) {
						$del = $_GET['del_id'];
						$sql = "DELETE FROM login WHERE login = '{$del}'";
						$result = mysqli_query($conn, $sql);
						echo <<<HTML
		<br>
		<div class="alert alert-success" role="alert">
			Запись успешно удалена!
		</div>	
HTML;
						sleep(1);
						echo "<script>location.replace('users.php');</script>";
					}
					if (isset($_POST['delNoBTN'])) {
						echo "<script>location.replace('users.php');</script>";
					}
				   }	
	
	
	
	
	
	
	
	
	///////////////
$check = "SELECT * FROM login;";
              if (mysqli_query($conn, $check)) {
                $show = "SELECT login,password, privilege FROM login ORDER BY privilege DESC";
                $result =mysqli_query($conn, $show);
                if ($result)
                {

                  echo <<<HEREDOC
						<form method='post'>
						<input type="submit"  name="addUser" value="Добавить пользователя" style="width: 100%;color: black; 
						</form>
						border-color:#010508;height: 3rem;" class="btn btn-outline-secondary">
                                <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Логин</td>
                                        <th>Пароль</td>
                                        <th>Привелегия</td>
										<th>Удаление</td>
                                    </tr>
                                    </thead>
HEREDOC;
					

                 while($row = mysqli_fetch_array($result)){
					 $type;
					 if($row['privilege'] == 0){
						 $type="Пользователь";
					 }else if($row['privilege'] == 1){
						 $type="Админ";
					 }else if($row['privilege'] == 2){
						$type="Полные права"; 
					 }

					define("SALT_LENGHT", 10);
					$r_min = 0;
					$r_max = 21;

					
					$SALT = substr(md5(uniqid() . time), mt_rand($r_min, $r_max), SALT_LENGHT);
					
					$log = $_POST['log'];
					$pas = $_POST['password'];
					$hash = myhash($pas,$SALT);
					 
					 
					 
                    echo <<<HEREDOC
                    <tr>
                    <td>{$row['login']}</td>
                    <td>{$row['password']}</td>
                    <td>{$type}</td>
					<td><a name=\"del_id\" href=\users.php?del_id={$row["login"]}>Удалить</a></td>
                    </tr>
HEREDOC;
				$ModifyName = '';
                  }
				 
                }
				
              }
              else {
                  echo "<script>alert('Ошибка Базы данных! Проверте наличие таблицы customer')</script>";
              }
			  

?>				