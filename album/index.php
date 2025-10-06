<?php
session_start();
include("../includes/header.php");
include "../includes/config.php";


?>
<div class="container-fluid container-lg">
    <a class="btn btn-primary" href="create.php" role="button">Add Album</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Album ID</th>
                <th>album Name</th>
                <th>Artist</th>
                <th>Genre</th>
                <th>Date Released</th>
                <th>Action</th>
            </tr>
        </thead>
        <?php

        $result = mysqli_query($conn, "SELECT * FROM albums al INNER JOIN artists ar on (al.artists_artist_id = ar.artist_id) ORDER BY al.album_id ");

        while ($row = mysqli_fetch_assoc($result)) {
            $album_id = $row['album_id'];
            print "<tr>";
            echo "<td> {$row['album_id']}</td>";
            echo "<td>{$row['title']}</td>";
            echo "<td>{$row['name']}</td>";
            echo "<td>{$row['genre']}</td>";
            echo "<td>{$row['date_released']}</td>";
            echo "<td>
                    <a href=edit.php?id={$row['album_id']}>
                        <i class='fa-regular fa-pen-to-square' aria-hidden='true' style='font-size:24px'>
                        </i>
                    </a>
                    <a href='javascript:void(0)' onclick='confirmDelete($album_id)'>
                        <i class='fa-regular fa-trash-can' aria-hidden='true' style='font-size:24px; color:red'>
                        </i>
                    </a>
                </td>";
            print "</tr>";
        }

        ?>
    </table>

    <script>
    function confirmDelete(albumId) {
        if (confirm('Are you sure you want to delete this album?')) {
            window.location.href = 'delete.php?id=' + albumId;
        }
    }
    </script>
</div>
<?php
include("../includes/footer.php");
?>