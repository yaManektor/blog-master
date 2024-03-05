<?php
$name = trim(filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS));
$email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
$mess = trim(filter_var($_POST['mess'], FILTER_SANITIZE_SPECIAL_CHARS));

$error = '';
if (strlen($name) < 2) $error = 'Введіть ім\'я';
else if (strlen($email) < 5) $error = 'Введіть email';
else if (strlen($mess) < 10) $error = 'Введіть повідомлення';

if ($error != '') {
    echo $error;
    exit();
}

$to = 'dante33151@gmail.com';
$subject = '=?utf-8?B?' . base64_encode('Нове повідомлення з Blog Master') . '?=';
$message = "Користувач: $name.<br> $mess";
$headers = "From: $email\r\nReply-to: $email\r\nContent-type: text/html; charset=utf-8\r\n";
mail($to, $subject, $message, $headers);

echo 'Done';
