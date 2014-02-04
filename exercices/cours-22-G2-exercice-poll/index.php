<?php 
    require 'config.php';

    // Toutes les valeurs
    $values = array(
        'bulbizarre' => 'Bulbizarre',
        'herbizarre' => 'Herbizarre',
        'florizarre' => 'Florizarre',
        'salameche'  => 'Salamèche',
        'reptincel'  => 'Reptincel',
        'dracaufeu'  => 'Dracaufeu',
        'carapuce'   => 'Carapuce',
        'carabaffe'  => 'Carabaffe',
        'tortank'    => 'Tortank',
    );

    // Si 'name' envoyé dans post, on insert une ligne dans la table votes
    if(!empty($_POST['name']))
        $exec = $pdo->exec('INSERT INTO votes (name) VALUES (\''.$_POST['name'].'\')');

    // Selection de tous les votes
    $query   = $pdo->query('SELECT * FROM votes');
    $votes   = $query->fetchAll();

    // Tableau qui contiendra les le nombre de résultat pour chaque pokemon
    $results = array();
    foreach($votes as $_vote)
    {
        // On récupère la colonne 'name'
        $name = $_vote['name'];

        // Si on le pokemon n'existe pas encore dans le tableau des résultats on le créé
        if(empty($results[$name]))
            $results[$name] = 0;

        // On l'incrémente
        $results[$name]++;
    }

    // Tri du tableau
    arsort($results);

    // Affichage pour debuger 
    echo '<pre>';
    print_r($results);
    echo '</pre>';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cours 22 - G2 - Exercice Poll</title>
</head>
<body>
    <form action="#" method="post">
        <?php foreach($values as $_key => $_value): ?>
            <input type="radio" name="name" value="<?php echo $_key; ?>" id="<?php echo $_key; ?>">
            <label for="<?php echo $_key; ?>"><?php echo $_value; ?></label>
        <?php endforeach; ?>
        <br /><input type="submit">
    </form>
</body>
</html>