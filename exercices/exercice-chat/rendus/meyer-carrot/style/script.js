// Find the form and the message
    var form  = $('form.chat'),
        input = form.find('input[type=text]');

// Getting messages every second 
    window.setInterval(function()
    {
        $.ajax({
            url : 'receive.php',
            data : "room=<?= $_GET['room']; ?>",
            type : "POST",
            success : function(res)
                {
                    $('.messages').html(res);
                    console.log('recup');
                }
            });
        },1000);

// Listening the form's submit
    form.on('submit',function()
        {
            $.ajax({
                url     : 'send.php',
                data    : "message="+input.val()+"&pseudo=<?= $_GET['pseudo']; ?>&room=<?= $_GET['room']; ?>",
                type    : 'POST',
                success : function(res)
                {
                    $('input.message').val("");
                }
                });
            return false;
        });

