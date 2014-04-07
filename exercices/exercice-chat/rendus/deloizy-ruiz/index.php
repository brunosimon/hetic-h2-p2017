<?php 
	require 'src/php/config.php';
	include('src/php/function.php');
	
	if(!empty($_POST) && $_POST['nickname']){
		$_SESSION['nickname'] = $_POST['nickname'];
		header('location:src/php/chat.php');
	}	

	

	

	if(isset($_POST['valid_file'])) 
	{
		$_SESSION['id'] = uniqid();

		$avatar = $_FILES['avatar']['name'];
		$avatar_tmp = $_FILES['avatar']['tmp_name'];
		$errors = array();

		//Récupérer l'extension de l'image (jpeg, jpg, png, gif...)
			if(!empty($avatar_tmp))
			{
				$image = explode('.',$avatar);

				$image_ext = end($image);

					if(in_array(strtolower($image_ext), array('png','jpeg','jpg','gif')) === false)
					{
						$errors[] = "Veuillez choisir un autre format d'image";
					}
			}
			if(empty($errors))
			{
				//Fonction permettant de redimensionner l'image 
				upload_avatar($avatar_tmp);
			}
			else 
				{
					foreach($errors as $error)
					{
						echo ($error);
					}
				}
	}

?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8"/>
		<title>Chat en PHP de DELOIZY & RUIZ</title>
		<link rel="stylesheet" href="src/css/reset.css"/>
		<link rel="stylesheet" href="src/css/style.css"/>
	</head>

	<body>
		<h1>Connexion to an awesome chat!</h1>
		<div class="circle"></div>
		<div class="border_circle"></div>

		<span id="container_image"></span>
	<!-- Si $_session id n'est pas défini (donc qu'il n'a pas upload d'image) on ajoute la class "hidden" à l'image afin de la masquer -->
	<!-- Si $_session id est défini, on ajoute l'attribut "src" à l'image -->
		<p class="photo"><img <?php if (isset($_SESSION['id']) && $_SESSION['id']): ?> src="src/images/photos_uploaded/<?php echo $_SESSION['id'];?>.jpg" <?php endif ?> alt="ph" <?php if (!isset($_SESSION['id']) || !$_SESSION['id']): ?> class="hidden" <?php endif; ?> class="rounded" />
		</p>

		<form method="post" action="index.php" enctype="multipart/form-data"> 
			<!-- bouton "+ Ajouter votre photo" -->
			<label><span class="icons"></span></label>
			<label for="file" class="add_file"><span class="plus">+</span><span class="text_plus">Add your profile picture</span></label>
			<input type="file" id="file" name="avatar">

			<!-- Bouton pour prévisualiser son avatar "view" -->
			<input type="submit" class="view" name="valid_file" value=" " >



			<div class="login">
				<!-- Champ "Nom d'utilisateur" + logo user -->
				<span class="icon_username"></span>
				<input type="text" name="nickname" id="nickname" class="username" placeholder="Username">
			</div>

			<!-- Bouton "Connexion" -->
			<input type="submit" name="upload" class="log" value="Login">

		</form>
		
		<script type="text/javascript" src="src/js/jquery.min.js"></script>
		<script type="text/javascript" src="src/js/script.js"></script>
	</body>

</html>