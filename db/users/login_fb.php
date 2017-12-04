<?php
//NO IMPLEMENTADO
require_once __DIR__ . '/Facebook/autoload.php'; // change path as needed

$fb = new Facebook\Facebook([
  'app_id' => '103020970476788', // Replace {app-id} with your app id
  'app_secret' => '3a4835cdb33d48e9c565c9dd308c1d8f',
  'default_graph_version' => 'v2.2',
  ]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('localhost/db/users/fb-callback.php', $permissions);

echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';
?>