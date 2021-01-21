<?php
setcookie('userEmail', '', time() - 3600, '/');
setcookie('userName', '', time() - 3600, '/');
header('Location: ../');