<?php
	session_start();
	require_once  'src/fbconnect.php';
?>

<!doctype html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="src/css/bootstrap.min.css"></style>
	<link rel="stylesheet" type="text/css" href="src/css/custom.css"></style>
	<link rel="icon" href="favicon.ico" />
	
	<title> Find Friends </title>
</head>
<body class="container">

	<?php 
	if ($user){

			$select = $pdo->query("SELECT * FROM ff_users WHERE id_fb=".$user_profile["id"]);
			$fetched = $select->fetchAll();

		
			if ($select->rowCount()!==0) {
				include 'src/session.php'; // take user's data and put them in session
				include 'src/friends.php'; // display all friends

		 	} 
		 	else {
			 	include 'src/form.php'; // if user not logged, we include suscribe form.
 			}
    }
    else{
    ?>	
	<div class="center-block whitebg login">
	    	<h1 class="text-center"> Finds friends </h1> 
	    	<p class="h3 text-center"> Let's find some friends </p>
			</br>
			<div class="span6" style="text-align:center">
				<button type="button" class="btn btn-primary btn-lg center" onclick="location.href='<?php echo $loginUrl; ?>'">
		  			<span class="glyphicon glyphicon-circle-arrow-right"></span> Connectez vous via Facebook
				</button>
		</div>
	</div>
	<?php
	}
	?>

</body>
</html>