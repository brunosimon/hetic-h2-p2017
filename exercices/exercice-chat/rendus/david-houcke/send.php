
<?php

include('config.php');

if(!empty($_POST))
{
    $req = $pdo->prepare("INSERT INTO messages VALUES (NULL, :pseudo, :message, '".time()."')");
    $req->bindParam(':message',$_POST['message']);
    $req->bindParam(':pseudo',$_POST['pseudo']);
    $res = $req->execute();
}