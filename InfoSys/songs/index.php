<?php
session_start();
require('../includes/header.php');
require('../includes/config.php');

// Fetch all artists for the filter dropdown
$artists = $conn->query("SELECT artist_id, name FROM artists ORDER BY name ASC");

// Get selected artist and album from GET
$selected_artist = isset($_GET['artist_id']) ? (int)$_GET['artist_id'] : 0;
$selected_album = isset($_GET['album_id']) ? (int)$_GET['album_id'] : 0;

// Fetch albums for the selected artist
$albums = [];
if ($selected_artist) {
    $albums_query = $conn->query("SELECT album_id, title FROM albums WHERE artists_artist_id = $selected_artist ORDER BY title ASC");
    while ($row = $albums_query->fetch_assoc()) {
        $albums[] = $row;
    }
}

// Build SQL for songs
$sql = "SELECT s.song_id, s.title, s.description, a.title AS album_title, ar.name AS artist_name
        FROM songs s
        JOIN albums a ON s.albums_album_id = a.album_id
        JOIN artists ar ON a.artists_artist_id = ar.artist_id";
$where = [];
if ($selected_artist) {
    $where[] = "ar.artist_id = $selected_artist";
}
if ($selected_album) {
    $where[] = "a.album_id = $selected_album";
}
if ($where) {
    $sql .= " WHERE " . implode(' AND ', $where);
}
$sql .= " ORDER BY s.song_id DESC";
$result = mysqli_query($conn, $sql);
?>

<body>
    <h1>Songs</h1>
    <div class="d-flex align-items-center mb-3">
        <a class="btn btn-primary" href="create.php" role="button" style="margin-right: 40px;">Add Song</a>
        <form method="get" class="mb-0">
            <div class="d-flex align-items-center">
                <label for="artist_id" class="mb-0" style="margin-right: 10px;">Filter by Artist:</label>
                <select name="artist_id" id="artist_id" class="form-control"
                    style="width:auto; min-width:180px; display:inline-block; margin-right: 30px;" onchange="this.form.submit()">
                    <option value="">All Artists</option>
                    <?php
                    mysqli_data_seek($artists, 0);
                    while($row = $artists->fetch_assoc()): ?>
                        <option value="<?= $row['artist_id'] ?>" <?= $selected_artist == $row['artist_id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($row['name']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
                <label for="album_id" class="mb-0" style="margin-right: 10px;">Album:</label>
                <select name="album_id" id="album_id" class="form-control"
                    style="width:auto; min-width:180px; display:inline-block;" onchange="this.form.submit()" <?= !$selected_artist ? 'disabled' : '' ?>>
                    <option value="">All Albums</option>
                    <?php foreach($albums as $album): ?>
                        <option value="<?= $album['album_id'] ?>" <?= $selected_album == $album['album_id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($album['title']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <noscript><button type="submit" class="btn btn-secondary">Filter</button></noscript>
        </form>
    </div>
    <table class='table table-striped'>
        <thead>
            <tr>
                <th>Song ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Album</th>
                <th>Artist</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= $row['song_id'] ?></td>
                    <td><?= htmlspecialchars($row['title']) ?></td>
                    <td><?= htmlspecialchars($row['description']) ?></td>
                    <td><?= htmlspecialchars($row['album_title']) ?></td>
                    <td><?= htmlspecialchars($row['artist_name']) ?></td>
                    <td>
                        <a href='edit.php?id=<?= $row['song_id'] ?>'><i class='fa-regular fa-pen-to-square' aria-hidden='true' style='font-size:24px'></i></a>
                        <a href='javascript:void(0)' onclick='confirmDelete(<?= $row['song_id'] ?>)'><i class='fa-regular fa-trash-can' aria-hidden='true' style='font-size:24px; color:red'></i></a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <script>
    function confirmDelete(songId) {
        if (confirm('Are you sure you want to delete this song?')) {
            window.location.href = 'delete.php?id=' + songId;
        }
    }
    </script>
</body>
<?php
include('../includes/footer.php');
?>