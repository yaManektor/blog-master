<!doctype html>
<html lang="ua">

<head>
    <?php
    if (isset($_COOKIE['login']))
        $website_title = 'Кабінет користувача';
    else
        $website_title = 'Авторизація';
    require_once "blocks/head.php"
    ?>
</head>

<body>
    <?php require_once "blocks/header.php" ?>

    <main>
        <?php if (!isset($_COOKIE['login'])) : ?>
            <h1>Авторизація</h1>
            <form>
                <label for="login">Ваш логін</label>
                <input type="text" name="login" id="login">

                <label for="password">Ваш пароль</label>
                <input type="password" name="password" id="password">

                <div class="error-mess" id="error-block"></div>

                <button type="button" id="log_user">Ввійти</button>
            </form>
        <?php else : ?>
            <h1>Привіт, <?= $_COOKIE['login'] ?>!</h1>
            <form>
                <button type="button" id="exit_user">Вийти</button>
            </form>
        <?php endif; ?>
    </main>

    <?php require_once "blocks/aside.php" ?>
    <?php require_once "blocks/footer.php" ?>
    <script>
        $('#log_user').click(function() {
            let login = $('#login').val();
            let pass = $('#password').val();

            $.ajax({
                url: 'ajax/log.php',
                type: 'POST',
                cache: false,
                data: {
                    'login': login,
                    'password': pass
                },
                dataType: 'html',
                success: function(data) {
                    if (data === 'Done') {
                        $('#error-block').hide();
                        document.location.reload(true);
                    } else {
                        $('#error-block').show();
                        $('#error-block').text(data);
                    }
                }
            })
        });

        $('#exit_user').click(function() {
            $.ajax({
                url: 'ajax/exit.php',
                type: 'POST',
                cache: false,
                data: {},
                dataType: 'html',
                success: function(data) {
                    document.location.reload(true);
                }
            })
        });
    </script>
</body>

</html>