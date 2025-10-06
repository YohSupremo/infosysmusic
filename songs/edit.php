<?php

session_start();
require('../includes/header.php');
require('../includes/config.php');

if (!isset($_SESSION['user_id'])) {
    $_SESSION['message'] = "please Login to access the page";
    header("Location: ../user/login.php");
    exit;
}

$song_id = (int)$_GET['id'];
$song = $conn->query("SELECT * FROM songs WHERE song_id = $song_id")->fetch_assoc();

// Fetch all artists
$artists = $conn->query("SELECT artist_id, name FROM artists ORDER BY name ASC");

// Determine selected artist (from album)
$album = $conn->query("SELECT * FROM albums WHERE album_id = {$song['albums_album_id']}")->fetch_assoc();
$selected_artist = $album['artists_artist_id'];

// Fetch albums for selected artist
$albums = $conn->query("SELECT album_id, title FROM albums WHERE artists_artist_id = $selected_artist ORDER BY title ASC");
?>

<body>
    <div class="container-fluid container-lg">
        <form action="update.php" method="POST">
            <input type="hidden" name="song_id" value="<?= $song['song_id'] ?>">
            <div class="form-group">
                <label for="songTitle">Song Title</label>
                <input type="text" class="form-control" id="songTitle" name="title" value="<?= htmlspecialchars($song['title']) ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description" name="description" value="<?= htmlspecialchars($song['description']) ?>">
            </div>
            <div class="form-group">
                <label for="artist">Artist</label>
                <select class="form-control" id="artist" name="artist_id" onchange="this.form.submit()" required>
                    <option value="">Select Artist</option>
                    <?php while($row = $artists->fetch_assoc()): ?>
                        <option value="<?= $row['artist_id'] ?>" <?= $selected_artist == $row['artist_id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($row['name']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="album">Album</label>
                <select class="form-control" id="album" name="albums_album_id" required>
                    <option value="">Select Album</option>
                    <?php while($row = $albums->fetch_assoc()): ?>
                        <option value="<?= $row['album_id'] ?>" <?= $song['albums_album_id'] == $row['album_id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($row['title']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Song</button>
        </form>
    </div>
</body>
<?php
include('../includes/footer.php');
?>