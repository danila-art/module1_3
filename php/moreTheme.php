<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Модуль - 1.3</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/answerStyle.css">
</head>
<body>
<header>
    <div class="goHome">
        <a href="../">Вернуться назад</a>
    </div>
    <?php
    if ($_COOKIE['userEmail'] != '') {
        echo '<h2>Добро пожаловать, ' . $_COOKIE['userName'] . '</h2>';
        echo '<div class="userProfile"> 
                    <h2><a href="../php/userProfile.php">Мой профиль</a></h2>
              </div>';
        echo '<div id="buttonModule" class="button">
     <h2>Предложить тему</h2>
</div>
<div id="themeAddBox" class="themeAddBox">
    <form action="../php/addTheme.php" method="post">
        <div>
            <h3>Название темы</h3>
            <input type="text" name="name">
        </div>
       <div>
           <h3>Описание темы</h3>
           <input type="text" name="text">
       </div>
            <input class="submitButton" type="submit" value="Отправить">

    </form>
</div>';
        echo '<h3 style="text-align: center; padding-top: 1%"><a style="color: white; text-decoration: none" href="../php/exit.php">Выйти</a></h3>';
    } else {
        echo '<h2>Добро пожоловать, пользователь!</h2><br><h2>Вы не вошли в систему</h2>';
    }
    ?>

</header>

<?php
require_once 'connectDateBase.php';
$id_theme = $_POST['idTheme'];
//echo $id_theme;
$outTheme = $link_bd->query("SELECT * FROM `theme` WHERE `id_theme` = '$id_theme'");
while ($row = mysqli_fetch_assoc($outTheme)) {
    $idUser = $row['id_user'];
    $outUser = $link_bd->query("SELECT * FROM `user` WHERE `id`='$idUser'");
    $author = mysqli_fetch_assoc($outUser);
    if ($row['status'] == 'Тема прошла модерацию') {
        echo "<div class=\"themeBox\">
                    <div class=\"themeBox1\">
                        <h2>{$row['name']}</h2>
                        <div>
                            <h4>{$row['date']}</h4>
                            <h4>{$row['time']}</h4>
                        </div>
                    </div>
                    <div class=\"themeBox2\">
                        <div class='themeBox2_Author'>
                            <h3>Автор:</h3>
                            <h3>{$author['name']} {$author['surname']}</h3>
                        </div>
                        <div class='themeBox2_Text'>
                            <h3>{$row['text']}</h3>
                        </div>
                    </div>
                </div>";
    }
}
echo '<div><h2 style="text-align: center">Ответы к теме:</h2></div>';
$outAnswer = $link_bd->query("SELECT * FROM `answer` WHERE `id_theme` = '$id_theme'");
while ($arrAnswer = mysqli_fetch_assoc($outAnswer)){
    $answerIdUser = $arrAnswer['id_user'];
    $thisThemeAuthor = $link_bd->query("SELECT * FROM `user` WHERE `id` = '$answerIdUser'");
    while ($arrAuthor = mysqli_fetch_assoc($thisThemeAuthor)){
        $nameUser = $arrAuthor['name'];
        $surnameUser = $arrAuthor['surname'];
    }
    echo "<div class=\"answerBox\">
    <div class=\"answerFlex\">
        <div>
            <h2>Пользователь</h2>
            <h3>{$nameUser} {$surnameUser}<h3>
        </div>
        <div>
            <h2>Дата и время:</h2>
            <h3>{$arrAnswer['date']}</h3>
            <h3>{$arrAnswer['time']}</h3>
        </div>
    </div>
    <div class=\"answerText\">
        <h2>{$arrAnswer['text']}</h2>
    </div>
</div>";
}
?>

