<?php 

// Test s'il y a des données envoyée en POST
if(!empty($_POST))
{
    // Gérer la sauvegarde du message ici
    // Profitez-en pour vous assurer que le message est bien formaté
    die('message : '.$_POST['message']);
}
