<?php 
    
    require_once 'config.php';

    $values = array(
        'bulbizarre' => 'Bulbizarre',
        'herbizarre' => 'Herbizarre',
        'florizarre' => 'Florizarre',
        'salamèche'  => 'Salamèche',
        'reptincel'  => 'Reptincel',
        'dracaufeu'  => 'Dracaufeu',
        'carapuce'   => 'Carapuce',
        'carabaffe'  => 'Carabaffe',
    );

    if(!empty($_POST))
    {
        if(!empty($_POST['name']) && array_key_exists($_POST['name'],$values))
            $exec = $pdo->exec('INSERT INTO votes (name) VALUES (\''.$_POST['name'].'\')');
    }

    $query = $pdo->query('SELECT * FROM votes');
    $votes = $query->fetchAll();

    $results = array();
    foreach($votes as $_vote)
    {
        if(empty($results[$_vote['name']]))
            $results[$_vote['name']] = 0;

        $results[$_vote['name']]++;
    }

    arsort($results);

?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cours 22 - Exercice Poll</title>
    <style>
    </style>
</head>
<body>
    <p>Votez pour votre pokemon préféré</p>
    <form action="#" method="post">
        <?php foreach($values as $_key => $_value): ?>
            <div>
                <input type="radio" name="name" id="<?php echo $_key ?>" value="<?php echo $_key ?>" />
                <label for="<?php echo $_key ?>"><?php echo $_value ?></label>
            </div>
        <?php endforeach; ?>
        <input type="submit" />
    </form>
    <p>Résultats</p>
    <?php foreach($results as $_key => $_result): ?>
        <div><?php echo $values[$_key] ?> : <?php echo $_result; ?></div>
    <?php endforeach; ?>
</body>
</html>





