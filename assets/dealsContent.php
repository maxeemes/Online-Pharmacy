<?php
session_start();

	$host = "localhost";
  	$login = "root";
  	$passwd = "";
  	$db = "pharmacy_db";
	

  	$conn = mysqli_connect($host, $login, $passwd, $db);

  	if (!$conn) {
  		die("Connection failed: " . mysqli_connect_error());
      exit;
  	}
	if($_SESSION['status'] == 0) $sqlshow = "AND deal_user = '{$_SESSION['login']}'";
	else $sqlshow = "";
	$show = "SELECT deal_id,deal_name_customer,deal_date,deal_cost FROM deal where deal_status = '1' {$sqlshow} ORDER BY deal_date;";
	$result =mysqli_query($conn, $show);
	if($result){
		echo <<<HEREDOC
					<table class="table table-hover">
					<thead class="thead-dark">
						<tr>
							<th>Номер сделки</td>
							<th>Заказчик</td>
							<th>Дата</td>
							<th>Стоимость сделки</td>
							<th>Просмотр</td>
							<th>Удаление</td>
						</tr>
						</thead>
HEREDOC;

		while($row = mysqli_fetch_array($result)){
                    echo <<<HEREDOC
                    <tr>
                    <td>{$row['deal_id']}</td>
                    <td>{$row['deal_name_customer']}</td>
                    <td>{$row['deal_date']}</td>
                    <td>{$row['deal_cost']} руб</td>
					<td><a class="btn btn-primary" name=\"red_id\" href=\dealsDetail.php?red_id={$row["deal_id"]}>Просмотр</a></td>
					<td><a class="btn btn-danger" name=\"del_id\" href=\deals.php?del_id={$row["deal_id"]}>Удалить</a></td>
                    </tr>
HEREDOC;
                  }
	}
	  

	   if (isset($_GET['del_id'])) {
		   echo <<<HTML
					<br>
							<div class="alert alert-danger" role="alert">
								Вы действительно хотите удалить сделку № {$_GET['del_id']}?
							</div>
							<form method="post">
								<input type="submit"  name="delYesBTN" value="Да" style="width: 50%;" class="btn btn-danger">
								<input type="submit"  name="delNoBTN" value="Нет" style="width: 50%;" class="btn btn-success">
							</form>
HTML;
	   }
	   
	   if(isset($_POST['delNoBTN'])){
			echo "<script>location.replace('deals.php');</script>";
	   }

	   if(isset($_POST['delYesBTN'])){
		   $del = (int) $_GET['del_id'];
		   $sql = "Update deal Set deal_status = '0' WHERE deal_id = {$del}";
			$result = mysqli_query($conn, $sql);
			if($result){
				echo <<<HTML
		<br>
		<div class="alert alert-success" role="alert">
			Запись успешно удалена!
		</div>	
HTML;
		sleep(1);
		echo "<script>location.replace('deals.php');</script>";
			}else{
				echo <<<HTML
		<br>
		<div class="alert alert-danger" role="alert">
			Запись не была удалена!
		</div>	
HTML;
		sleep(1);
		echo "<script>location.replace('deals.php');</script>";
			}
						
	   }
	  
?>				