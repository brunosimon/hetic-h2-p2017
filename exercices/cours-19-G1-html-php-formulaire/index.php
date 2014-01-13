<?php require_once 'form.php'; ?>
<html>
<head>
    <title>Cours 19 - G2 - HTML / PHP Formulaire</title>
</head>
<body>
    <form action="#" method="post">
        <fieldset>
            <legend>Register</legend>

            <div>
                <input value="<?php echo $data['login'] ?>" type="text" name="login" id="login" placeholder="Your login">
                <label for="login">Login</label>
            </div>
            <div>
                <input value="<?php echo $data['password'] ?>" type="password" name="password" id="password" placeholder="Your password">
                <label for="password">Password</label>
            </div>
            <div>
                <input value="<?php echo $data['email'] ?>" type="email" name="email" id="email" placeholder="Your email">
                <label for="email">Email</label>
            </div>
            <div>
                <input value="<?php echo $data['age'] ?>" type="number" name="age" id="age" placeholder="Your age" max="120" min="1">
                <label for="age">Age</label>
            </div>
            <div>
                <input type="submit" name="submit" value="Register">
            </div>
        </fieldset>
    </form>
</body>
</html>





