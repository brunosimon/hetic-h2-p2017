<?php

require 'config.php';
require 'cache.class.php';


if(!$content = get('moncontenu'))
{
	echo 'Not from cache';
	$content = 'Ceci est mon contenu';
	set('moncontenu',$content);
}
else
{
	echo 'From cache';
}

