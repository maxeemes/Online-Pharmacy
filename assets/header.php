<?php
//session_start();
//$status;
if(isset($_SESSION["status"])) {
    if(isset($_SESSION['BasketCount']) && $_SESSION['BasketCount'] == NULL) $_SESSION['BasketCount'] = 0;
//$_SESSION['BascketNameString'];

    if(isset($_POST['reset'])){
        $_SESSION['BasketCount'] = 0;
        $_SESSION['BascketNameString'] = "";
    }
    Switch ($_SESSION["status"]) {
        case 0:
            $status = "Пользователь";
            echo <<<HTML
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: rgba(0,255,0,0.16)">
  <a class="navbar-brand" href="index.php">
Аптека
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Главная <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          {$_SESSION['login']}
        </a>
        <form method="post" class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="deals.php">Сделки</a>
          <div class="dropdown-divider"></div>
          <input type="submit"  name="loguotBTN" value="Завершить сеанс" class="dropdown-item">
        </form>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="Orders.php">Корзина: {$_SESSION['BasketCount']}</a>
      </li>
    </ul>
    <form action="search.php" class="form-inline my-2 my-lg-0">
      <input name="search" class="form-control mr-sm-2" type="search" placeholder="Поиск" aria-label="Search">
      <input class="btn btn-outline-success my-2 my-sm-0" type="submit" name="go" value="Поиск">
    </form>
  </div>
</nav>
HTML;
            break;
        case 1:
            $status = "Админ";
            echo <<<HTML
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: rgba(0,255,0,0.16)">
  <a class="navbar-brand" href="index.php">
Аптека
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Главная <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="customers.php">Заказчики</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="deals.php">Сделки</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="addProduct.php">Добавление</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          {$_SESSION['login']}
        </a>
        <form method="post" class="dropdown-menu" aria-labelledby="navbarDropdown">
          <input value="Удаленные" class="dropdown-item" type="submit"  name="RecordDelBTN" >
          <div class="dropdown-divider"></div>
          <input type="submit"  name="loguotBTN" value="Завершить сеанс" class="dropdown-item">        
        </form>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="Orders.php">Корзина: {$_SESSION['BasketCount']}</a>
      </li>
    </ul>
    <form action="search.php" class="form-inline my-2 my-lg-0">
      <input name="search" class="form-control mr-sm-2" type="search" placeholder="Поиск" aria-label="Search">
      <input class="btn btn-outline-success my-2 my-sm-0" type="submit" name="go" value="Поиск">
    </form>
  </div>
</nav>
HTML;
            break;
        case 2:
            $status = "root";
            echo <<<HTML
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: rgba(0,255,0,0.16)">
  <a class="navbar-brand" href="index.php">
Аптека
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Главная <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="customers.php">Заказчики</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="deals.php">Сделки</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="users.php">Пользователи</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="addProduct.php">Добавление</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          {$status}
        </a>
        <form method="post" class="dropdown-menu" aria-labelledby="navbarDropdown">
          <input value="Удаленные" class="dropdown-item" type="submit"  name="RecordDelBTN" >
          <div class="dropdown-divider"></div>
          <input type="submit"  name="loguotBTN" value="Завершить сеанс" class="dropdown-item">        
        </form>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="Orders.php">Корзина: {$_SESSION['BasketCount']}</a>
      </li>
    </ul>
    <form action="search.php" class="form-inline my-2 my-lg-0">
      <input name="search" class="form-control mr-sm-2" type="search" placeholder="Поиск" aria-label="Search">
      <input class="btn btn-outline-success my-2 my-sm-0" type="submit" name="go" value="Поиск">
    </form>
  </div>
</nav>
HTML;
            break;
    }
}
else
{
    echo <<<HTML
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: rgba(0,255,0,0.16);">
  <ul class="navbar-nav mr-auto container">
      <li class="nav-item active">
        <a class="nav-link display-4" href="index.php">АВТОРИЗАЦИЯ<span class="sr-only">(current)</span></a>
      </li>

</ul>
</nav>
HTML;

}
?>