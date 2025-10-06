<?php

require('../includes/config.php');

$song_id = (int)$_POST['song_id'];
$title = trim($_POST['title']);
$description = trim($_POST['description']);
$albums_album_id = (int)$_POST['albums_album_id'];

$sql = "UPDATE songs SET title = '{$conn->real_escape_string($title)}', description = '{$conn->real_escape_string($description)}', albums_album_id = $albums_album_id WHERE song_id = $song_id";
$result = mysqli_query($conn, $sql);

if ($result) {
    header("Location: index.php");
    exit;
} else {
    echo "Error updating song: " . $conn->error;
}
?>