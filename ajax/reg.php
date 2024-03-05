<?php
$username = trim(filter_var($_POST['username'], FILTER_SANITIZE_SPECIAL_CHARS));
$email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
$login = trim(filter_var($_POST['login'], FILTER_SANITIZE_SPECIAL_CHARS));
$pass = trim(filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS));

$error = '';
if (strlen($username) < 2) $error = 'Введіть ім\'я';
else if (strlen($email) < 5) $error = 'Введіть email';
else if (strlen($login) < 3) $error = 'Введіть логін';
else if (strlen($pass) < 5) $error = 'Введіть пароль';

if ($error != '') {
    echo $error;
    exit();
}

require_once "../lib/mysql.php";

$salt = 'asgiuh!@#$*(Ywd8964351jwefh';
$pass = md5($salt . $pass);

$sql = 'INSERT INTO `users`(`name`, `email`, `login`, `password`) VALUES (?, ?, ?, ?)';
$query = $pdo->prepare($sql);
$query->execute([$username, $email, $login, $pass]);

echo 'Done';
