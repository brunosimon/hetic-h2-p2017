<?php
    include('config.php');

$req = $pdo->prepare("SELECT * FROM messages ORDER BY date");
$req->execute();

$res = $req->fetchAll();

foreach($res as $data){
    echo $data['pseudo']." : ".$data['message']."<br/>";
}
