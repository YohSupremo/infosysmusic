<?php

session_start();
require('../includes/config.php');

if (!isset($_SESSION['user_id'])) {
    $_SESSION['message'] = "please Login to access the page";
    header("Location: ../user/login.php");
    exit;
}

$song_id = (int)$_GET['id'];
$sql = "DELETE FROM songs WHERE song_id = $song_id LIMIT 1";
$result = mysqli_query($conn, $sql);

if (mysqli_affected_rows($conn) > 0) {
    header("Location: index.php");
    exit;
} else {
    echo "Error deleting song.";
}
?>