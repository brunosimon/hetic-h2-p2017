<?php

require 'cache.class.php';

$cache   = new Cache();
$content = $cache->get('mykey');

// Cache not found
if(!$content)
{
    echo 'Not from cache';
    $content = array('ldsjhd','toto','tutu');
    $cache->set('mykey',$content);
}

// Cache found
else
{
    echo 'From cache';
}

// Show results
echo '<pre>';
print_r($content);
echo '</pre>';