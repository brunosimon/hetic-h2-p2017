<?php
    require 'config.php';

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

    if(!empty($_POST))
    {
        if(!empty($_POST['name']))
        {
            $pdo->exec('INSERT INTO votes (name) VALUES (\''.$_POST['name'].'\')');
        }
    }

    $results = array();
    $query   = $pdo->query('SELECT * FROM votes');
    $votes   = $query->fetchAll();

    foreach($votes as $_vote)
    {
        if(empty($results[$_vote['name']]))
            $results[$_vote['name']] = 0;

        $results[$_vote['name']]++;
    }

    arsort($results);

    echo '<pre>';
    print_r($results);
    echo '</pre>';

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Poll</title>
</head>
<body>
    <form action="#" method="post">
        <?php foreach($values as $_key => $_value): ?>
            <input type="radio" name="name" value="<?php echo $_key ?>" id="<?php echo $_key ?>">
            <label for="<?php echo $_key ?>"><?php echo $_value ?></label>
        <?php endforeach; ?>
        <br /><input type="submit">
    </form>
</body>
</html>















