<?php

    session_start();

    require_once 'config.php';

    include("head.php");

    ?>

    <div id="titre">
    <h1>Le chat de Solène et Héloïse</h1>
    </div>

    <?php

    function print_form_connect(){

        echo'<div id="container">
            <p>Connexion :</p>
        </div>

         <form action="index.php" method="post">
            <div><label for"pseudo">Pseudo</label><input type="text" name="pseudo" id="pseudo"><div></div>
            <div><label for"password">Mot de passe</label><input type="password" name="password" id="password"></div>
            <!-- <p>
                Fille<input type="radio" name="sexe" value="fille">
                Garçon<input type="radio" name="sexe" value="garcon">
            </p> -->
            <input type="submit" name="connexion_form">
         </form>';
         echo '<br /><br /><a href="register.php">Inscription</a>';
    }

    print_r($_SESSION);

    if(!isset($_SESSION['id'])){

            if (isset($_POST['connexion_form'])){

                if ((!empty($_POST['pseudo'])) && (!empty($_POST['password']))) {
                    require_once 'config.php';    
                    $req = $pdo->prepare('SELECT * FROM users WHERE login = ? AND password = ?');
                    $req->execute(array($_POST['pseudo'], sha1($_POST['password'])));

                    $nb_rows = $req->rowCount();

                        if ($nb_rows > 0){
                            $data = $req->fetch();
                            print_r($data) ;
                            $_SESSION['id'] = $data['id'];
                            $_SESSION['pseudo'] = $data['login'];
                            session_write_close();
                            echo '<meta http-equiv="refresh" content="0; URL=index.php">';
                        }
                        else{
                            echo 'Impossible de se connecter : informations incorrectes.';
                            print_form_connect();
                        }
                }
                else{
                    echo 'Erreur : Tous les champs n\'ont pas été remplis.';
                    print_form_connect();
                }
            }
            else{
               print_form_connect(); 
            }


    } else {
        ?>
        <div id="container" class="chat">
        <p>  <img src="ajax-loader.gif" alt="patientez..."> LOADING...</p>
        </div>

    <!-- Notre formulaire -->
        <form action="#" class="message_form">
        <input type="text" name="text" id="champ" placeholder="Votre message">
        <input type="submit" id="submit" value="Valider">
    </form>

    <a href="logout.php">Déconnexion</a>


    <!-- Code ne fonctionnant pas sans jQuery -->
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
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

                        var sexe = res.messages[i].sexe;
                        if (sexe == "garcon") sexe = '<img src="images/men.png" width="30px" height="31px">';
                        else if (sexe == "fille") sexe = '<img src="images/women.png" width="30px" height="31px">';

                        // Affiche le message dans la console
                    container.innerHTML += '<span class="date">'+res.messages[i].date+'</span> <span class="sexe">' + sexe + '</span> <span class="pseudo">' + res.messages[i].pseudo + '</span> : <span class="message" style="background: #'+res.messages[i].background_color+'">' + res.messages[i].message + '</span></div>';  
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

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/main.js"></script>

</body>
</html>