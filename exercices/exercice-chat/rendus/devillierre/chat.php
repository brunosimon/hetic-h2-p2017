<?php
header("Content-Type: text/html; charset=iso-8859-1");
mysql_connect("localhost", "root", "root");
mysql_select_db("exercice-chat-devillierre");

if (isset($_POST['pseudo']) && isset($_POST['message'])) 
{
    if (!empty($_POST['pseudo']) && !empty($_POST['message'])) 
    {
	$message = mysql_real_escape_string(utf8_decode($_POST['message']));
        $pseudo = mysql_real_escape_string(utf8_decode($_POST['pseudo']));
        mysql_query("INSERT INTO chat(pseudo,message,timestamp) VALUES('$pseudo', '$message', '".time()."')");
    }
}
$reponse = mysql_query("SELECT * FROM chat ORDER BY id DESC LIMIT 0,10");
while($val = mysql_fetch_array($reponse))
{
	echo '<p><strong">'.htmlentities(stripslashes($val['pseudo'])).'</strong> à '.date('H\:i\:s',$val['timestamp']).' : '. htmlentities(stripslashes($val['message'])) .'</p>';
}
mysql_close();
?>