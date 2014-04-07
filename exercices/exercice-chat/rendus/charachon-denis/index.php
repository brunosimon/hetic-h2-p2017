<!DOCTYPE html>
<html lang="en">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Chatbox</title>

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="css/reset.css" />
    <link rel="stylesheet" type="text/css" href="css/jScrollPane.css" />
    <link rel="stylesheet" type="text/css" href="css/chat.css" />

    </head>

    <body>
        <div class="logo"><img src="img/logo_Chatbox.png"></div>

    <!-- CONTAINER -->
        <div id="chatContainer">

            <div id="chatTopBar"></div>
            <div id="chatLineHolder"></div>
            <div id="chatUsers"></div>
            
            <div id="chatBottomBar">
            	<div class="tip"></div>
                
                <form id="loginForm" method="post" action="">
                    <input id="name" name="name" class="rounded" maxlength="16" />
                    <input id="email" name="email" class="rounded" />
                    <input type="submit" class="blueButton" value="Login" />
                </form>
                
                <form id="submitForm" method="post" action="">
                    <input id="chatText" name="chatText" class="rounded" maxlength="255" />
                    <input type="submit" class="blueButton" value="Submit" />
                </form>
                
            </div>
        </div>

        <!-- JS -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
        <script src="js/jScrollPane/jquery.mousewheel.js"></script>
        <script src="js/jScrollPane/jScrollPane.min.js"></script>
        <script src="js/script.js"></script>
    </body>
</html>
