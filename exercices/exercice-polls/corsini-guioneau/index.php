<?php

	require_once 'PHP/config.php';
	require_once 'PHP/form.php';

	/* _____ ERRORS _____ */
	if(!empty($errors)):
		echo('<div class="errors">');
			foreach($errors as $_error):
				echo("<p>");
					echo $_error;
				echo("</p>");
			endforeach;
		echo("</div>");
	endif;

	/* _____ SUCCESS _____ */
	if(empty($don_log) && empty($don_em)){

		if(!empty($success)):

			error_reporting(E_ALL);
			ini_set("display_errors", 1);
			$log = $data['login'];
			setcookie('login',$log, (time() + 60 * 60 * 24 * 365)); // création d'un cookie avec le login entré par l'utilisateur

			header('location:PHP/vote.php'); // redirection vers une nouvelle page
		endif;

	}

?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>World Cup 2014</title>
	<link href="CSS/style_index.css" rel="stylesheet" type="text/css">
</head>
<body>

<div class="login">

	<h1>World Cup 2014</h1><br /><br />

	<h2>Register to vote</h2>
    <form method="post">
		<input class="<?php echo array_key_exists('login', $errors) ? 'error': ''; ?>" type="text" name="login" id="login" placeholder="Login" value="<?php echo $data['login']; ?>"/>

		<input class="<?php echo array_key_exists('email', $errors) ? 'error': ''; ?>" type="text" name="email" id="email" placeholder="Email" value="<?php echo $data['email']; ?>"/>

        <input type="submit" class="btn btn-primary btn-block btn-large" value="Submit"/>

    </form>
</div>

</body>
</html>