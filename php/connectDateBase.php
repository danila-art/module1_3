<?php
$host = 'localhost'; //Хост БД
$database = 'module1_3'; // Наименование
$login = 'root'; // Логин
$password = 'root'; // Пароль

//подключаемся к бд
$link_bd = mysqli_connect($host, $login, $password, $database) or die("Ошибка" . mysqli_error($link_bd));