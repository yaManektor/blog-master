<!doctype html>
<html lang="ua">

<head>
    <?php
    $website_title = 'Реєстрація';
    require_once "blocks/head.php"
    ?>
</head>

<body>
    <?php require_once "blocks/header.php" ?>

    <main>
        <h1>Реєстрація</h1>
        <form>
            <label for="username">Ваше ім'я</label>
            <input type="text" name="username" id="username">

            <label for="email">Ваш email</label>
            <input type="email" name="email" id="email">

            <label for="login">Ваш логін</label>
            <input type="text" name="login" id="login">

            <label for="password">Ваш пароль</label>
            <input type="password" name="password" id="password">

            <div class="error-mess" id="error-block"></div>

            <button type="button" id="reg_user">Зареєструватися</button>
        </form>
    </main>

    <?php require_once "blocks/aside.php" ?>
    <?php require_once "blocks/footer.php" ?>
    <script>
        $('#reg_user').click(function() {
            let name = $('#username').val();
            let email = $('#email').val();
            let login = $('#login').val();
            let pass = $('#password').val();

            $.ajax({
                url: 'ajax/reg.php',
                type: 'POST',
                cache: false,
                data: {
                    'username': name,
                    'email': email,
                    'login': login,
                    'password': pass
                },
                dataType: 'html',
                success: function(data) {
                    $('#error-block').show();
                    if (data === 'Done') {
                        $('#error-block').css('color', '#74de7d');
                        $('#error-block').text('Реєстрація пройшла успішно!');
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