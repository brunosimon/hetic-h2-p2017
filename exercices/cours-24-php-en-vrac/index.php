<?php 

// // Curl
// $ch = curl_init();
// curl_setopt($ch,CURLOPT_URL,'http://google.com');
// curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);
// curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (iPhone; CPU iPhone OS 7_0_2 like Mac OS X) AppleWebKit/537.51.1 (KHTML, like Gecko) Version/7.0 Mobile/11A4449d Safari/9537.53');
// curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
// $result = curl_exec($ch);
// curl_close($ch);
// echo $result;


// // Constantes magiques
// echo __LINE__;
// echo __FILE__;
// echo __DIR__;

// function ma_fonction()
// {
//     echo __FUNCTION__;
// }

// ma_fonction();


// class Ma_Class
// {
//     public function __construct()
//     {
//         echo __CLASS__;
//     }
// }

// $class = new Ma_Class();


// Files
$dir   = dirname(__FILE__);
$files = glob($dir.'/*');

$path    = 'monfichier.txt';
$content = file_get_contents($path);

$path = 'monfichier.txt';
file_put_contents($path,'test 1234',FILE_APPEND);

$path = 'monfichier.txt';
if(file_exists($path))
    echo 'le fichier existe';
else
    echo 'le fichier n\'existe pas';

$path = 'monfichier.txt';
$fp   = fopen($path,'a+');
fwrite($fp,'1');
fclose($fp);

// echo '<pre>';
// print_r($content);
// echo '</pre>';
// exit;