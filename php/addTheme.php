<?php
require_once 'connectDateBase.php';
$themeError = [];
if (!empty($_POST['name'])) {
    $themeName = $_POST['name'];
} else {
    $themeName = null;
    array_push($themeError, 'Поле название темы пусто');
}
if (!empty($_POST['text'])) {
    $themeText = $_POST['text'];
} else {
    $themeText = null;
    array_push($themeError, 'Поле описание темы пусто');
}
$date = date("Y-n-j");
$time = date("H:i:s");
$status = 'Тема ожидает модерацию';
$cookieUser = $_COOKIE['userEmail'];
$outUser = $link_bd->query("SELECT * FROM `user` WHERE `email` = '$cookieUser'");
$outUser = mysqli_fetch_assoc($outUser);
$userId = $outUser['id'];
if (count($themeError) == 0){
    $link_bd->query("INSERT INTO `theme`(`name`, `text`, `status`, `date`, `time`, `id_user`) VALUES ('$themeName', '$themeText', '$status', '$date', '$time', '$userId')");
    header('Location: ../');
}else{
    foreach ($themeError as $value){
        echo "{$value}<br>";
    }
    echo $themeError;
}
