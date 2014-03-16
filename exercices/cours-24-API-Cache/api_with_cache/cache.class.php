<?php

class Cache
{
	public $duration = 10;

	/*
	 * GET
	 * Use key to find cache file
	 */
	function get($key)
	{
		// Get file path
		$file_path = $this->get_file_path($key);

		// If file doesn't exist return false
		if(!file_exists($file_path))
		{
			return false;
		}

		// If file expire return false
		if(time() - filemtime($file_path) > $this->duration)
		{
			unlink($file_path);
			return false;
		}

		// Else return content
		return unserialize(file_get_contents($file_path));
	}

	/**
	 * SET
	 * Add data to a cache file
	 */
	function set($key,$data)
	{
		// Get file path
		$file_path = $this->get_file_path($key);

		// Add content to file
		file_put_contents($file_path,serialize($data));
	}

	/**
	 * GET FILE PATH
	 * Create an absolut path to the file
	 * The name of the file is md5 encoded and the extension is ".cache"
	 */
	function get_file_path($key)
	{
		$key       = md5($key);
		$file_name = $key.'.cache';
		$file_path = CACHE_DIR.$file_name;

		return $file_path;
	}
}
