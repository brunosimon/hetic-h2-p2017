<?php

    session_start();

    require_once 'config.php';
    include("head.php");

    ?>

    <div id="titre">
        <p class="deconnexion">
        <h1>Le chat de Solène et Héloïse</h1><a class="logout" href="logout.php">Déconnexion</a></p>
    </div>

    <?php

    function print_form_connect(){

        echo'<div class="form_wrapper">
                <div id="container">
                    <h3>Connexion</h3>
                </div>

         <form action="index.php" method="post">
            <div class="form_wrapper_pseudo"><label for"pseudo">Pseudo</label><input type="text" name="pseudo" id="pseudo"><div></div>
            <div><label for"password">Mot de passe</label><input type="password" name="password" id="password"></div>
            <!-- <p>
                Fille<input type="radio" name="sexe" value="fille">
                Garçon<input type="radio" name="sexe" value="garcon">
            </p> -->
            <div class="bottom"><input type="submit" name="connexion_form">
         </form>';
         echo '<br /><br /><a href="register.php" class="linkform">Vous n\'avez pas encore de compte ? Inscription ici</a></div></div>';
    }


    if(!isset($_SESSION['id'])){

            if (isset($_POST['connexion_form'])){

                if ((!empty($_POST['pseudo'])) && (!empty($_POST['password']))) {
                    require_once 'config.php';    
                    $req = $pdo->prepare('SELECT * FROM users WHERE login = ? AND password = ?');
                    $req->execute(array($_POST['pseudo'], sha1($_POST['password'])));

                    $nb_rows = $req->rowCount();

                        if ($nb_rows > 0){
                            $data = $req->fetch();
                            if($data["ban"] != 1){
                                $_SESSION['id'] = $data['id'];
                                $_SESSION['pseudo'] = $data['login'];
                                $_SESSION['role'] = $data['role'];
                                session_write_close();
                                echo '<meta http-equiv="refresh" content="0; URL=index.php">';                                
                            }else{
                                 echo '<div class="error"><style> .form_wrapper_pseudo{margin-top: 30px}</style>* Vous avez été bannis du tchat.</div>';
                                 print_form_connect();
                            }

                        }
                        else{
                            echo '<div class="error"><style> .form_wrapper_pseudo{padding-top: 30px}</style>* Impossible de se connecter : informations incorrectes.</div>';
                            print_form_connect();
                        }
                }
                else{
                    echo '<div class="error"><style> .form_wrapper_pseudo{margin-top: 30px}</style>* Erreur : Tous les champs n\'ont pas été remplis.</div>';
                    print_form_connect();
                }
            }
            else{
               print_form_connect(); 
            }


    } else {
        ?>
        <div class="container">
            <div class="row col-xs-10">
                <div id="chat" class="chat"><p>  <img src="images/ajax-loader.gif" alt="patientez..."> LOADING...</p></div>
                <!-- Formulaire message -->
                <form action="#" class="message_form">
                    <div class="message_submit"><input type="text" name="text" id="champ" placeholder="Votre message">
                    <input type="submit" id="submit" value="Valider"></div>
                </form>
            </div>
            <div class="rooms row col-xs-2">
                <?php $result = $pdo->query("SELECT * FROM rooms");?>
                <ul>
                <li>Les salons:</li>
                <?php while($room = $result->fetch()){ ?>
                    <li><a class="room_color" href="<?php echo $room['room_id'] ?>"><?php echo $room['room_name'] ?></a></li>
                <?php }?>
                </ul>
                <?php if($_SESSION['role'] == "admin"){ ?>
                    <a class="admin_link" href="admin.php">Administer le chat</a>     
                <?php } ?>
            </div>
        </div>
    


    <!-- Code ne fonctionnant pas sans jQuery -->
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <script>
        var container = document.getElementById('chat');
        var room = 1;

        $('.rooms ul li a').on('click' , function(e){
            e.preventDefault();
            room = $(this).attr("href");
        });

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
                url      : 'receive.php?roomID='+room, // Url du script PHP qui va récupérer les messages
                dataType : 'json',        // Format json (objet)
                success  : function(res)  // Success (la requête à fonctionné)
                {
                    container.innerHTML = '';

                    // Boucle à travers les messages
                    for(var i = 0; i < res.messages.length; i++)
                    {

                        var sexe = res.messages[i].sexe;
                        if (sexe == "garcon") sexe = '<img src="images/men.png" width="18px" height="19px">';
                        else if (sexe == "fille") sexe = '<img src="images/women.png" width="18px" height="19px">';

                        // Affiche le message dans la console
                    container.innerHTML += '<div class="container_message"><span class="date">'+res.messages[i].date+'</span> <span class="sexe">' + sexe + '</span> <span class="pseudo">' + res.messages[i].pseudo + '</span> : <span class="message" style="background: #'+res.messages[i].background_color+'">' + res.messages[i].message + '</span></div>';  
                    }
                }
            });
        },1000);

        // On écoute l'événement submit du formulaire
        form.on('submit',function()
        {
            $.ajax({
                url     : 'send.php?roomID='+room,   // Url du script qui va rajouter le message à la base de données
                data    : 'message=' + input.val(), // On envoit le message dans les paramètres
                type    : 'POST',                   // Type POST (pas obligatoire)
                success : function(res)             // Success (la requête à fonctionné)
                {
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
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

</body>
</html>