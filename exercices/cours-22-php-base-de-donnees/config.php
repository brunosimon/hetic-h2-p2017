<?php 

define('DB_HOST','localhost');
define('DB_USER','hetic-P2017');
define('DB_PASS','azerty');
define('DB_NAME','hetic-P2017-first');

// Old school
// $db = mysql_connect(DB_HOST,DB_USER,DB_PASS);
// mysql_select_db(DB_NAME);
// var_dump($db);

// New style
try
{
    $pdo = new PDO('mysql:dbname='.DB_NAME.';host='.DB_HOST,DB_USER,DB_PASS);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_NAMED);
}
catch (PDOException $e)
{
    die('error');
}

// Exec
// $result = $pdo->exec('INSERT INTO users (login,password,email,age) VALUES (\'bruno\',\'azerty\',\'bruno@simon.com\',24)');
// $result = $pdo->exec('UPDATE users SET login = \'toto\' WHERE id = 2');

// Query avec fetchAll()
// $result = $pdo->query('SELECT * FROM users');
// $users  = $result->fetchAll();
// echo '<pre>';
// print_r($users);
// echo '</pre>';

// Query avec fetch()
// $result = $pdo->query('SELECT * FROM users');
// while($user = $result->fetch())
// {
//     echo '<pre>';
//     print_r($user);
//     echo '</pre>';
// }