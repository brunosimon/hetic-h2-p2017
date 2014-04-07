<?php
    require('data/config.php');

    include('includes/meta.inc.php');
    include('includes/header.inc.php');

    if(!empty($_GET['page'])){
        switch ($_GET['page']){
            case 'accueil':
                include('pages/accueil.php');
                break;
            case 'room':
                include('pages/room.php');
                break;
            default:
                include('pages/accueil.php');
                break;
        }
    }else{
        include('pages/accueil.php');
    }

    include('includes/footer.inc.php');
?>