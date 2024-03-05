<?php
$user_id = $_POST['user_id'];

require_once "../lib/mysql.php";

$sql = 'DELETE FROM `users` WHERE `id` = ' . $user_id;
$query = $pdo->exec($sql);

echo "#$user_id";
