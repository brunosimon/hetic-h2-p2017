<?php
    if($_POST['action'] == 'register'){

        $result = $pdo->query("SELECT * FROM users WHERE login = '".addslashes(htmlentities($_POST['pseudo']))."' LIMIT 1");
        $user = $result->fetch();

        if (isset($user['id'])){
            $error = "Un utilisateur porte déjà ce pseudo !";
        } else {
            if ($_POST['password'] == $_POST['password_confirm']){
                $password = hash('sha256', 'LeuPhpCBi1'.$_POST['password'].'lolXD');
                $result = $pdo->exec("INSERT INTO users (login, password) VALUES ('".addslashes(htmlentities($_POST['pseudo']))."', '".$password."')");

                $result = $pdo->query("SELECT * FROM users WHERE login = '".addslashes(htmlentities($_POST['pseudo']))."' LIMIT 1");
                $user = $result->fetch();

                if (isset($user['id'])){
                    $_SESSION['id'] = $user['id'];
                } else {
                    $error = "Erreur lors de la création du compte.";
                }
            } else {
                $error = "Les mots de passe ne correspondent pas";
            }
        }

    }

    if($_POST['action'] == 'connect'){

        $result = $pdo->query("SELECT * FROM users WHERE login = '".addslashes(htmlentities($_POST['pseudo']))."' LIMIT 1");
        $user = $result->fetch();

        if (!isset($user['id'])){
            $error = "Utilisateur inconnu.";
        } else {
            if (hash('sha256', 'LeuPhpCBi1'.$_POST['password'].'lolXD') == $user['password']){
                $_SESSION['id'] = $user['id'];
            } else {
                $error = "Mot de passe incorrect.";
            }
        }

    }

    if (isset($error)){
?>
<div class="home_header">
    <h1>Quizzy</h1>
    <h2>Le quiz 100% multijoueurs !</h2>
</div>
<div class="home_container">
    <h3><?php echo $error; ?></h3>
    <form class="home_form" action="#" method="POST">
        <input class="home_input" type="text" name="pseudo" placeholder="Pseudo"/>
        <input class="home_input" type="password" name="password" placeholder="Mot de passe"/>
        <input class="home_input" type="password" name="password_confirm" placeholder="Répétez le mot de passe" id="home_repeat"/>
        <input class="home_submit" type="submit" name="submit" value="C'est parti ! " id="home_submit"/>
        <input type="hidden" value="register" name="action" id="actions"/>
    </form>
    <a href="#" id="home_already">J'ai déjà un compte</a>
</div>
<script src="src/js/home_script.js"></script>
<?php
    } else {
        header('Location: #'); 
    }
?>