<?php
    include('config.php');
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chat PHP - Valentin David - Sylvain Houcke</title>
    <link rel="stylesheet" href="css/style.css">
    <link href='http://fonts.googleapis.com/css?family=Oswald:400,300|Raleway:400,300' rel='stylesheet' type='text/css'>

</head>
<body>
    <?php 

     if(isset($_GET['pseudo']) && !empty($_GET['pseudo'])){
    
    ?>
        <div class="messages">
        </div>

        <form action="#" class="chat content">
            <input type="text" name="pseudo" class="message_text" onclick="this.value='';" >
            <input type="submit"  value="Send" class="btn_send">
        </form>

        <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
        <script>

            var form  = $('form.chat'),
                input = form.find('input[type=text]');

            window.setInterval(function()
            {
                $.ajax({
                    url : 'receive.php', 
                    success : function(res)  
                    {
                        $('.messages').html(res);
                    }
                });
            },1000);

            form.on('submit',function()
            {
                $.ajax({
                    url     : 'send.php', 
                    data    : "message="+input.val()+"&pseudo=<?= $_GET['pseudo']; ?>",
                    type    : 'POST', 
                    success : function(res) 
                    {
                        $('input.message').val("");
                    }
                });
                return false;
            });

        </script>
        

    <?php 

    }

    else{   
    ?>
    <div class="pseudo_empty">
    <h1>Veuillez rentrer un pseudo pour acceder au Chat</h1>
    <form action="index.php">
        <input type="submit" value="Je veux rentrer un pseudo" class="btn_empty"> 
    </form>
    </div>
    <?php    
    }

    ?>
</body>
</html>