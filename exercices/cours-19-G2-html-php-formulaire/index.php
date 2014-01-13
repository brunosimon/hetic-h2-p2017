<?php 
    require_once 'form.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cours 19 - G2 - Formulaire</title>
</head>
<body>
    <form action="#" method="post">
        <fieldset>
            <legend>Registration</legend>

            <div>
                <input type="text" name="login" id="login" placeholder="My login" value="<?php echo $data['login']; ?>">
                <label for="login">Login</label>
            </div>

            <div>
                <input type="email" name="email" id="email" placeholder="My email" value="<?php echo $data['email']; ?>">
                <label for="email">Email</label>
            </div>

            <div>
                <input type="password" name="password" id="password" placeholder="My password" value="<?php echo $data['password']; ?>">
                <label for="password">Password</label>
            </div>

            <div>
                <input type="number" name="age" id="age" placeholder="My age" min="1" max="120" value="<?php echo $data['age']; ?>">
                <label for="age">Age</label>
            </div>

            <div>
                <input type="submit" value="Register">
            </div>
        </fieldset>
    </form>
</body>
</html>