<?php
session_start();
include("../includes/config.php");
if (!isset($_SESSION['user_id'])) {
    $_SESSION['message'] = "please Login to access the page";
    header("Location: ../user/login.php");
}
// print_r($_POST);
$title = trim($_POST['albumName']);
$artist_id = $_POST['artist'];
$date = $_POST['dateReleased'];
$genre = trim($_POST['genre']);
$sql = "INSERT INTO albums (title,genre, date_released, artists_artist_id) VALUES('$title','$genre','$date',  $artist_id)";
$result = mysqli_query($conn, $sql);
if ($result) {
    header("Location: index.php");
} else {
    echo mysqli_error($conn);
}