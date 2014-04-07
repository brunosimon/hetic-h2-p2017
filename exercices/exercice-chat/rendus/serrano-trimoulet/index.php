<?php
    include('data/php/config.php');
    include('data/php/header.inc.php');

    if(isset($_GET['page'])){
        $page = $_GET['page'];
        if($page == 'accueil'){
            include('data/php/accueil.page.php');
        }
        else if($page == 'chat'){
            include('data/php/chat.page.php');
        }
        else{
            include('data/php/accueil.page.php');
        }
    }
    else{
        include('data/php/accueil.page.php');
    }

    include('data/php/footer.inc.php');
?>