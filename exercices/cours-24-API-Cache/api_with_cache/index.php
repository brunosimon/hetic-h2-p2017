<?php

require 'config.php';
require 'cache.class.php';

$cache = new Cache();


/**
 * GET CONTENT
 * Use URL what ever it is
 * The content is supposed to be json format
 */
function get_content($url)
{
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	$result = curl_exec($ch);
	curl_close($ch);

	return json_decode($result);
}

/**
 * GET FACEBOOK INFOS
 * Use public API https://graph.facebook.com/
 * Use get_content function above
 */
function get_facebook_infos($id)
{
	$url  = 'https://graph.facebook.com/';
	$data = array(
		'id' => $id
	);
	$url .= '?'.http_build_query($data);

	return get_content($url);
}

// Use the functions above to get infos
$error = '';
$user  = false;
if(!empty($_POST) && !empty($_POST['id']))
{
	$id  = $_POST['id'];
	$key = 'facebook_'.$id;

	if(!$infos = $cache->get($key))
	{
		echo 'Not from cache';
		$infos = get_facebook_infos($id);
		$cache->set($key,$infos);
	}
	else
	{
		echo 'From cache';
	}

	if(!empty($infos->error))
		$error = $infos->error->message;
	else
		$user = $infos;
}

	

?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Facebook infos</title>
</head>
<body>
	<form action="#" method="POST">
		<input type="text" name="id">
		<input type="submit" name="Search">
	</form>
	<?php 
		if(!empty($error))
			echo 'Une erreur s\'est produite, voici le message :<br />'.$error;
	?>
	<?php if($user): ?>
		On l'a trouvé
		<br />Matricule : <?php echo $user->id; ?>
		<br />Nom : <?php echo $user->last_name; ?>
		<br />Prénom : <?php echo $user->first_name; ?>
		<br />Pseudo : <?php echo $user->username; ?>
	<?php endif; ?>
</body>
</html>