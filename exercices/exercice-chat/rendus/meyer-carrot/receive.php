<?php
    include('config.php');

$req = $pdo->prepare("SELECT * FROM messages WHERE room=:room ORDER BY date DESC LIMIT 20"); 
$req->bindParam(':room',$_POST['room']);
$req->execute();

$res = array_reverse($req->fetchAll());

foreach($res as $data){
    echo  "<div id='message-container'><span id='creator'>".$data['pseudo']."</span></br> <span id='message-chat'>".Smilify($data['message'])."</span> <span id='creation-date'>".$data['date']."</span></div><br/>";
}
?>