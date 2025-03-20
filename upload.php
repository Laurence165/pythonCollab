<?php
require 'vendor/autoload.php';

session_start();

// Check if user is authenticated
if (!isset($_SESSION['access_token'])) {
    die("You must <a href='login.php'>log in with Google</a> first.");
}

// Load Google Client and set access token
$client = new Google\Client();
$client->setAuthConfig('credentials.json');
$client->setAccessToken($_SESSION['access_token']);
$driveService = new Google\Service\Drive($client);

// Handle file upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $file_name = $_FILES['file']['name'];
    $file_tmp = $_FILES['file']['tmp_name'];

    // Check if the file is a .py file
    if (pathinfo($file_name, PATHINFO_EXTENSION) !== 'py') {
        die("Error: Only .py files are allowed.");
    }

    // Convert .py script to .ipynb (Jupyter Notebook)
    $notebook = [
        "cells" => [
            [
                "cell_type" => "code",
                "metadata" => [],
                "source" => file($file_tmp)
            ]
        ],
        "metadata" => [],
        "nbformat" => 4,
        "nbformat_minor" => 4
    ];

    // Save converted file as .ipynb
    $ipynb_filename = pathinfo($file_name, PATHINFO_FILENAME) . ".ipynb";
    $ipynb_path = sys_get_temp_dir() . "/" . $ipynb_filename;
    file_put_contents($ipynb_path, json_encode($notebook, JSON_PRETTY_PRINT));

    // Upload .ipynb file to Google Drive
    $fileMetadata = new Google\Service\Drive\DriveFile([
        'name' => $ipynb_filename
    ]);
    $content = file_get_contents($ipynb_path);

    try {
        $file = $driveService->files->create($fileMetadata, [
            'data' => $content,
            'mimeType' => 'application/json',
            'uploadType' => 'multipart',
            'fields' => 'id'
        ]);

        $fileId = $file->id;

        // Make file readable by Google Colab
        $driveService->permissions->create($fileId, new Google\Service\Drive\Permission([
            'type' => 'anyone',
            'role' => 'reader'
        ]));

        // Generate Colab link
        $colab_url = "https://colab.research.google.com/drive/$fileId";

        echo "File uploaded successfully! <a href='$colab_url' target='_blank'>Open in Colab</a>";
    } catch (Exception $e) {
        echo "Error uploading file: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Python File</title>
</head>
<body>
    <h2>Upload Python File to Google Drive</h2>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="file" required>
        <button type="submit">Upload & Open in Colab</button>
    </form>
</body>
</html>
