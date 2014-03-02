<?php 
if(!empty($_GET['page'])) {
	$page = "incs/pages/".$_GET['page'].".php";
	if(file_exists($page))
		include($page);
	else
		include("incs/pages/404.php");
}
else 
	include("incs/pages/home.php");
?>