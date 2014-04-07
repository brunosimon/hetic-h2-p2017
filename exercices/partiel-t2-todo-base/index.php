<?php 
    require 'config.php';

    if(isset($pdo))
        require 'handle.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Todo</title>
</head>
<body>

    <div class="main">
        
        <h1>Todo</h1>
        
        <div class="todo">
            
            <div class="top-border"></div>

            <div class="add">
                <form action="#" method="GET">
                    <input type="hidden" name="action" value="send">
                    <input type="submit" value="envoyer">
                    <input type="text" name="text" placeholder="Rien n'est fait tant qu'il reste à faire">
                </form>
            </div>

            <div class="list">
                <div class="item">
                    <a href="?action=do&id=1">[ ]</a> <a href="?action=delete&id=1" class="delete">supprimer</a> Répondre aux questions 
                </div>
                <div class="item">
                    <a href="?action=undo&id=2">[ ]</a> <a href="?action=delete&id=2" class="delete">supprimer</a> Terminer l'intégration
                </div>
                <div class="item">
                    <a href="?action=undo&id=2">[x]</a> <a href="?action=delete&id=2" class="delete">supprimer</a> Terminer le PHP
                </div>
                <div class="item">
                    <a href="?action=undo&id=2">[x]</a> <a href="?action=delete&id=2" class="delete">supprimer</a> Rendre le partiel
                </div>
                <div class="item">
                    <a href="?action=undo&id=2">[x]</a> <a href="?action=delete&id=2" class="delete">supprimer</a> Fêter la fin des partiels
                </div>
            </div>
            <div class="infos">3 restants</div>
        </div>
    </div>
</body>
</html>