<?php
require_once "connectDateBase.php";
$errors = [];
if (!empty($_POST['email'])){
    $userEmail = $_POST['email'];
}else{
    $userEmail = null;
    array_push($errors, 'Поле email является пустым');
}
if (!empty($_POST['name'])){
    $userName = $_POST['name'];
}else{
$userName = null;
array_push($errors, 'Поле имя является пустым');
}
if (!empty($_POST['surname'])){
    $userSurname = $_POST['surname'];
}else{
$userSurname = null;
array_push($errors, 'Поле фамилия является пустым');
}
if (!empty($_POST['password'])){
    $userPassword = $_POST['password'];
}else{
    $userPassword = null;
    array_push($errors, 'Поле пароль является пустым');
}
if (!empty($_POST['repeatPassword'])){
    $userRepeatPassword = $_POST['repeatPassword'];
}else{
    $userRepeatPassword = null;
    array_push($errors, 'Поле подтвердите пароль является пустым');
}
if (iconv_strlen($userPassword) < 6){
    $userPassword = null;
    array_push($errors, 'Пароль не может быть меньше 6 символов');
}
if (iconv_strlen($userPassword) > 20){
    $userPassword = null;
    array_push($errors, 'Пароль не может быть больше 20 символов');
}
if ($userPassword != $userRepeatPassword){
    $userPassword = null;
    $userRepeatPassword = null;
    array_push($errors, 'Пароли не совпадают');
}else{
    $userPassword = md5($userPassword);
}
if ($errors){
    for ($i = 0; $i < 3; $i++){
        echo $errors[$i] . '<br>';
    }
}
if (($userEmail != null) && ($userPassword != null)){
    $link_bd->query("INSERT INTO `user` (`email`,`name`, `surname`, `password`) VALUES ('$userEmail', '$userName', '$userSurname', '$userPassword')");
    $link_bd->close();
    header("Location: ../");
}else{
    echo 'Проблема с регистрацией';
}