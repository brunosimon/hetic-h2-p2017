<?php

define('CACHE_PATH',dirname(__FILE__).'/tmp/');

class Cache
{
    function get($key)
    {
        $path = $this->get_file_path($key);

        if(file_exists($path))
            return unserialize(file_get_contents($path));

        return false;
    }

    function set($key,$data)
    {
        $path = $this->get_file_path($key);

        file_put_contents($path,serialize($data));
    }

    function get_file_path($key)
    {
        $file = md5($key).'.cache';
        $path = CACHE_PATH.$file;

        return $path;
    }
}

