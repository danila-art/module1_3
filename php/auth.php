<?php
require_once "connectDateBase.php";
if (!empty($_POST['email'])) {
    $userEmail = $_POST['email'];
} else {
    $userEmail = null;
    array_push($errors, 'Поле email является пустым');
}
if (!empty($_POST['password'])) {
    $userPassword = $_POST['password'];
    $userPassword = md5($userPassword);
} else {
    $userPassword = null;
    array_push($errors, 'Поле пароль является пустым');
}
$output = $link_bd->query("SELECT * FROM `user` WHERE `email` = '$userEmail' and `password` = '$userPassword'");
$user = $output->fetch_assoc();
if ($user == 0) {
    echo 'Пользователь не найден';
} else {
    if ($user['email'] == 'admin_admin@mail.ru') {
        setcookie('userEmail', $user['email'], time() + 3600, "/");
        setcookie("userName", $user["name"], time() + 3600, "/");
        header('Location: adminPanel.php');
    } else {
        setcookie('userEmail', $user['email'], time() + 3600, "/");
        setcookie("userName", $user["name"], time() + 3600, "/");
        header('Location: ../');
    }

}

