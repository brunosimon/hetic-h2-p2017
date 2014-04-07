<?php
include('config.php');

if(!empty($_POST))
{
    $req = $pdo->prepare("INSERT INTO messages VALUES (NULL, :pseudo, :message, :room, NOW())");
    $req->bindParam(':message',$_POST['message']);
    $req->bindParam(':pseudo',$_POST['pseudo']);
    $req->bindParam(':room',$_POST['room']);
    $res = $req->execute();
}