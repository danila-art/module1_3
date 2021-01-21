<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Модуль - 1.3</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header>
    <?php
    if ($_COOKIE['userEmail'] != '') {
        echo '<h2>Добро пожаловать, ' . $_COOKIE['userName'] . '</h2>';
        echo '<div class="userProfile"> 
                    <h2><a href="php/userProfile.php">Мой профиль</a></h2>
              </div>';
        echo '<div id="buttonModule" class="button">
     <h2>Предложить тему</h2>
</div>
<div id="themeAddBox" class="themeAddBox">
    <form action="php/addTheme.php" method="post">
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
        echo '<h3 style="text-align: center; padding-top: 1%"><a style="color: white; text-decoration: none" href="php/exit.php">Выйти</a></h3>';
    } else {
        echo '<h2>Добро пожоловать, пользователь!</h2><br><h2>Вы не вошли в систему</h2>';
    }
    ?>

</header>
<?php
if ($_COOKIE['userEmail'] == '') {
    echo '<section class="registr">
    <h2>Регистрация</h2>
    <form action="php/registr.php" method="post">
        <div>
            <h3>Введите email</h3>
            <input type="text" name="email">
        </div>
        <div>
            <h3>Введите свое имя</h3>
            <input type="text" name="name">
        </div>
        <div>
            <h3>Введите свою фамилию</h3>
            <input type="text" name="surname">
        </div>
        <div>
            <h3>Придумайте пароль</h3>
            <input type="password" name="password">
        </div>
        <div>
            <h3>Подтвердите пароль</h3>
            <input type="password" name="repeatPassword"><br>
        </div>
        <input type="submit" value="Отправить">
    </form>
</section>
<section class="avtorization">
    <h1>Авторизация</h1>
    <form action="php/auth.php" method="post">
        <div>
            <h3>Введите email</h3>
            <input type="text" name="email">
        </div>
        <div>
            <h3>Введите пароль</h3>
            <input type="password" name="password">
        </div>
        <input type="submit" value="Отправить">
    </form>
</section>';
}
?>
<section class="theme">
    <?php
    require_once 'php/connectDateBase.php';
    $outTheme = $link_bd->query("SELECT * FROM `theme`");
    while ($row = mysqli_fetch_assoc($outTheme)) {
        $idUser = $row['id_user'];
        $outUser = $link_bd->query("SELECT * FROM `user` WHERE `id`='$idUser'");
        $author = mysqli_fetch_assoc($outUser);
        if ($row['status'] == 'Тема прошла модерацию') {
            echo "<div class=\"themeBox\">
                    <div class=\"themeBox1\">
                        <h2>{$row['name']}</h2>
                        <h4>{$row['date']}</h4>
                    </div>
                    <div class=\"themeBox2\">
                        <div class='themeBox2_Author'>
                            <h3>Автор:</h3>
                            <h3>{$author['name']} {$author['surname']}</h3>
                        </div>
                        <div class='themeBox2_Text'>
                            <h3>{$row['text']}</h3>
                        </div>
                        <div class='themeBox2_More'>
                            <form action='php/moreTheme.php' method='post'>
                                <input type='hidden' name='idTheme' value=\"{$row['id_theme']}\">
                                <input class=\"submitButton \" type=\"submit\" value=\"Просмотреть тему\">
                            </form>
                        </div>
                    </div>
                </div>";
        }

    }
    $link_bd->close();
    ?>
</section>

<script src="js/scriptJavaScript.js" type="text/javascript"></script>
</body>
</html>