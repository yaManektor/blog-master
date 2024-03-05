<!doctype html>
<html lang="ua">

<head>
    <?php
    $website_title = 'Blog Master';
    require_once "blocks/head.php"
    ?>
</head>

<body>
    <?php require_once "blocks/header.php" ?>

    <main class="main">
        <?php
        require_once "lib/mysql.php";

        $sql = 'SELECT * FROM `articles` ORDER BY `date` DESC';
        $query = $pdo->query($sql);
        $row = $query->fetchAll(PDO::FETCH_OBJ);
        for ($i = 0; $i < count($row); $i++) {
            echo "<div class='post'>
                <h1>" . $row[$i]->title . "</h1>
                <p>" . $row[$i]->anons . "</p>
                <p class='author'>Автор статті: <span>" . $row[$i]->author . "</span></p>
                <a href='/post.php?id=" . $row[$i]->id . "' title='" . $row[$i]->title . "'>Прочитати</a>
            </div>";
            if ($i != count($row) - 1) echo '<hr>';
        }
        ?>
    </main>

    <?php require_once "blocks/aside.php" ?>
    <?php require_once "blocks/footer.php" ?>
</body>

</html>