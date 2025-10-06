<?php
require('../includes/config.php');

$artist_id = (int) $_POST['artistId'];
$name = trim($_POST['artistName']);
$country = trim($_POST['country']);

// Fetch current image path
$current = mysqli_query($conn, "SELECT img_path FROM artists WHERE artist_id = $artist_id");
$current_img = '';
if ($row = mysqli_fetch_assoc($current)) {
    $current_img = $row['img_path'];
}

$img_path = $current_img;

// Check if a new image is being uploaded
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK && !empty($_FILES['image']['name'])) {
    $allowed_types = ['image/png', 'image/jpeg', 'image/jpg'];
    if (in_array($_FILES['image']['type'], $allowed_types)) {
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $new_name = uniqid() . '.' . $ext;
        $upload_path = '../upload/' . $new_name;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_path)) {
            $img_path = $new_name;
            // Optionally, delete the old image file if needed
            if ($current_img && file_exists('../upload/' . $current_img)) {
                unlink('../upload/' . $current_img);
            }
        }
    }
}

// Update artist info
$sql = "UPDATE artists SET name = '{$conn->real_escape_string($name)}', country = '{$conn->real_escape_string($country)}', img_path = '{$conn->real_escape_string($img_path)}' WHERE artist_id = $artist_id";
$result = mysqli_query($conn, $sql);

if ($result) {
    header("Location: index.php");
    exit;
} else {
    echo "Error updating artist: " . $conn->error;
}
?>