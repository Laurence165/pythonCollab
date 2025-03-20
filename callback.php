<?php
require 'vendor/autoload.php';

session_start();

// Load Google OAuth credentials
$client = new Google\Client();
$client->setAuthConfig('credentials.json');
$client->setRedirectUri('http://localhost/callback.php');
$client->addScope(Google\Service\Drive::DRIVE_FILE);
$client->setAccessType('offline');

// Get the OAuth token after user grants permission
if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $_SESSION['access_token'] = $token;
    header("Location: upload.php"); // Redirect to file upload page
    exit;
}
?>
