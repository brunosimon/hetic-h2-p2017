<?php 
	
	// Affichage des erreurs
	error_reporting(E_ALL); 
	ini_set("display_errors", 1);

	// Connection à la bdd
	define('DB_HOST','localhost');
	define('DB_USER','root');
	define('DB_PASS','root');
	define('DB_NAME','exercice-chat-meyer-carrot');

	try
	{
	    $pdo = new PDO('mysql:dbname='.DB_NAME.';host='.DB_HOST,DB_USER,DB_PASS);
	    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_NAMED);

	}
	catch (PDOException $e)
	{
	    die('error');
	}

	// Smiley init
	function Smilify($subject)
{
    $smilies = array(
        ':|'  => 'mellow',
        ':-|' => 'mellow',
        ':-o' => 'ohmy',
        ':-O' => 'ohmy',
        ':o'  => 'ohmy',
        ':O'  => 'ohmy',
        ';)'  => 'wink',
        ';-)' => 'wink',
        ':p'  => 'tongue',
        ':-p' => 'tongue',
        ':P'  => 'tongue',
        ':-P' => 'tongue',
        ':D'  => 'biggrin',
        ':-D' => 'biggrin',
        '8)'  => 'cool',
        '8-)' => 'cool',
        ':)'  => 'smile',
        ':-)' => 'smile',
        ':('  => 'sad',
        ':-(' => 'sad',
    );

    $sizes = array(
        'biggrin' => 18,
        'cool' => 18,
        'haha' => 18,
        'mellow' => 18,
        'ohmy' => 18,
        'sad' => 18,
        'smile' => 18,
        'tongue' => 18,
        'wink' => 18,
    );

    $replace = array();
    foreach ($smilies as $smiley => $imgName)
    {
        $size = $sizes[$imgName];
        array_push($replace, '<img src="style/img/smilies/'.$imgName.'.gif" alt="'.$smiley.'" width="'.$size.'" height="'.$size.'" />');
    }
    $subject = str_replace(array_keys($smilies), $replace, $subject);

    return $subject;
}

?>