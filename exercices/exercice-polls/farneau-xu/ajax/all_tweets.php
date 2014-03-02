<?php

include("../includes/config.php");

// If variables are set
if(isset($_GET['type']) AND isset($_GET['limit'])){

	// Is the type valid ?
	$verif = 0;
	foreach($vote_types as $verif_type){
		if($_GET['type']==$verif_type){
			$verif = 1;
		}
	}

	// Is everything correct ?
	if($verif == 1 AND is_numeric($_GET['limit'])){

		$limit = $_GET['limit'];
		$w = $_GET['type'];

		$html="<h5>Les tweets les plus <i>".$w."</i></h5>";

		$select = $db->query("SELECT * FROM votes_count WHERE vote='".$w."' ORDER BY count DESC LIMIT 0,".$limit);

		$url = 'https://api.twitter.com/1.1/statuses/show.json';
		$requestMethod = 'GET';

		$fetched = $select->fetchAll();

		foreach($fetched as $tweet){

			$getfield = '?id='.$tweet['tweet_id'];

			$twitter = new TwitterAPIExchange($settings);
			$results = $twitter->setGetfield($getfield)
		             ->buildOauth($url, $requestMethod)
		             ->performRequest();

			$v = json_decode($results);

			foreach($vote_types as $w){
				$count[$w]=0;
			}

			$date=0;
			$select = $db->query("SELECT * FROM votes_count WHERE tweet_id=".$v->id);

			if(!empty($select)){
				while($tweet = $select->fetch()){
					$count[$tweet['vote']] = $tweet['count'];
					
					if($date<$tweet['last_vote']){
						$date=$tweet['last_vote'];
					}
				}

				$t = "0";
				$counts = "";

				foreach($vote_types as $x){
					$counts .= "<a href='#' data-type='".$x."' class='btn btn-lg btn-danger button-unchecked'>".$x." (<span class='count'>".$count[$x]."</span>)</a> ";
				}
			}


			$html.=render_tweet($v->id,$v->user->profile_image_url,$v->user->name,$v->text,$counts,$date);

		}

		echo $html;
		
	}
}

?>