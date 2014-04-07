<?php
  if(!empty($_POST['name'])){
    $_SESSION['login'] = $_POST['name'];
    echo '<meta http-equiv="refresh" content="0; URL=index.php?page=chat">';
  }
?> 
<link rel="stylesheet" href="assets/css/login.css">
<div class="container">
  <form class="form-signin" name="login" method="POST" action="#">
    <h2 class="form-signin-heading">Your Name</h2>
    <input type="text" class="input-block-level" placeholder="Your Name" name="name">
    <button class="btn btn-large btn-primary" type="submit">Enter</button>
  </form>
</div>