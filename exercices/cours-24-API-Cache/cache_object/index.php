<?php

require 'config.php';
require 'cache.class.php';

$cache = new Cache();

if(!$content = $cache->get('moncontenu'))
{
	echo 'Not from cache';
	$content = 'Ceci est mon contenu';
	$cache->set('moncontenu',$content);
}
else
{
	echo 'From cache';
}

