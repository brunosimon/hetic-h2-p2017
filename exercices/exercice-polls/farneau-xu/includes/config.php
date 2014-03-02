<?php

ini_set('display_errors', 1);

// Twitter API
require_once('TwitterAPIExchange.php');
$settings = array(
    'oauth_access_token' => "",
    'oauth_access_token_secret' => "",
    'consumer_key' => "zY1qwQaV6OYeyWDuf6GJbw",
    'consumer_secret' => "HvYTR0GNjPn2X4n5INItrnCdx2iYiohMmwzMJVw1A"
);

// MySQL connecy
try {
	// Database
	$host = 'mysql:host=localhost;dbname=exercice-poll-farneau-xu';
	$user = 'root';
	$password = 'root';
	$db = new PDO($host,$user,$password);
} catch ( Exception $e ) {
	echo "Connection à MySQL impossible : ", $e->getMessage();
  die();
}

$vote_types = array('wtf','choc','lol','win','fail','cute','hot');

// Function to render the tweet
function render_tweet($id,$profile_image_url,$name,$text,$counts,$date){
	$html = "<img src='".$profile_image_url."' alt='Profile picture' class='profile'/><blockquote class='tweet' data-id=".$id.">";
	$html .= "<p>".$text."</p><small>@".$name."</small><hr/>";
	$html .= "<p class='choices'>".$counts."</p>";

	if($date == 0){
		$html.="<small>Aucun avis enregistré pour ce tweet ... Votez !</small>";
	}else{
		$html.="<small>Dernier avis donné le ".date("m/d/y \à H\hi",$date)."</small>";
	}

	$html .= "</blockquote>";
	return $html;
}

?>