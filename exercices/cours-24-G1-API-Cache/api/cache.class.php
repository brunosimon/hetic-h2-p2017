<?php

define('CACHE_PATH',dirname(__FILE__).'/cache/');

class Cache
{
    function get($key)
    {
        $file_path = $this->get_cache_path($key);

        if(file_exists($file_path))
            return unserialize(file_get_contents($file_path));

        return false;
    }

    function set($key,$data)
    {
        $data = serialize($data);
        $file_path = $this->get_cache_path($key);
        file_put_contents($file_path,$data);
    }

    function get_cache_path($key)
    {
        $file = md5($key).'.cache';
        $path = CACHE_PATH.$file;

        return $path;
    }
}
