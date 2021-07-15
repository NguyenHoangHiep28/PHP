<?php
include 'dbh.inc.php';
session_start();
if (!isset($_SESSION['user_name'])) {
    $userid = "";
} else {
    $username = $_SESSION['user_name'];
    $sqlGetLikedUser = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sqlGetLikedUser);
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        $userid = $user['userid'];
    }
}
$limitRec = 12;
if (!empty($_POST['imageNewCount'])) {
    $limitRec = $_POST['imageNewCount'];
}
//Check if limit is more than images in DB
$countImg = "SELECT * FROM images";
$countResult = $conn->query($countImg);
$countNumber = $countResult->num_rows;
if (($countNumber - $limitRec) <= -4) {
    echo '<script>alert("No more images found in gallery!")</script>';
}
$sql = "SELECT * FROM images ORDER BY orderGallery DESC LIMIT $limitRec;";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "SQL statement failed!";
} else {
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_assoc($result)) {
        $authorName = "";
        $sqlFindAuthor = "SELECT userpostimages.userid, users.username, userpostimages.imageid FROM userpostimages INNER JOIN users ON userpostimages.userid = users.userid";
        $findAuthorResult = $conn->query($sqlFindAuthor);
        if ($findAuthorResult->num_rows > 0) {
            while ($record = $findAuthorResult->fetch_assoc()) {
                if ($record['imageid'] == $row['imageid']) {
                    $authorName = $record['username'];
                }
            }
        }
        $imgName = $row['imgFullName'];
        $imgTitle = $row['title'];
        $likeNumber = $row['likes'];
        $imageid = $row['imageid'];
        echo '<div class="col-lg-3 col-md-4 col-xs-6 thumb">';
        echo '<a class="fancybox" rel="fancybox-thumb" href="img/gallery/' . $imgName . '" title="' . $imgTitle . '">';
        echo '<img src="img/gallery/' . $imgName . '" class="zoom img-fluid " alt="">';
        echo '</a>';
        echo '<div class="content-box">';
        echo '<form method="post" class="author-likes" id="' . $imageid . '">';
        echo '<a href="#" class="author-block" ><i class="fa fa-user-circle fa-lg author-img" aria-hidden="true"></i>' . $authorName . '</a>';
        if (isset($_SESSION['user_name'])) {
            $checkLikeSql = "SELECT * FROM likes WHERE userid = $userid AND imageid = $imageid";
            $checkResult = $conn->query($checkLikeSql);
            if ($checkResult->num_rows > 0) {
                echo '<button type="button" class="like-btn like-action like' . ' "><img src="img/red-heart.png"></i></button>';
            } else {
                echo '<button type="button" class="like-btn like-action like' . '"><img src="img/heart-icon.png"></button>';
            }
        } else {
            echo '<button type="button" class="like-btn like-action like' . '"><img src="img/heart-icon.png"></button></button>';
        }
        echo '<span class="like-number like-action">'.$likeNumber.'</span></form>';
        echo '<p class="img-title text-truncate">' . $imgTitle . '</p>';
        echo '</div>';
        echo '</div>';
    }
    include '../js/main-js.php';
}


