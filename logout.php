<?php 

session_start();
if(isset($_SESSION['user'])){ //проверяет объявлина ли переменная. переменная объявлена 
    unset($_SESSION['user']); // удаляем переменную 

}
header("Location: login.php"); // делаем переадрисацию
die;