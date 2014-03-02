<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','root');
define('DB_NAME','exercice-poll-meyer-lemaitre');

try 
{
	$pdo = new PDO('mysql:dbname='.DB_NAME.';host='.DB_HOST,DB_USER,DB_PASS);
	$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_NAMED);
}
catch (PDOExeption $e)
{
	die('error');
}
	
// Series Table 

	$drama = array(
		'breaking bad' => 'Breaking Bad',
		'the walking dead' => 'The Walking Dead',
		'black mirror' => 'Black Mirror',
		'homeland' => 'Homeland',
		'dexter' => 'Dexter',

		);

	$action = array(
		'sherlock' => 'Sherlock',
		'arrow' => 'Arrow',
		'24 heures chronos' => '24 heures chronos',
		'spartacus' => 'Spartacus',
		'strike back' => 'Strike Back',
		);

	$sciencefiction = array(
		'misfit' => 'Misfit',
		'dr who' => 'Dr Who',
		'under the dome' => 'Under The Dome',
		'terra nova' => 'Terra nova',
		'stargate sg1' => 'Stargate SG1',
		);

	$comedy = array(
		'les simpson' => 'Les Simpson',
		'how i met your mother' => 'How I Met Your Mother',
		'the big bang theory' => 'The Big Bang Theory',
		'south park' => 'South Park',
		'californication' => 'Californication',
		);

	$fantastic = array(
		'game of thrones' => 'Game of thrones',
		'american horror story' => 'American Horror Story',
		'les revenants' => 'Les Revenants',
		'heroes' => 'Heroes',
		'smallville' => 'Smallville',
		);