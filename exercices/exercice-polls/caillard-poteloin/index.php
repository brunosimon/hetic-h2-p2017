<?php
session_start();
require_once 'incs/config.php';
require_once 'incs/tokenmanager.php';
?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Epic Surveys</title>
		<link rel="stylesheet" href="assets/flatstrap/css/bootstrap.css">
		<link rel="stylesheet" href="assets/css/style.css">
	</head>
	<body>

		<div class="wrap">
			<div class="container">
				<h1><a href="index.php">EpicSurveys</a></h1>
				<?php if (empty($_SESSION['name']))
					include("incs/pages/newuser.php");	
				else
					include("incs/pagemanager.php"); 
				?>			
			</div>
		</div>

		<div class="push"></div>

		<footer>
			<div class="container"><p>Epic Survey | Copyleft</p></div>
		</footer>
		<script src="assets/js/jquery-2.1.0.js"></script>
		<script src="assets/js/chart.min.js"></script>
		<script src="assets/flatstrap/js/bootstrap.min.js"></script>		
		<script src="assets/js/main.js"></script>
		<script src="assets/js/results-charts.js"></script>

		<script>
			<?php if (!empty($jsonVotes)): ?>
				if ($('#results-chart')) {
					$(function() {
						setChart(<?php echo $jsonVotes ?>)
					});
				}
			<?php endif; ?>
		</script>
	</body>
</html>