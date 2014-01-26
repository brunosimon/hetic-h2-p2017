<?php 
    require_once 'form.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cours 19 - G2 - Formulaire</title>
    <style>
        .errors {border:1px solid #f00;color:#f00;padding:0 16px;}
        input.error {border:1px solid #f00;color:#f00;}
    </style>
</head>
<body>

    <?php if(!empty($errors)): ?>
        <div class="errors">
            <?php foreach($errors as $_error): ?>
                <p>
                    <?php echo $_error; ?>
                </p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form action="#" method="post">
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
</body>
</html>