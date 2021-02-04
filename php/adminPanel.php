<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/adminStyle.css">
    <title>AdminPanel</title>
</head>
<body>
<section class="boxAdmin">
    <div class="flexAdmin">
        <div class="goHome">
            <a href="../">Вернуться назад</a>
        </div>
        <div class="adminProfile">
            <div class="imgAdmin">
                <img src="../image/admin.png" alt="error">
            </div>
            <div class="nameAdmin">
                <h2><?php
                    $nameAdmin = $_COOKIE['userName'];
                    echo $nameAdmin;
                    ?></h2>
            </div>
        </div>
    </div>
<!--    Все темы-->
    <div class="adminThemes">
        <?php
        require_once 'connectDateBase.php';
        $outThemes = $link_bd->query("SELECT * FROM `theme`");
        while($row = mysqli_fetch_assoc($outThemes)){
            if ($row['status'] == 'Тема ожидает модерацию'){
                $status = '<h3 style="color: #d9d900">Тема ожидает модерацию</h3>';
            }elseif ($row['status'] == 'Тема прошла модерацию'){
                $status = '<h3 style="color: green">Тема прошла модерацию</h3>';
            }elseif ($row['status'] == 'Тема была отклонена'){
                $status = '<h3 style="color: red">Тема была отклонена</h3>';
            }
            $idUserInTheme = $row['id_user'];
            $outUser = $link_bd->query("SELECT * FROM `user` WHERE `id` = '$idUserInTheme'");
            while ($rowUser = mysqli_fetch_assoc($outUser)){
                $userName = $rowUser['name'];
                $userSurname = $rowUser['surname'];
            }
            echo "<div class=\"themeBox\">
                    <div class=\"themeBox1\">
                        <h2>{$row['name']}</h2>
                        <h4>{$row['date']}</h4>
                    </div>
                    <div class=\"themeBox2\">
                        <div class='themeBox2_Author'>
                            <h3>Автор:</h3>
                            <h3>{$userName} {$userSurname}</h3>
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
</section>
</body>
</html>