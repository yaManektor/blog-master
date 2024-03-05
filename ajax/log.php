<?php
$login = trim(filter_var($_POST['login'], FILTER_SANITIZE_SPECIAL_CHARS));
$pass = trim(filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS));

$error = '';
if (strlen($login) < 3) $error = 'Введіть логін';
else if (strlen($pass) < 5) $error = 'Введіть пароль';

if ($error != '') {
    echo $error;
    exit();
}

require_once "../lib/mysql.php";

$salt = 'asgiuh!@#$*(Ywd8964351jwefh';
$pass = md5($salt . $pass);

$sql = 'SELECT `id` FROM `users` WHERE `login` = ? AND `password` = ?';
$query = $pdo->prepare($sql);
$query->execute([$login, $pass]);

if ($query->rowCount() == 0)
    echo 'Такого користувача не існує';
else {
    setcookie('login', $login, strtotime('+1 hour', time()), "/");
    echo 'Done';
}
