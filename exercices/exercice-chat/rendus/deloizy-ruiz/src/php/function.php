<?php

function upload_avatar($avatar_tmp)
{
	if(file_exists($avatar_tmp))
	{
		//Fonction qui renvoie la taille de l'image (height et width) et son type
		$image_size = getimagesize($avatar_tmp);

		if($image_size['mime'] == 'image/jpeg')
		{
			$image_src = imagecreatefromjpeg($avatar_tmp);
		}

		elseif($image_size['mime'] == 'image/png')
		{
			$image_src = imagecreatefrompng($avatar_tmp);
		}

		elseif($image_size['mime'] == 'image/gif')
		{
			$image_src = imagecreatefromgif($avatar_tmp);
		}

		else 
		{
			echo "Votre image n'est pas valide";
			$image_src = false;
		}

		//Redimensionner l'image
		if($image_src !== false)
		{
			$image_width = 200;

				
				if($image_size[0] <= $image_width)
				{
					//Si la largeur de l'image uploadé est inférieur à 140px, elle sera redimensionné en gardant ses proportions
					$image_finale = $image_src;
				}
				
				else
				{
					$new_width[0] = $image_width;
					$new_height[1] = ($image_size[1]/$image_size[0])*$image_width; //largeur de l'image choisie par l'utilisateur
						
					$image_finale = imagecreatetruecolor($new_width[0], $new_height[1]);	
					imagecopyresampled($image_finale,$image_src,0,0,0,0,$new_width[0],$new_height[1],$image_size[0],$image_size[1]);			
				}
				imagejpeg($image_finale,'src/images/photos_uploaded/'.$_SESSION['id'].'.jpg');
		}
	}
}

?>