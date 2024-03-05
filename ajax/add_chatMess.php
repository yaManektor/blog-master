<?php
$mess = trim(filter_var($_POST['mess'], FILTER_SANITIZE_SPECIAL_CHARS));

$error = '';
if (strlen($mess) < 2) $error = 'Введіть повідомлення';

if ($error != '') {
    echo $error;
    exit();
}

require_once "../lib/mysql.php";

$sql = 'INSERT INTO `chat`(`message`) VALUES (?)';
$query = $pdo->prepare($sql);
$query->execute([$mess]);

echo 'Done';
