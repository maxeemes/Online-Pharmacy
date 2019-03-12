<?php
session_start();

	if(isset($_SESSION["status"]) && $_SESSION["status"] != 0){
	echo <<<HTML
	<a class="btn btn-primary" href="addProduct.php" role="button">Добавить товар</a>	
HTML;
	}
?>