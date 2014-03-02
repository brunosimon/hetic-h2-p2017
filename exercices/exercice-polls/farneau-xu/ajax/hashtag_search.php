<?php

include("../includes/config.php");

$h = $_GET['h'];
if($h!=""){

	$h=htmlspecialchars($h);

	$url = 'https://api.twitter.com/1.1/search/tweets.json';
	$requestMethod = 'GET';
	$getfield = '?q=#'.$h.'&lang=fr';

	$twitter = new TwitterAPIExchange($settings);
	$results = $twitter->setGetfield($getfield)
	             ->buildOauth($url, $requestMethod)
	             ->performRequest();

	$results = json_decode($results);

	$html = "<h5>Tweets récents avec <i>#".$h."</i></h5>";
	$count=array();
	
	if(!empty($results->statuses)){
		foreach($results->statuses as $k => $v){

			foreach($vote_types as $w){
				$count[$w]=0;
			}

			$date=0;

			$select = $db->query("SELECT * FROM votes_count WHERE tweet_id=".$v->id);
			while($fetched = $select->fetch()){
				$count[$fetched['vote']] = $fetched['count'];
				
				if($date<$fetched['last_vote']){
					$date=$fetched['last_vote'];
				}
			}

			$t = "0";
			$counts = "";

			foreach($vote_types as $x){
				$counts .= "<a href='#' data-type='".$x."' class='btn btn-lg btn-danger button-unchecked'>".$x." (<span class='count'>".$count[$x]."</span>)</a> ";
			}

			$html.=render_tweet($v->id,$v->user->profile_image_url,$v->user->name,$v->text,$counts,$date);
		}
	}else{
		$html .= "Aucun resultat";
	}

	echo $html;
}
?>