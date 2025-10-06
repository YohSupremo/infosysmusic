<?php
session_start();
include('../includes/header.php');
include '../includes/config.php';

// Fetch all artists
$artists = $conn->query("SELECT artist_id, name FROM artists ORDER BY name ASC");

// Get selected artist from POST
$selected_artist = isset($_POST['artist_id']) ? (int)$_POST['artist_id'] : 0;

// Fetch albums for selected artist, if any
$albums = [];
if ($selected_artist) {
    $albums_query = $conn->query("SELECT album_id, title FROM albums WHERE artists_artist_id = $selected_artist ORDER BY title ASC");
    while ($row = $albums_query->fetch_assoc()) {
        $albums[] = $row;
    }
}

// Handle final submission BEFORE any HTML output
if (isset($_POST['final_submit']) && $selected_artist && isset($_POST['albums_album_id']) && !empty($_POST['title'])) {
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);
    $albums_album_id = (int)$_POST['albums_album_id'];

    $sql = "INSERT INTO songs (title, description, albums_album_id) VALUES ('$title', '$description', $albums_album_id)";
    if ($conn->query($sql)) {
        header("Location: index.php");
        exit;
    } else {
        $error = "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
    }
}
?>
<!-- HTML output starts here -->
<body>
    <div class="container-fluid container-lg">
        <?php if (isset($error)) echo $error; ?>
        <form action="create.php" method="POST">
            <div class="form-group">
                <label for="songTitle">Song Title</label>
                <input type="text" class="form-control" id="songTitle" placeholder="Enter song title" name="title" value="<?= isset($_POST['title']) ? htmlspecialchars($_POST['title']) : '' ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description" placeholder="Song description" name="description" value="<?= isset($_POST['description']) ? htmlspecialchars($_POST['description']) : '' ?>">
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
                <select class="form-control" id="album" name="albums_album_id" required <?= !$selected_artist ? 'disabled' : '' ?>>
                    <option value="">Select Album</option>
                    <?php foreach($albums as $album): ?>
                        <option value="<?= $album['album_id'] ?>" <?= (isset($_POST['albums_album_id']) && $_POST['albums_album_id'] == $album['album_id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($album['title']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" name="final_submit" <?= !$selected_artist ? 'disabled' : '' ?>>Add Song</button>
        </form>
    </div>
</body>
<?php include('../includes/footer.php'); ?>