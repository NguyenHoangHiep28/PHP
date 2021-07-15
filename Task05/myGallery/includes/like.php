<?php
include 'dbh.inc.php';
if (isset($_POST['liked'])) {
    $id = $_POST['liked'];
    $imgid = $_POST['imageid'];
    $liked = $conn->query("SELECT * FROM likes WHERE userid = $id AND imageid = $imgid");
    $result = $conn->query("SELECT * FROM images WHERE imageid=$imgid");
    $row = $result->fetch_array();
    $n = $row['likes'];
    if ($liked->num_rows <= 0) {
        $inserted = $conn->query("INSERT INTO likes(userid, imageid) VALUES ($id, $imgid)");
        $conn->query("UPDATE images SET likes=$n+1 WHERE imageid=$imgid");
        $liked = $conn->query("SELECT * FROM likes WHERE userid = $id AND imageid = $imgid");

        if ($liked->num_rows > 0) {
            echo '<span class="like-number like-action">' . ($n + 1) . '</span>';
        } else {

            echo '<span class="like-number like-action">' . $n . '</span>';
        }
    } else {
        $deleted = $conn->query("DELETE FROM likes WHERE userid=$id AND imageid=$imgid");
        $conn->query("UPDATE images SET likes=$n-1 WHERE imageid=$imgid");

        $unliked = $conn->query("SELECT * FROM likes WHERE userid = $id AND imageid = $imgid");

        if ($unliked->num_rows <= 0) {
            echo '<span class="like-number like-action">' . ($n - 1) . '</span>';
        } else {
            echo '<span class="like-number like-action">' . $n . '</span>';
        }
    }
}
