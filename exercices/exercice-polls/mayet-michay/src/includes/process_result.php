<?php

session_start();

$rank = retrieve_results($_SESSION["token"]);
$first_key = array_keys($rank)[0];

// We add to the database the result
add_to_result_list($first_key,$_SESSION["token"]);

$total_step = get_steps();
$infos = Array();
foreach ($rank as $id=>$value) 
    { $infos[] = get_informations($id);}

