<?php
$title = trim(filter_var($_POST['title'], FILTER_SANITIZE_SPECIAL_CHARS));
$anons = trim(filter_var($_POST['anons'], FILTER_SANITIZE_SPECIAL_CHARS));
$main_text = trim(filter_var($_POST['main_text'], FILTER_SANITIZE_SPECIAL_CHARS));

$error = '';
if (strlen($title) < 5) $error = 'Введіть назву статті';
else if (strlen($anons) < 10) $error = 'Введіть анонс статті';
else if (strlen($main_text) < 10) $error = 'Введіть основний текст';

if ($error != '') {
    echo $error;
    exit();
}

require_once "../lib/mysql.php";

$sql = 'INSERT INTO `articles`(`title`, `anons`, `main_text`, `date`, `author`) VALUES (?, ?, ?, ?, ?)';
$query = $pdo->prepare($sql);
$query->execute([$title, $anons, $main_text, time(), $_COOKIE['login']]);

echo 'Done';
