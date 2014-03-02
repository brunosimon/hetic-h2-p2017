<?php

/* 
* Display the answers for the question
* @param array $answers -- the array with the answers 
*/
function display_answers($answers) {
    foreach ($answers as $answer) {
        echo '<div class="answer">
        <input type="radio" name="id_answer" value="'.$answer->id_answer.'" id="answ'.$answer->id_answer.'"/>
        <label for="answ'.$answer->id_answer.'">
        <p>'.$answer->text.'</p>
        </label>
        </div>';
    }
}

/* 
* Display the results of the poll
* @param char $token -- the token of the user
*/
function display_results($token) {
	$rank = retrieve_results($token);
	$total_step = get_steps();
	$first = key($rank);
	$desc = get_description($first);
	echo '<p>Tu es donc <strong> '.$first.'<strong><p><p class="hero_desc">'.$desc.'</p>';
	echo '<p>Plus de détails : </p>';
	foreach($rank as $key => $profile) {
		$percent = round($profile/$total_step*100);
		echo 'Tu es à '.$percent.' % '.$key.'<br/>';
	}
}

/* 
* Display the id card of a character
* @param array $profil -- array with the information about a character (name, img and description)
*/
function display_identity($profil) {
    echo '<section class="identity panel">
	    <img src="'. $profil->img .'" alt="'. $profil->name .'">
	    <article>
            <h2>Tu es donc <span class="name">'. $profil->name .'</span></h2>
            <p class="description">
                '. $profil->description .'
            </p>
	    </article>
	</section>';
}

/* 
* Display the details of the answers + add the js datas for d3.js
*/
function display_details($infos,$rank,$total_step) {
    $datas = Array();
    foreach ($rank as $id=>$nb_answers) {
        $percent = round($nb_answers/$total_step*100);
        $name =  get_informations($id)->name;
        echo '<p>'. $name .' : '. $percent .' % </p>
            <p class="bars" data-percent="'. $percent .'"></p>';
        $datas[] = $percent;
    }
    echo '<script type="text/javascript">var datas = '.json_encode($datas).';</script>';
}

/* 
* Display the details of the result + add the js datas for d3.js
*/
function display_percent_results($results,$current) {
    $datas = Array();
    $current = $current->name;
    foreach ($results as $name => $value) {
        if ($current == $name) echo '<li class="current">'. $name .'</li>';
        else echo '<li>'. $name .'</li>';
        $datas[] = $value;                  
    }
    echo '<script type="text/javascript">var datasGeneral = '.json_encode($datas).';</script>';               
}