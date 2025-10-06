<?php
include '../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);
    $albums_album_id = (int)$_POST['albums_album_id'];

    $sql = "INSERT INTO songs (title, description, albums_album_id) VALUES ('$title', '$description', $albums_album_id)";
    if ($conn->query($sql)) {
        header("Location: index.php?success=1");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    header("Location: create.php");
    exit;
}