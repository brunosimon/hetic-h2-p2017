<?php

    include("head.php");

    $errors = array();
    $success = array();

     ?>

    <div id="titre">
        <h1>Le Chat de Solène et Héloïse</h1>
    </div>

    <?php

    echo '<div class="form_wrapper">
            <div id="container">
                <h3>Inscription</h3>
            </div>';

    function print_form_register($data){
    
        echo '<form action="#" method="POST">
                <div class="error_form"><label for"pseudo"></label><input type="text" name="pseudo" placeholder="Pseudo" value ="'.$data['pseudo'].'"></div>
                <label for"password"></label><input type="password" name="password" placeholder="Mot de passe" value ="'.$data['password'].'">
                <label for"password"></label><input type="password" name="password_repeat" placeholder="Confirmez" value ="'.$data['password_repeat'].'">
                 <p class="malefemale">
                    <img src="images/women.png" width="30px" height="31px"><input type="radio" name="sexe" value="fille">
                    <img src="images/men.png" width="30px" height="31px"><input type="radio" name="sexe" value="garcon">
                </p>

                <p class="color_text"> Couleur de texte : </p>
                <ul class="colors">
                    <li><a class="color active" href="#" style="background-color: #1abc9c"> </a> </li>
                    <li><a class="color" href="#" style="background-color: #3498db" data="3498db"> </a> </li>
                    <li><a class="color" href="#" style="background-color: #9b59b6" data="9b59b6"> </a> </li>
                    <li><a class="color" href="#" style="background-color: #e74c3c" data="e74c3c"> </a> </li>
                    <li><a class="color" href="#" style="background-color: #f39c12" data="f39c12"> </a> </li>
                    <li><a class="color" href="#" style="background-color: #95a5a6" data="95a5a6"> </a> </li>
                </ul>

                <div class="color_number"><input id="color" type="text" name="color" value="#1abc9c"/></div>
                <div class="bottom"><input class="btn valid" type="submit" name="form_inscription" value="Inscription" />
            </form>
            <a href="index.php"><span class="or">ou</span>
            Connexion</a>
            </div></div>';
    }

    function clean_data($data){
        $data['password'] = strip_tags(trim($data['password']));
        $data['pseudo'] = strip_tags(trim($data['pseudo']));
        $data['sexe'] = strip_tags(trim($data['sexe']));
        $data['color'] = strip_tags(trim($data['color']));

        return $data;
    }

    function check_data($data){

        $errors = array();

        if (empty($data['pseudo']))
            $errors['first_name'] = '<div class="error_register">* Erreur : vous devez remplir le champ "Prénom".</div>';

        if (empty($data['sexe']))
            $errors['sexe'] = '<div class="error_register">* Erreur : veuillez choisir votre sexe.</div>';
/*      	else if ($data['sexe'] == "fille" OR $data['sexe'] == "garcon")
            $errors['no_sexe'] = 'Erreur : Vous n\'avez pas de sexe !';*/

        if (empty($data['password']))
            $errors['password'] = '<div class="error_register">* Erreur : vous devez remplir le champ "Mot de passe".</div>';
        else if(strlen($data['password']) < 3)
            $errors['password'] = '<div class="error_register">* Erreur : Votre mot de passe doit au moins contenir 3 caractères.</div>';
        else if(strlen($data['password']) > 30)
            $errors['password'] = '<div class="error_register">* Erreur : Votre mot de passe ne doit pas contenir plus de 30 caractères.</div>';

        if ($data['password'] != $data['password_repeat'])
            $errors['password'] = '<div class="error_register">* Erreur : les deux mots de passe ne sont pas identiques.</div>';

        return $errors;

    }

    if(isset($_SESSION['auth']) && $_SESSION['auth'] == true){
        header('Location:index.php');
    }
    else{

        if (!empty($_POST['form_inscription'])){

            $data = clean_data($_POST);
            $errors = check_data($data);

            require_once 'config.php';

            $req = $pdo->prepare('SELECT * FROM users WHERE pseudo = ?');
            $req->execute(array($data['pseudo']));
            $nb_rows = $req->rowCount();

            if ($nb_rows > 0) $errors['pseudo_used'] = 'Erreur : Pseudo déjà utilisé.';

            if (empty($errors)){    
                      
                $password = sha1($data['password']);
                $pseudo = $data['pseudo'];
                $sexe = $data['sexe'];
                $color = $data['color'];


                $req = 'INSERT INTO users (login,password,sexe, color, role) VALUES (:login, :password, :sexe, :color, :role)';
                $insert = $pdo->prepare($req);
                $insert->execute(array('login' => $pseudo, 'password' => $password, 'sexe' => $sexe, 'color' => $color, 'role' => "user"));

                echo '<article class="success">
                    Inscription réussie ! <br />
                    Cliquez <a href="index.php">ici</a> pour vous connecter.
                    </article>';
            }
            else{
                //Afficher erreurs
                echo '<article class="errors">';

                foreach ($errors as $_errors){
                    echo '<p class="error">'.$_errors.'</p>';
                }
                echo '</article>';
                print_form_register($data);
            }

        }
        else{

            $data = array(
                'password' => '',
                'password_repeat' => '',
                'pseudo' => '',
                'sexe' => '',
                'color' => '',
            );

                print_form_register($data);
            }
    }
?>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
