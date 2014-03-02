<?php 
	include 'src/includes/config.php';
	include 'src/includes/functions.php';
	include 'src/includes/display_functions.php';
	include 'src/includes/process_result.php'
?><!DOCTYPE html>
<html lang="fr-FR">
<head>
	<meta charset="UTF-8">
	<title>Quel superhéro sommeille en toi ?</title>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="src/css/reset.css">
	<link rel="stylesheet" href="src/css/main.css">
</head>
<body>
	<header class="header">
	    <div class="container">
	        <h1>Résultats</h1>
	    </div>
	</header>
	<div class="container">
	    <?php display_identity($infos[0]); ?>

        <section class="details panel">
            <article>
                <h2>Plus de détails :</h2>
                <?php display_details($infos,$rank,$total_step); ?>
            </article>
        </section>
        
        <section class="panel">
            <article>
                <h2>Un peu de comparaison</h2>
                <p>Pour te donner une idée, voici une représentation des votes des autres membres.</p>
                <ul class="graph"><?php display_percent_results(get_percents_results(),$infos[0]); ?></ul>
            </article>
        </section>
        
        <a href="index.php" title="Refaire un test" class="redo">Recommencer le test !</a>
	</div>
    <script src="src/js/d3.js" type="text/javascript"></script>
    <script type="text/javascript">
        d3.selectAll("p.bars")
        .data(datas) /* datas is defined in php display_details() function*/
        .transition()
        .duration(3000)
        .style("width", function(d) { console.log(d+"%"); return  d + "%"; });
        
        d3.selectAll("ul.graph li")
        .data(datasGeneral) /* datas is defined in php display_percent_results() function*/
        .transition()
        .duration(3000)
        .style("width", function(d) { console.log(d+"%"); return  d + "%"; });
    </script>
</body>
</html>