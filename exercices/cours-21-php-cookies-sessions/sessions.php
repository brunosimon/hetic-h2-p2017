<?php 

    session_start();

    if(!empty($_POST))
    {
        $user = array(
            'login'    => $_POST['login'],
            'password' => $_POST['password'],
            'role'     => $_POST['role'],
        );

        $_SESSION['user'] = $user;
    }

    else
    {
        if(!empty($_SESSION))
        {
            $user = $_SESSION['user'];
        }
    }

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cours 21 - Sessions</title>
</head>
<body>
    <?php 
        if(!empty($user)) 
            echo 'Vous êtes connecté en tant que '.$user['login'].' ('.$user['role'].')';
    ?>
    <form action="#" method="POST">
        <div>
            <input type="text" name="login" id="login" />
            <label for="login">Login</label>
        </div>
        <div>
            <input type="text" name="password" id="password" />
            <label for="password">Password</label>
        </div>
        <div>
            <input type="radio" name="role" id="role-admin" value="admin" />
            <label for="role-admin">Admin</label>
        </div>
        <div>
            <input type="radio" name="role" id="role-visitor" value="visitor" />
            <label for="role-visitor">Visitor</label>
        </div>
        <div>
            <input type="submit" value="Connect" />
        </div>
    </form>
</body>
</html>