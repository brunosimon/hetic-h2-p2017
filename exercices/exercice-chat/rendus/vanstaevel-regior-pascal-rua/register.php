<?php 
    require_once 'require/config.php';
    require_once 'require/verif_register.php';
?>
<!DOCTYPE html>

<html>
<head>
  <title>Welcome on myChat !</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap -->
  <link href="src/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="src/css/maincss.css" rel="stylesheet" media="screen">
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
    <form class="form-signin" action="#" method="post">
      <h2 class="form-signin-heading">Please register !</h2>

      <div class="input-prepend">
        <span class="add-on">@login</span>
        <input class="span2" type="text" name="login" id="login" value="<?php echo $login_save; ?>">
      </div>

      <div class="input-prepend">
        <span class="add-on">password</span>
        <input class="span2" type="password" name="password" id="prependedInput" >
      </div>

      <div class="input-prepend">
        <span class="add-on">password confirm</span>
        <input class="span2" type="password" name="password_confirm" id="prependedInput">
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

      <a href="index.php"> Log In </a>
    </form>
  </div>

  <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
  <script src="src/js/bootstrap.min.js"></script>
</body>
</html>