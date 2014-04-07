<?php 
    include 'head.php';
?>

    <!-- Notre formulaire -->
    <div class="background">
        <div class="container">
            <div class="inscription">
                <div class="col-xs-offset-3 col-lg-offset-9 col-xs-8 col-md-8 col-lg-8">
                <h1>Inscription</h1>
                </div>
                    <form action="send.php" method="POST" >
                        <div class="form-group col-xs-offset-2 col-lg-offset-7 col-xs-8 col-md-8 col-lg-8">
                            <input type="text" class="form-control" name="login" id="login" placeholder="Login" required autofocus>
                        </div>
                        <div class="form-group col-xs-offset-2 col-lg-offset-7 col-xs-8 col-md-8 col-lg-8">
                            <input type="password" class="form-control" name="password-1" id="password-1" placeholder="Mot de passe" required autofocus>
                        </div>
                        <div class="form-group col-xs-offset-2 col-lg-offset-7 col-xs-8 col-md-8 col-lg-8">
                            <input type="password" class="form-control" name="password-2" id="password-2" placeholder="Confirmer mot de passe" required autofocus>
                            <input type="submit" class="sendMessage btn btn-primary col-xs-12 col-md-12 col-lg-12">
                        </div>
                    </form>
            </div>
        </div>
    </div>

    <!-- Code ne fonctionnant pas sans jQuery -->

<?php
include 'footer.php';
?>
