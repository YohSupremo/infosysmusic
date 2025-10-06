<?php
session_start();
// print_r($_SESSION);
require('../includes/header.php');
require('../includes/config.php');

?>

<body>
    <h1>Artists</h1>
     <a class="btn btn-primary" href="create.php" role="button">Add Artists</a>
    <table class='table table-striped'>
        <thead>
            <tr>
                <th>Artist ID</th>
                <th>Artist Name </th>
                <th>Country</th>
                <th>Image</th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM artists ORDER BY artist_id DESC";

            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $artist_id = $row['artist_id'];
                ?>
                <tr>
                    <td><?= $row['artist_id'] ?></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['country']) ?></td>
                    <td>
                        <div style="width:100px; height:100px; overflow:hidden; display:flex; align-items:center; justify-content:center; background:#fff;">
                            <?php if (!empty($row['img_path']) && file_exists(__DIR__ . '/../upload/' . $row['img_path'])): ?>
                                <img src="../upload/<?= htmlspecialchars($row['img_path']) ?>" alt="Artist Image" style="width:100%; height:100%; object-fit:cover;">
                            <?php else: ?>
                                <span>No image</span>
                            <?php endif; ?>
                        </div>
                    </td>
                    <td>
                        <a href="edit.php?id=<?= $row['artist_id'] ?>"><i class='fa-regular fa-pen-to-square' aria-hidden='true' style='font-size:24px'></i></a>
                        <a href='javascript:void(0)' onclick='confirmDelete(<?= $artist_id ?>)'><i class='fa-regular fa-trash-can' aria-hidden='true' style='font-size:24px; color:red'></i></a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>

    <script>
    function confirmDelete(artistId) {
        if (confirm('Are you sure you want to delete this artist?')) {
            window.location.href = 'delete.php?id=' + artistId;
        }
    }
    </script>
</body>
<?php
include('../includes/footer.php');

?>