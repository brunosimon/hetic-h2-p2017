<?php

include("../includes/config.php");

// If both of the variables exists
if(isset($_GET['tweet_id']) && isset($_GET['vote_type'])){
	if(is_numeric($_GET['tweet_id']) && (mb_strlen($_GET['vote_type'])>=2 && mb_strlen($_GET['vote_type'])<= 10) && !empty($_GET['tweet_id']) && !empty($_GET['vote_type'])){

			$tweet_id = $_GET['tweet_id'];
			$vote_type = $_GET['vote_type'];

			if(!isset($_COOKIE[$tweet_id])){

				$select = $db->query("SELECT * FROM votes_count WHERE tweet_id='".$tweet_id."' AND vote='".$vote_type."'");

				$select_fetched = $select->fetch(PDO::FETCH_ASSOC);

				if($select->rowCount() == 0){

					$db->exec("INSERT INTO votes_count VALUES (NULL, '".$tweet_id."', '".$vote_type."', 1, '".time()."')");
					setcookie($tweet_id, 1, time()+10); // Expires in 3 hours
					// Doesn't exists
					echo "ok";

				}else{

					// Entry exists
					$insert = $db->exec("UPDATE votes_count SET count=count+1, last_vote='".time()."' WHERE tweet_id='".$tweet_id."' AND vote='".$vote_type."'");
					// Setting cookie to avoid multiple voting
					setcookie($tweet_id, 1, time()+(3600*3)); // Expires in 3 hours
					echo "ok";

				}
			}else{
				echo "already voted";
			}

	}
}


?>