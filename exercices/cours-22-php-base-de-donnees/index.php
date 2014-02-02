<?php 

    /**
     * TODO
     *  - Edit user
     */
    
    require_once 'config.php'; 
    require_once 'form.php';

    if(!empty($_GET['action']) && $_GET['action'] === 'delete' && !empty($_GET['id']) && (int)$_GET['id'] > 0)
    {
        $id   = (int)$_GET['id'];
        $exec = $pdo->exec('DELETE FROM users WHERE id = '.$id);

        if($exec == 0)
            $errors[] = 'No user deleted';
        else
            $success[] = 'User deleted';
    }

    $query = $pdo->query('SELECT * FROM users');
    $users = $query->fetchAll();
?>
<html>
<head>
    <title>Cours 19 - G2 - HTML / PHP Formulaire</title>
    <style>
        .errors {border:1px solid #f00;padding:0 20px;color:#f00;}
        .success {border:1px solid #0b0;padding:0 20px;color:#0b0;}
        input.error {border:1px solid #f00;color:#f00;}
        table {border:1px solid #ccc;}
        table td,table th {border:1px solid #ccc;padding:10px 20px;text-align:left;}
    </style>
</head>
<body>

    <?php if(!empty($errors)): ?>
        <div class="errors">
            <?php foreach($errors as $_error): ?>
                <p class="error">
                    <?php echo $_error; ?>
                </p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if(!empty($success)): ?>
        <div class="success">
            <?php foreach($success as $_message): ?>
                <p class="error">
                    <?php echo $_message; ?>
                </p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form action="#" method="post">
        <fieldset>
            <legend>Register</legend>

            <div>
                <input class="<?php echo array_key_exists('login',$errors) ? 'error' : ''; ?>" value="<?php echo $data['login'] ?>" type="text" name="login" id="login" placeholder="Your login">
                <label for="login">Login</label>
            </div>
            <div>
                <input class="<?php echo array_key_exists('password',$errors) ? 'error' : ''; ?>" value="<?php echo $data['password'] ?>" type="password" name="password" id="password" placeholder="Your password">
                <label for="password">Password</label>
            </div>
            <div>
                <input class="<?php echo array_key_exists('email',$errors) ? 'error' : ''; ?>" value="<?php echo $data['email'] ?>" type="text" name="email" id="email" placeholder="Your email">
                <label for="email">Email</label>
            </div>
            <div>
                <input class="<?php echo array_key_exists('age',$errors) ? 'error' : ''; ?>" value="<?php echo $data['age'] ?>" type="number" name="age" id="age" placeholder="Your age" max="120" min="1">
                <label for="age">Age</label>
            </div>
            <div>
                <input type="submit" name="submit" value="Register">
            </div>
        </fieldset>
    </form>

    <table cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Login</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        <?php foreach($users as $_user): ?>
            <tr>
                <td><?php echo $_user['id'] ?></td>
                <td><?php echo $_user['login'] ?></td>
                <td><?php echo $_user['email'] ?></td>
                <td><a href="?action=delete&amp;id=<?php echo $_user['id'] ?>">Delete</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>





