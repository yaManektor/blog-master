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
    $website_title = 'Додати статтю';
    require_once "blocks/head.php"
    ?>
</head>

<body>
    <?php require_once "blocks/header.php" ?>

    <main>
        <h1>Додати статтю</h1>
        <form>
            <label for="title">Назва статті</label>
            <input type="text" name="title" id="title">

            <label for="anons">Анонс статті</label>
            <textarea name="anons" id="anons"></textarea>

            <label for="main_text">Основний текст</label>
            <textarea name="main_text" id="main_text" class="main_text"></textarea>

            <div class="error-mess" id="error-block"></div>

            <button type="button" id="add_article">Додати</button>
        </form>
    </main>

    <?php require_once "blocks/aside.php" ?>
    <?php require_once "blocks/footer.php" ?>
    <script>
        $('#add_article').click(function() {
            let title = $('#title').val();
            let anons = $('#anons').val();
            let main_text = $('#main_text').val();

            $.ajax({
                url: 'ajax/add_article.php',
                type: 'POST',
                cache: false,
                data: {
                    'title': title,
                    'anons': anons,
                    'main_text': main_text,
                },
                dataType: 'html',
                success: function(data) {
                    $('#error-block').show();
                    if (data === 'Done') {
                        $('#error-block').css('color', '#74de7d');
                        $('#error-block').text('Статтю опубліковано!');
                        $('#title').val("");
                        $('#anons').val("");
                        $('#main_text').val("");
                    } else {
                        $('#error-block').css('color', '#de7474');
                        $('#error-block').text(data);
                    }
                }
            })
        });
    </script>
</body>

</html>