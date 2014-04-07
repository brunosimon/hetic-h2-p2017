<?php
    include('config.php');
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style/style.css" />
        <link href='http://fonts.googleapis.com/css?family=Share+Tech' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Candal' rel='stylesheet' type='text/css'>
        <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>      
        <title>Easy Chat <?php echo '- Room: '.$_GET['room'] ?> </title>
    </head>
<body id="chat-page">

    <?php 
        // If the var GET for the "pseudo" & and the "room" exist, we display the chat
        if(isset($_GET['pseudo']) && isset($_GET['room'])){    
    ?>

    <!-- Navigation + Title -->

    <a href="rooms.php?pseudo=<?php echo $_GET['pseudo']?>">
        <div id="go-back">
            <p>Go back to </br>the rooms</p>
        </div>
    </a>
    
    <div id="title-room">
        <h2> 
            <?php echo 'Room: '.$_GET['room'] ?>
        </h2>
    </div>

    <a href="index.php">
        <div id="logout">
            <p>LOG OUT</p>
        </div>
    </a>

    <!-- New messages are displayed here -->

    <div class="messages"></div>

    <!-- Form to send messages -->

        <form action="#" class="chat">
            <input type="text" class="message">
            <input type="submit" id="sending-button" value="SEND">
        </form>

    <script>
    // L'ajax ne marche pas lorsqu'il est appelé d'un fichier externe

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
    </script>

    <?php 
    } 

    ?>
</body>
</html>

