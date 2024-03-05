<!doctype html>
<html lang="ua">

<head>
    <?php
    $website_title = 'Контакти';
    require_once "blocks/head.php"
    ?>
</head>

<body>
    <?php require_once "blocks/header.php" ?>

    <main>
        <h1>Зворотній зв'язок</h1>
        <form>
            <label for="name">Ваше ім'я</label>
            <input type="text" name="name" id="name">

            <label for="email">Ваш email</label>
            <input type="email" name="email" id="email">

            <label for="mess">Повідомлення</label>
            <textarea name="mess" id="mess" class="mess"></textarea>

            <div class="error-mess" id="error-block"></div>

            <button type="button" id="send_mess">Відправити</button>
        </form>
    </main>

    <?php require_once "blocks/aside.php" ?>
    <?php require_once "blocks/footer.php" ?>
    <script>
        $('#send_mess').click(function() {
            let name = $('#name').val();
            let email = $('#email').val();
            let mess = $('#mess').val();

            $.ajax({
                url: 'ajax/mail.php',
                type: 'POST',
                cache: false,
                data: {
                    'name': name,
                    'email': email,
                    'mess': mess,
                },
                dataType: 'html',
                success: function(data) {
                    $('#error-block').show();
                    if (data === 'Done') {
                        $('#error-block').css('color', '#74de7d');
                        $('#error-block').text('Повідомлення відправлено!');
                        $('#name').val("");
                        $('#email').val("");
                        $('#mess').val("");
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