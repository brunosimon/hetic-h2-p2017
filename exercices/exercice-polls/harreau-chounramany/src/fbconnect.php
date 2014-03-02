<?php 

// settings

require_once 'facebook.php';
require_once 'config.php';

$facebook = new Facebook(array(
	'appId' => '553476574759354',
	'secret' => '8f8ac07685c01566e7c3840764e3fb03',
));

// Get User ID
$user = $facebook->getUser();

// if on facebook
if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}

// Login or logout url will be needed depending on current user state.

if ($user) {
  $logoutUrl = $facebook->getLogoutUrl();
} else {
  $statusUrl = $facebook->getLoginStatusUrl();
  $loginUrl = $facebook->getLoginUrl();

// getLogoutUrl( $params=array('next'=> 'www.stuff.com/redirect') 
}
?>

