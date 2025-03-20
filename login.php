<?php
require 'vendor/autoload.php';

session_start();

// Load Google OAuth credentials
$client = new Google\Client();
$client->setAuthConfig('credentials.json');
$client->setRedirectUri('http://localhost/callback.php');
$client->addScope(Google\Service\Drive::DRIVE_FILE);
$client->setAccessType('offline');  // For refresh tokens

// Redirect user to Google Login
$authUrl = $client->createAuthUrl();
header("Location: $authUrl");
exit;
?>
