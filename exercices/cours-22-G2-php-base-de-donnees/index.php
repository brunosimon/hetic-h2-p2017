<?php

    /**
     * TODO
     *  - Reminder
     *  - Add inputs
     *  - List all users
     *  - Delete user
     *  - Edit user
     *  - Password storing
     */
    require_once 'config.php';
    require_once 'form.php';

    $query = $pdo->query('SELECT * FROM users');
    $users = $query->fetchAll();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cours 19 - G2 - Formulaire</title>
    <style>
        .errors {border:1px solid #f00;color:#f00;padding:0 16px;}
        .successes {border:1px solid #0f0;color:#0f0;padding:0 16px;}
        input.error {border:1px solid #f00;color:#f00;}

        table {border:1px solid #ccc;}
        table td,table th {border:1px solid #ccc;padding:10px 20px;text-align:left;}
    </style>
</head>
<body>

    <!-- ERRORS -->
    <?php if(!empty($errors)): ?>
        <div class="errors">
            <?php foreach($errors as $_error): ?>
                <p>
                    <?php echo $_error; ?>
                </p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <!-- SUCCESS -->
    <?php if(!empty($success)): ?>
        <div class="successes">
            <?php foreach($success as $_success): ?>
                <p>
                    <?php echo $_success; ?>
                </p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form action="#" method="post">
        <input type="hidden" name="action" value="add">
        <fieldset>
            <legend>Registration</legend>

            <div>
                <input class="<?php echo array_key_exists('login',$errors) ? 'error' : ''; ?>" type="text" name="login" id="login" placeholder="My login" value="<?php echo $data['login']; ?>">
                <label for="login">Login</label>
            </div>

            <div>
                <input class="<?php echo array_key_exists('email',$errors) ? 'error' : ''; ?>" type="text" name="email" id="email" placeholder="My email" value="<?php echo $data['email']; ?>">
                <label for="email">Email</label>
            </div>

            <div>
                <input class="<?php echo array_key_exists('password',$errors) ? 'error' : ''; ?>" type="password" name="password" id="password" placeholder="My password" value="<?php echo $data['password']; ?>">
                <label for="password">Password</label>
            </div>

            <div>
                <input class="<?php echo array_key_exists('age',$errors) ? 'error' : ''; ?>" type="number" name="age" id="age" placeholder="My age" min="1" max="120" value="<?php echo $data['age']; ?>">
                <label for="age">Age</label>
            </div>

            <div>
                <input type="submit" value="Register">
            </div>
        </fieldset>
    </form>

    <table>
        <tr>
            <th>ID</th>
            <th>Login</th>
            <th>Email</th>
            <th>Age</th>
            <th>Actions</th>
        </tr>

        <?php foreach($users as $_user): ?>
            <tr>
                <td><?php echo $_user['id'] ?></td>
                <td><?php echo $_user['login'] ?></td>
                <td><?php echo $_user['email'] ?></td>
                <td><?php echo $_user['age'] ?></td>
                <td>
                    <form action="#" method="POST">
                        <input type="hidden" name="id" value="<?php echo $_user['id'] ?>">
                        <input type="hidden" name="action" value="delete">
                        <input type="submit" value="Supprimer">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    

</body>
</html>












