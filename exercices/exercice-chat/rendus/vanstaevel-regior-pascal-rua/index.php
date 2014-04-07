<?php 
    require_once 'require/config.php';
    require_once 'require/verif_login.php';
?>
<!DOCTYPE html>

<html>
<head>
    <title>Welcome on myChat !</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <!-- Bootstrap -->
    <link href="src/css/bootstrap.min.css" media="screen" rel="stylesheet">
    <link href="src/css/maincss.css" media="screen" rel="stylesheet">
</head>

<body>
    <header>
        <div class="navbar navbar-inverse">
            <div class="navbar-inner">
                <a class="brand" href="index.php">Welcome on myChat !</a>
            </div>
        </div>
    </header>

    <div class="container">
        <form class="form-signin" action="index.php" method="post">
            <h2 class="form-signin-heading">Please log !</h2>
            <div class="input-prepend">
                <span class="add-on">@login</span>
                <input type="text" name="login" id="prependedInput" value="<?php echo $login_save; ?>">
            </div>
            <div class="input-prepend">
              <span class="add-on">password</span>
              <input type="password" name="password" id="prependedInput">
            </div>

            <!-- display errors -->
            <?php if(!empty($errors)): ?>
              <div class="errors">
                <?php foreach($errors as $_error): ?>
                  <p>
                    <?php echo $_error; ?>
                  </p>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>

            <button type="submit" class="btn btn-primary">
              Go to the chat !
            </button>
            <a href="register.php">Sign In</a>
        </form>
    </div>

    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="src/js/bootstrap.min.js"></script>
</body>
</html>