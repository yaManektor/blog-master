<!doctype html>
<html lang="ua">

<head>
    <?php
    require_once "lib/mysql.php";

    $sql = 'SELECT * FROM `articles` WHERE `id` = ?';
    $query = $pdo->prepare($sql);
    $query->execute([$_GET['id']]);

    $article = $query->fetch(PDO::FETCH_OBJ);

    $website_title = $article->title;
    require_once "blocks/head.php"
    ?>
</head>

<body>
    <?php require_once "blocks/header.php" ?>

    <main>
        <?php
        echo "<div class='post'>
                <h1>" . $article->title . "</h1>
                <h3>" . $article->anons . "</h3><br>
                <p>" . $article->main_text . "</p>
                <p class='author'>Автор статті: <span>" . $article->author . "</span></p><br>
                <p><b>Дата публікації:</b> " . date('d M Y, H:i:s', $article->date) . "</p>
            </div>";

        $sql = 'SELECT * FROM `comments` WHERE `article_id` = ? ORDER BY `id` DESC';
        $query = $pdo->prepare($sql);
        $query->execute([$_GET['id']]);
        $comments = $query->fetchAll(PDO::FETCH_OBJ);
        ?>

        <h2>Коментарі (<?= count($comments) ?>)</h2>
        <form class="form_comment">
            <label for="username">Ваше ім'я</label>
            <?php if (isset($_COOKIE['login'])) : ?>
                <input type="text" name="username" id="username" value="<?= $_COOKIE['login'] ?>">
            <?php else : ?>
                <input type="text" name="username" id="username">
            <?php endif; ?>

            <label for="mess">Коментар</label>
            <textarea type="mess" name="mess" id="mess"></textarea>

            <div class="error-mess" id="error-block"></div>

            <button type="button" id="send_mess">Додати коментар</button>
        </form>
        <hr>

        <div class="comments">
            <?php
            foreach ($comments as $el) {
                echo "<h2>" . $el->name . "</h2>
                <div class='comment'>
                    <p>" . $el->mess . "</p>
                </div>";
            }
            ?>
        </div>
    </main>

    <?php require_once "blocks/aside.php" ?>
    <?php require_once "blocks/footer.php" ?>

    <script>
        $('#send_mess').click(function() {
            let name = $('#username').val();
            let mess = $('#mess').val();

            $.ajax({
                url: 'ajax/add_comment.php',
                type: 'POST',
                cache: false,
                data: {
                    'username': name,
                    'mess': mess,
                    'id': '<?= $_GET['id'] ?>'
                },
                dataType: 'html',
                success: function(data) {
                    if (data === 'Done') {
                        $('.comments').prepend(`<h2>${name}</h2>
                                                <div class='comment'>
                                                    <p>${mess}</p>
                                                </div>`);
                        $('#error-block').hide();
                        $('#mess').val("");
                    } else {
                        $('#error-block').show();
                        $('#error-block').text(data);
                    }
                }
            })
        });
    </script>
</body>

</html>