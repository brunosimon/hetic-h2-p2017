<?php
    session_start();
    require_once 'config.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Monster Inc. chat room</title>
    <link rel="stylesheet" href="style.css">
    
</head>
<body>
<div id="page">

<div id="logo_chat">
    <img src="logo.png">
</div>

<?php
    if(!isset($_SESSION['id'])){
        if(isset($_POST['text'])){

            $pseudo = $_POST['text'];
            $result = $pdo->exec("INSERT INTO users (login) VALUES ('".addslashes($pseudo)."')");
            $result = $pdo->query("SELECT * FROM users WHERE login = '".addslashes($pseudo)."' LIMIT 1");

            $user = $result->fetch();

            if(isset($user['id'])){
                $_SESSION['id'] = $user['id'];
            }

            ?>
            <div id="container">
                <p>Vous avez bien été identifié</p>
            </div>

            <!-- Notre formulaire -->
             <form action="#" method="post">
                <input type="submit" value="Accéder au tchat">
             </form>
            <?php
        } else {
            ?>
            <div id="container">
                <p>Choisissez votre pseudo :</p>
            </div>

            <!-- Notre formulaire -->
             <form action="#" method="post">
                <input type="text" name="text" id="champ">
                <input type="submit">
             </form>
            <?php
        }
    } else {
        ?>
        <div id="container">
        <p>LOADING...</p>
    </div>

    <!-- Notre formulaire -->
    <form action="#">
        <input type="text" name="text" id="champ">
        <input type="submit">
    </form>

    <!-- Code ne fonctionnant pas sans jQuery -->
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script>
        var container = document.getElementById('container');

        /**
         * Code à mettre dans un fichier JS indépendant
         */

        // Récupération du formulaire et du champ de texte
        var form  = $('form'),
            input = form.find('input[type=text]');

        // Interval répété toutes les 1000 ms qui s'occupe d'aller chercher les messages
        window.setInterval(function()
        {
            // Requête ajax
            $.ajax({
                url      : 'receive.php', // Url du script PHP qui va récupérer les messages
                dataType : 'json',        // Format json (objet)
                success  : function(res)  // Success (la requête à fonctionné)
                {
                    container.innerHTML = '';

                    // Boucle à travers les messages
                    for(var i = 0; i < res.messages.length; i++)
                    {
                        // Affiche le message dans la console
                    container.innerHTML += '<div id="total"><span class="date">['+res.messages[i].date+']</span> <span class="pseudo">' + res.messages[i].pseudo + '</span> : <span class="message">' + res.messages[i].message + '</span><br/></div>';   
                    }
                }
            });
        },1000);

        // On écoute l'événement submit du formulaire
        form.on('submit',function()
        {
            $.ajax({
                url     : 'send.php',               // Url du script qui va rajouter le message à la base de données
                data    : 'message=' + input.val(), // On envoit le message dans les paramètres
                type    : 'POST',                   // Type POST (pas obligatoire)
                success : function(res)             // Success (la requête à fonctionné)
                {
                    console.log(res);
                    document.getElementById('champ').value = ''
                }
            });

            return false;
        });

    </script>
        <?php
    }
?>

</div>
</body>
</html>