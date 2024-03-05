<footer>Всі права захищені</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $('#send_chatMess').click(function() {
        let mess = $('#chat_input').val();

        $.ajax({
            url: 'ajax/add_chatMess.php',
            type: 'POST',
            cache: false,
            data: {
                'mess': mess,
            },
            dataType: 'html',
            success: function(data) {
                if (data === 'Done') {
                    $('#error-block').hide();
                    $('#chat_input').val("");
                } else {
                    $('#error-block').show();
                    $('#error-block').css('color', '#de7474');
                    $('#error-block').text(data);
                }
            }
        })
    });

    setInterval(function() {
        $.ajax({
            url: 'ajax/search_chatMess.php',
            type: 'POST',
            cache: false,
            data: {},
            dataType: 'html',
            success: function(data) {
                console.log(data);
                if (data === 'no messages') {
                    $('.chat .chat_messages').empty();
                    $('.chat .chat_messages').prepend(`<div class='first_mess'>Повідомлень ще немає</div>`);
                } else {
                    $('.chat .chat_messages').empty();
                    $('.chat .chat_messages').prepend(data);
                }
            }
        })
    }, 3000)
</script>