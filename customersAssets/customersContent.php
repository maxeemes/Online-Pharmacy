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

$check = "SELECT * FROM customer;";
              if (mysqli_query($conn, $check)) {
                $show = "SELECT customer_id,customer_name, customer_type,customer_adress, customer_phone FROM customer Where customer_status != '0' ORDER BY customer_id DESC";
                $result =mysqli_query($conn, $show);
                if ($result)
                {

                  echo <<<HEREDOC
                                <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Наименование</td>
                                        <th>Тип</td>
                                        <th>Адресс</td>
                                        <th>Телефон</td>
										<th>Редактирование</td>
										<th>Удаление</td>
                                    </tr>
                                    </thead>
HEREDOC;
					

                 while($row = mysqli_fetch_array($result)){
					 $type;
					 if($row['customer_type'] == 0)$type="Физ. лицо";else $type = "Юр. лицо";
					 $custNameArray = explode(' ',$row['customer_name']);
					 $ModifyName;
					 for($i=0;$i<count($custNameArray);$i++){
					 if($i==0){
						 $ModifyName = $custNameArray[$i];
					 }
					 else{
						 $ModifyName = $ModifyName . '_' . $custNameArray[$i];
					 }
					 }
                    echo <<<HEREDOC
                    <tr>
                    <td>{$row['customer_name']}</td>
                    <td>{$type}</td>
                    <td>{$row['customer_adress']}</td>
                    <td>{$row['customer_phone']}</td>
					<td><a name=\"red_id\" href=\customers.php?red_id={$row["customer_id"]}>Редактировать</a></td>
					<td><a name=\"del_id\" href=\customers.php?del_id={$row["customer_id"]}&del_name={$ModifyName}>Удалить</a></td>
                    </tr>
HEREDOC;
				$ModifyName = '';
                  }
				 
                }
				
              }
              else {
                  echo "<script>alert('Ошибка Базы данных! Проверте наличие таблицы customer')</script>";
              }
			  
			  
					 if (isset($_GET['red_id'])) {
					  $id_red = $_GET['red_id'];
						$query = "SELECT customer_name, customer_type,customer_adress, customer_phone FROM customer Where customer_id={$id_red}";
						$result = mysqli_query($conn, $query);
						if($result){
							echo <<<HEREDOC
							<h3>Редактирование записи</h3>
HEREDOC;
							while($row = mysqli_fetch_array($result)){
								if($row['customer_type'] == 0){
									if($row['customer_type'] == 0)$type="Физ. лицо";else $type = "Юр. лицо";
									$ElsType="Физ. лицо";
									$CustomerNameArray = explode(' ',$row['customer_name']);
				echo <<<HEREDOC
						<form method="post">
						<div class = "redactor">
						<h5>Фамилия</h5>
						<input type="text" name="family_red" value="{$CustomerNameArray[0]}" style="margin-left: 2%;">
						<h5 style="margin-left:2%">Тип</h5>
						<select  name="type_red">
						<option>{$ElsType}</option>
						</select>			
						</div>
						<br>
						<div class = "redactor">
						<h5>Имя</h5>
						<input type="text" name="name_red" value="{$CustomerNameArray[1]}" style="margin-left: 29%;">
						<h5 style="margin-left:9%">Адресс</h5>
						<input type="text" name="adress_red" maxlength="100" value="{$row['customer_adress']}" style="margin-left: 2%;width:19em;">
						</div>
						<br>
						<div class = "redactor">
						<h5>Отчество</h5>
						<input type="text" name="patronymic_red" value="{$CustomerNameArray[2]}" style="margin-left: 2%;">
						<h5 style="margin-left:2%">Телефон</h5>
						<input type="text" name="phone_red" maxlength="11" value="{$row['customer_phone']}" style="margin-left: 2%;">
						</div>
						
						<input type="submit"  name="redBTNFiz" value="Редактировать" style="width: 13%;margin-left: 25%; color: black; 
						border-color:#010508;" class="btn btn-outline-secondary">
						<input type="submit"  name="redCanselBTN" value="Отменить" style="width: 13%;margin-left: 1%; color: black; 
						border-color:#010508;" class="btn btn-outline-secondary">
						</form>
HEREDOC;
								}
						else{
						$ElsType="Юр. лицо";
				echo <<<HEREDOC
						<form method="post">
						<div class = "redactor">
						<h5>Наименование организации</h5>
						<input type="text" name="organization_red" maxlength="150" value="{$row['customer_name']}" style="margin-left: 3%;width:24em;">
						<h5 style="margin-left:2%">Тип</h5>
						<select name="type_red">
						<option>{$ElsType}</option>
						</select>			
						</div>
						<br>
						<div class = "redactor">
						<h5>Адресс</h5>
						<input type="text" name="adress_red" maxlength="100" value="{$row['customer_adress']}" style="margin-left: 4%;width: 32em;">
						<h5 style="margin-left:3.5%">Телефон</h5>
						<input type="text" name="phone_red" maxlength="11" value="{$row['customer_phone']}" style="margin-left: 3%;width: 7em;">
						</div>
						<br>
						
						<input type="submit"  name="redBTNUr" value="Редактировать" style="width: 13%;margin-left: 73%; color: black; 
						border-color:#010508;" class="btn btn-outline-secondary">
						<input type="submit"  name="redCanselBTN" value="Отменить" style="width: 13%;margin-left: 1%; color: black; 
						border-color:#010508;" class="btn btn-outline-secondary">
						</form>
HEREDOC;
						}						
						
							}
						}
					
				  }
				  
				  
				   if (isset($_POST['redCanselBTN'])) {
					   echo "<script>location.replace('customers.php');</script>";
				   }
				   
				   if (isset($_POST['redBTNFiz'])) {
					   
					    $id_red;
						$family_red = $_POST['family_red'];
						$family_name = $_POST['name_red'];
						$family_patronymic = $_POST['patronymic_red'];
						$fio = $family_red . ' ' . $family_name . ' ' . $family_patronymic;
						if(strlen($fio) < 150){
						$family_type;
						if($_POST['type_red'] == 'Физ. лицо')$family_type = 0;else $family_type = 1;
						$family_adress = $_POST['adress_red'];
						$family_phone = $_POST['phone_red'];
						$sql = "Update customer Set customer_type = '{$family_type}', customer_name = '{$fio}',
						customer_adress = '{$family_adress}', customer_phone = '{$family_phone}' Where 
						customer_id = {$id_red}";


						mysqli_query($conn,$sql);
						echo <<<HTML
		<br>
		<div class="alert alert-success" role="alert">
			Запись успешно изменена!
		</div>	
HTML;
						sleep(1);
						echo "<script>location.replace('customers.php');</script>";
						}
						else{
						echo <<<HTML
					<br>
							<div class="alert alert-danger" role="alert">
								Слишком большой ФИО!
							</div>
HTML;
						}
				   }
				   if (isset($_POST['redBTNUr'])) {
					   $id_red;
					   $organization = $_POST['organization_red'];
					   $adress = $_POST['adress_red'];
					   $phone = $_POST['phone_red'];
					   if($_POST['type_red'] == 'Физ. лицо')$type = 0;else $type = 1;
					   $sql = "Update customer Set customer_type = '{$type}', customer_name = '{$organization}',
						customer_adress = '{$adress}', customer_phone = '{$phone}' Where 
						customer_id = {$id_red}";
						mysqli_query($conn,$sql);
						echo <<<HTML
		<br>
		<div class="alert alert-success" role="alert">
			Запись успешно изменена!
		</div>	
HTML;
						sleep(1);
						echo "<script>location.replace('customers.php');</script>";
				   }
				   if (isset($_GET['del_id'])) {
					   $NameOrganizationArray = explode('_',$_GET['del_name']);
					   $PrintNameOrganization;
					   for($i = 0; $i < count($NameOrganizationArray); $i++){
						   if($i == 0){
							   $PrintNameOrganization = $NameOrganizationArray[$i];
						   }
						   else{
							   $PrintNameOrganization = $PrintNameOrganization . ' ' . $NameOrganizationArray[$i];
						   }
					   }
					   	echo <<<HTML
					<br>
							<div class="alert alert-danger" role="alert">
								Вы действительно хотите удалить запись заказчика '{$PrintNameOrganization}'?
							</div>
							<form method="post">
							<input type="submit"  name="delYesBTNUr" value="Да" style="width: 50%;color: black; 
						border-color:#010508;" class="btn btn-outline-secondary">
						<input type="submit"  name="delNoBTN" value="Нет" style="width: 50%;color: black; 
						border-color:#010508;" class="btn btn-outline-secondary">
							</form>
HTML;
					if (isset($_POST['delYesBTNUr'])) {
						$del = (int) $_GET['del_id'];
						$sql = "Update customer Set customer_status  = '0' Where customer_id = {$del}";
						$result = mysqli_query($conn, $sql);
						echo <<<HTML
		<br>
		<div class="alert alert-success" role="alert">
			Запись успешно удалена!
		</div>	
HTML;
						sleep(1);
						echo "<script>location.replace('customers.php');</script>";
					}
					if (isset($_POST['delNoBTN'])) {
						echo "<script>location.replace('customers.php');</script>";
					}
				   }
?>				