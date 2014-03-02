<?php
     /*Connexion BDD*/
      try
        {
            $bdd = new PDO('mysql:host=localhost;dbname=exercice-poll-domercq-glable','root','root');
        }
        catch (PDOException $e)
        {
            die('error');
        }
?>