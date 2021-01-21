<?php
if ($_COOKIE['userEmail'] == ''){
    header('Location: ../');
}
require_once 'connectDateBase.php';
$userEmail = $_COOKIE['userEmail'];
$user = $link_bd->query("SELECT * FROM `user` WHERE `email` = '$userEmail'");
$user = mysqli_fetch_assoc($user);
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/userProfileStyle.css">
    <title>My Profile</title>
</head>
<body>
<?php
if ($_COOKIE['userEmail'] != '') {
    echo "<div class=\"logoUser\">
    <div class='logoContent'>
        <img src=\"../image/unnamed.jpg\" alt=\"ErrorUpImage\">
    </div>
   <h2>{$user['name']} {$user['surname']}
</div>
";
}
?>
<div id="buttonModule" class="button">
     <h2>Предложить тему</h2>
</div>
<div id="themeAddBox" class="themeAddBox">
    <form action="addTheme.php" method="post">
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
</div>
<div class="myTheme">
    <h2>Мои темы</h2>
    <hr>
    <?php
        $userId = $user['id'];
        $themeUser = $link_bd->query("SELECT * FROM `theme` WHERE `id_user` = '$userId'");
        while($row = mysqli_fetch_assoc($themeUser)){
            if ($row['status'] == 'Тема ожидает модерацию'){
                $status = '<h3 style="color: #d9d900">Тема ожидает модерацию</h3>';
            }elseif ($row['status'] == 'Тема прошла модерацию'){
                $status = '<h3 style="color: green">Тема прошла модерацию</h3>';
            }elseif ($row['status'] == 'Тема была отклонена'){
                $status = '<h3 style="color: red">Тема была отклонена</h3>';
            }
            echo "<div class=\"themeBox\">
                    <div class=\"themeBox1\">
                        <h2>{$row['name']}</h2>
                        <h4>{$row['date']}</h4>
                    </div>
                    <div class=\"themeBox2\">
                        <div class='themeBox2_Author'>
                            <h3>Автор:</h3>
                            <h3>{$user['name']} {$user['surname']}</h3>
                        </div>
                        <div class='themeBox2_Text'>
                            <h3>{$row['text']}</h3>
                        </div>
                        <div class='themeBox2_More'>
                            <div>
                               <h2>Статус:</h2>
                               <h3>{$status}</h3>   
                            </div>
                        </div>
                    </div>
                </div>";
        }
    ?>
</div>
<script src="../js/scriptJavaScript.js" type="text/javascript"></script>
</body>
</html>

