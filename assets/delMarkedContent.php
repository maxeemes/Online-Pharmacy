<?php
session_start();
if (isset($_POST['delNoBTN'])) {
	echo "<script>location.replace('delMarked.php');</script>";
}
	if (isset($_GET['delGroup'])) {
		$temp = str_replace('_', ' ', $_GET['delGroup']);
		echo <<<HTML
					<br>
							<div class="alert alert-danger" role="alert">
								Вы действительно хотите удалить запись? '{$temp}'?
							</div>
							<form method="post">
							<input type="submit"  name="delYesGroup" value="Да" style="width: 49%;color: black; 
						border-color:#010508;" class="btn btn-outline-secondary">
						<input type="submit"  name="delNoBTN" value="Нет" style="width: 49%;color: black; 
						border-color:#010508;" class="btn btn-outline-secondary">
							</form>
HTML;

		if (isset($_POST['delYesGroup'])) {
			$sql = "DELETE FROM category WHERE category_category = '{$temp}'";
			$result = mysqli_query($conn, $sql);
			echo <<<HTML
		<br>
		<div class="alert alert-success" role="alert">
			Запись успешно удалена!
		</div>	
HTML;
			sleep(1);
			echo "<script>location.replace('delMarked.php');</script>";
		}
	}
	if (isset($_GET['redGroup'])) {
		$temp = str_replace('_', ' ', $_GET['redGroup']);

		$sql = "Update category Set category_status = '1' Where category_category = '{$temp}'";
		$result = mysqli_query($conn, $sql);
		echo <<<HTML
		<br>
		<div class="alert alert-success" role="alert">
			Запись успешно Восстановлена!
		</div>	
HTML;
		sleep(1);
		echo "<script>location.replace('delMarked.php');</script>";
	}
	//////////////////////////////////
	
	if (isset($_GET['redProduct'])) {
		$temp = str_replace('_', ' ', $_GET['redProduct']);

		$sql = "Update product Set product_status = '1' Where product_name = '{$temp}'";
		$result = mysqli_query($conn, $sql);
		echo <<<HTML
		<br>
		<div class="alert alert-success" role="alert">
			Запись успешно Восстановлена!
		</div>	
HTML;
		sleep(1);
		echo "<script>location.replace('delMarked.php');</script>";
	}
	if (isset($_GET['delProduct'])) {
		$temp = str_replace('_', ' ', $_GET['delProduct']);
		echo <<<HTML
					<br>
							<div class="alert alert-danger" role="alert">
								Вы действительно хотите удалить запись? '{$temp}'?
							</div>
							<form method="post">
							<input type="submit"  name="delYesProduct" value="Да" style="width: 49%;color: black; 
						border-color:#010508;" class="btn btn-outline-secondary">
						<input type="submit"  name="delNoBTN" value="Нет" style="width: 49%;color: black; 
						border-color:#010508;" class="btn btn-outline-secondary">
							</form>
HTML;

		if (isset($_POST['delYesProduct'])) {
			$sql = "DELETE FROM product WHERE product_name = '{$temp}'";
			$result = mysqli_query($conn, $sql);
			echo <<<HTML
		<br>
		<div class="alert alert-success" role="alert">
			Запись успешно удалена!
		</div>	
HTML;
			sleep(1);
			echo "<script>location.replace('delMarked.php');</script>";
		}
	}
	if (isset($_GET['redGroup'])) {
		$temp = str_replace('_',' ',$_GET['redGroup']);
		
		$sql = "Update category Set category_status = '1' Where category_category = '{$temp}'";
						$result = mysqli_query($conn, $sql);
						echo <<<HTML
		<br>
		<div class="alert alert-success" role="alert">
			Запись успешно Восстановлена!
		</div>	
HTML;
						sleep(1);
						echo "<script>location.replace('delMarked.php');</script>";
	}
	///////////////////////////
		if (isset($_GET['redCustomer'])) {
			$temp = str_replace('_', ' ', $_GET['redCustomer']);

			$sql = "Update customer Set customer_status = '1' Where customer_name = '{$temp}'";
			$result = mysqli_query($conn, $sql);
			echo <<<HTML
		<br>
		<div class="alert alert-success" role="alert">
			Запись успешно Восстановлена!
		</div>	
HTML;
			sleep(1);
			echo "<script>location.replace('delMarked.php');</script>";
		}
	if (isset($_GET['delCustomer'])) {
		$temp = str_replace('_', ' ', $_GET['delCustomer']);
		echo <<<HTML
					<br>
							<div class="alert alert-danger" role="alert">
								Вы действительно хотите удалить запись? '{$temp}'?
							</div>
							<form method="post">
							<input type="submit"  name="delYesCustomer" value="Да" style="width: 49%;color: black; 
						border-color:#010508;" class="btn btn-outline-secondary">
						<input type="submit"  name="delNoBTN" value="Нет" style="width: 49%;color: black; 
						border-color:#010508;" class="btn btn-outline-secondary">
							</form>
HTML;

		if (isset($_POST['delYesCustomer'])) {
			$sql = "DELETE FROM customer WHERE customer_name = '{$temp}'";
			$result = mysqli_query($conn, $sql);
			echo <<<HTML
		<br>
		<div class="alert alert-success" role="alert">
			Запись успешно удалена!
		</div>	
HTML;
			sleep(1);
			echo "<script>location.replace('delMarked.php');</script>";
		}
	}
	
	///////////////////////////
		if (isset($_GET['redDeal'])) {
			$temp = str_replace('_', ' ', $_GET['redDeal']);

			$sql = "Update deal Set deal_status = '1' Where deal_name_customer = '{$temp}'";
			$result = mysqli_query($conn, $sql);
			echo <<<HTML
		<br>
		<div class="alert alert-success" role="alert">
			Запись успешно Восстановлена!
		</div>	
HTML;
			sleep(1);
			echo "<script>location.replace('delMarked.php');</script>";
		}
	if (isset($_GET['delDeal'])) {
		$temp = str_replace('_', ' ', $_GET['delDeal']);
		echo <<<HTML
					<br>
							<div class="alert alert-danger" role="alert">
								Вы действительно хотите удалить запись? '{$temp}'?
							</div>
							<form method="post">
							<input type="submit"  name="delYesDeal" value="Да" style="width: 49%;color: black; 
						border-color:#010508;" class="btn btn-outline-secondary">
						<input type="submit"  name="delNoBTN" value="Нет" style="width: 49%;color: black; 
						border-color:#010508;" class="btn btn-outline-secondary">
							</form>
HTML;
		if (isset($_POST['delYesDeal'])) {
			$sql = "DELETE FROM deal WHERE deal_name_customer = '{$temp}'";
			$result = mysqli_query($conn, $sql);
			echo <<<HTML
		<br>
		<div class="alert alert-success" role="alert">
			Запись успешно удалена!
		</div>	
HTML;
			sleep(1);
			echo "<script>location.replace('delMarked.php');</script>";
		}
	}
	
	
	
	///////////////////////////
	//////////////////////////
	/////////////////////////
	
	echo <<<HTML
		<h2>Категории</h2>
		<table class="table table-hover">
					<thead class="thead-dark">
						<tr>
							<th class="TableCenter">Наименование категории</td>
							<th class="TableCenter">Восстановление</td>
							<th class="TableCenter">Удаление</td>
						</tr>
						</thead>
HTML;
	while($row = mysqli_fetch_array($_SESSION["DelMarkedCategory"])){
		$temp = str_replace(' ','_',$row['category_category']);
		echo <<<HEREDOC
                    <tr>
                    <td class="TableCenter">{$row['category_category']}</td>
					<td class="TableCenter"><a name=\"redGroup\" href=\delMarked.php?redGroup={$temp}>Восстановить</a></td>
					<td class="TableCenter"><a name=\"delGroup\" href=\delMarked.php?delGroup={$temp}>Удалить</a></td>
                    </tr>
HEREDOC;
	}
	/////////////
			echo <<<HTML
		</table>
		<h2>Подкатегории</h2>
		<table class="table table-hover">
					<thead class="thead-dark">
						<tr>
							<th class="TableCenter">Наименование подкатегории</td>
							<th class="TableCenter">Восстановление</td>
							<th class="TableCenter">Удаление</td>
						</tr>
					</thead>
HTML;
	while($row = mysqli_fetch_array($_SESSION["DelMarkedSubCategory"])){
		$temp = str_replace(' ','_',$row['category_category']);
		echo <<<HEREDOC
                    <tr>
                    <td class="TableCenter">{$row['category_category']}</td>
					<td class="TableCenter"><a name=\"redGroup\" href=\delMarked.php?redGroup={$temp}>Восстановить</a></td>
					<td class="TableCenter"><a name=\"delGroup\" href=\delMarked.php?delGroup={$temp}>Удалить</a></td>
                    </tr>					
HEREDOC;
	}
	///////////////
			echo <<<HTML
		</table>
		<h2>Товары</h2>
		<table class="table table-hover">
					<thead class="thead-dark">
						<tr>
							<th class="TableCenter">Наименование товара</td>
							<th class="TableCenter">Восстановление</td>
							<th class="TableCenter">Удаление</td>
						</tr>
						</thead>
HTML;
	while($row = mysqli_fetch_array($_SESSION["DelMarkedProduct"])){
		$temp = str_replace(' ','_',$row['product_name']);
		echo <<<HEREDOC
                    <tr>
                    <td class="TableCenter">{$row['product_name']}</td>
					<td class="TableCenter"><a name=\"redProduct\" href=\delMarked.php?redProduct={$temp}>Восстановить</a></td>
					<td class="TableCenter"><a name=\"delProduct\" href=\delMarked.php?delProduct={$temp}>Удалить</a></td>
                    </tr>					
HEREDOC;
	}
	
		///////////////
			echo <<<HTML
		</table>
		<h2>Заказчики</h2>
		<table class="table table-hover">
					<thead class="thead-dark">
						<tr>
							<th class="TableCenter">Наименование</td>
							<th class="TableCenter">Восстановление</td>
							<th class="TableCenter">Удаление</td>
						</tr>
						</thead>
HTML;

	if(!is_bool($_SESSION["DelMarkedCustomer"])) {
		while ($row = mysqli_fetch_array($_SESSION["DelMarkedCustomer"])) {
			$temp = str_replace(' ', '_', $row['customer_name']);
			echo <<<HEREDOC
                    <tr>
                    <td class="TableCenter">{$row['customer_name']}</td>
					<td class="TableCenter"><a name=\"redCustomer\" href=\delMarked.php?redCustomer={$temp}>Восстановить</a></td>
					<td class="TableCenter"><a name=\"delCustomer\" href=\delMarked.php?delCustomer={$temp}>Удалить</a></td>
                    </tr>					
HEREDOC;
		}
	}
	
			///////////////
			echo <<<HTML
		</table>
		<h2>Сделки</h2>
		<table class="table table-hover">
					<thead class="thead-dark">
						<tr>
							<th class="TableCenter">КонтрАгент</td>
							<th class="TableCenter">Дата</td>
							<th class="TableCenter">Восстановление</td>
							<th class="TableCenter">Удаление</td>
						</tr>
						</thead>
HTML;
	var_dump($_SESSION["DelMarkedDeal"]);
	if(!is_bool($_SESSION["DelMarkedDeal"])) {
		while ($row = mysqli_fetch_array($_SESSION["DelMarkedDeal"])) {
			$temp = str_replace(' ', '_', $row['deal_name_customer']);
			echo <<<HEREDOC
                    <tr>
                    <td class="TableCenter">{$row['deal_name_customer']}</td>
                    <td class="TableCenter">{$row['deal_date']}</td>
					<td class="TableCenter"><a name=\"redDeal\" href=\delMarked.php?redDeal={$temp}>Восстановить</a></td>
					<td class="TableCenter"><a name=\"delDeal\" href=\delMarked.php?delDeal={$temp}>Удалить</a></td>
                    </tr>					
HEREDOC;
		}
	}
	 echo <<<HTML
	 </table>
HTML;
?>				