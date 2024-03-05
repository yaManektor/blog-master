<?php
if (!isset($_COOKIE['login'])) {
    header('Location: /register.php');
    exit();
}
?>

<!doctype html>
<html lang="ua">

<head>
    <?php
    $website_title = 'Список користувачів';
    require_once "blocks/head.php"
    ?>
</head>

<body>
    <?php require_once "blocks/header.php" ?>
    <?php require_once "lib/mysql.php" ?>

    <main>
        <h1>Список користувачів</h1>
        <?php
        $sql = 'SELECT `id`, `name`, `login` FROM `users`';
        $query = $pdo->query($sql);
        while ($row = $query->fetch(PDO::FETCH_OBJ))
            echo '<div class="row" id="' . $row->id . '"><b>Ім\'я: </b>' . $row->name . ', <b>логін: </b>' . $row->login .
                '<button class="del_user" onclick="deleteUser(' . $row->id . ')">Видалити</button></div>';
        ?>
    </main>

    <?php require_once "blocks/aside.php" ?>
    <?php require_once "blocks/footer.php" ?>

    <script>
        function deleteUser(id) {
            $.ajax({
                url: 'ajax/delete_user.php',
                type: 'POST',
                cache: false,
                data: {
                    'user_id': id,
                },
                dataType: 'html',
                success: function(data) {
                    $(data).remove();
                }
            });
        }
    </script>
</body>

</html>