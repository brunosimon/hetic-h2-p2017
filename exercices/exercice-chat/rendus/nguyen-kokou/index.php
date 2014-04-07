<?php
    require('includes/config.php');
    include('includes/meta.inc.php');

    if(isset($_GET['page'])){
        if($_GET['page'] == 'accueil'){
            if(!isset($_SESSION['login'])){
                include('includes/login.page.php');
            }
            else{
                include('includes/chat.page.php');
            } 
        }
        else if ($_GET['page'] == 'chat'){
            include('includes/chat.page.php');
        }
        else{
            include('includes/404.page.php');
        }
    }   
    else{
        include('includes/login.page.php');
    }

    include('includes/footer.inc.php');
?>