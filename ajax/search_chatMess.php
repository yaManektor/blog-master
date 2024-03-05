<?php
require_once "../lib/mysql.php";

$sql = 'SELECT `message` FROM `chat` ORDER BY `id` DESC';
$query = $pdo->query($sql);
$row = $query->fetchAll(PDO::FETCH_OBJ);

if (empty($row)) {
    echo 'no messages';
    exit();
}

$str = '';
foreach ($row as $el)
    $str .= "<div class='chat_mess'>$el->message</div>";

echo $str;
