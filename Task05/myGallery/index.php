<?php session_start();
include_once 'includes/dbh.inc.php';
//Find userid by session
if (isset($_SESSION['user_name'])) {
    $username = $_SESSION['user_name'];
    $sqlGetLikedUser = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sqlGetLikedUser);
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        $userid = $user['userid'];
    }
} else {
    $userid = "";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Gallery</title>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900|Cormorant+Garamond:300,300i,400,400i,500,500i,600,600i,700,700i"
          rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"
          media="screen">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="styles/style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css"/>
</head>
<body>
<!-- Page Content -->
<header>
    <a href="index.php" class="header-brand">ygallery</a>
    <nav>
        <ul>
            <li><a href="index.php" class="active">Home Page</a></li>
            <li><a href="about.html">Discover</a></li>
            <li><a href="contact.html">Charts</a></li>
            <li><a href="<?php if (!isset($_SESSION['user_name'])) {
                    echo "login.php";
                } else {
                    echo 'usergallery.php';
                } ?>" class="upload-link">Upload Images</a></li>
        </ul>
        <?php
        if (isset($_SESSION['user_name'])) {
            $username = $_SESSION['user_name'];
            echo '<a href="includes/gallery-login.inc.php" class="header-cases"><i class="fa fa-user-circle fa-lg" aria-hidden="true">';
            echo '</i><span style="font-size: 14px"> ' . $username . '</span></a>';
        } else {
            echo '<a href="login.php" class="header-cases">Join</a>';
            session_destroy();
        }
        ?>
    </nav>
</header>
<main>
    <section class="index-banner">
        <div class="vertical-center">
            <h2>Welcome to the greatest<br>GALLERY</h2>
            <h1>Best free stock pictures shared by talented creators.</h1>
        </div>
    </section>
    <div class="container-fluid page-top">
        <h4 style="margin-bottom: 50px;text-align: center;">GALLERY</h4>
        <div class="row">
            <?php
            $limitRec = 12;
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
                    echo '<a class="fancybox" rel="fancybox" href="img/gallery/' . $imgName . '" title="' . $imgTitle . '">';
                    echo '<img src="img/gallery/' . $imgName . '" class="zoom img-fluid " alt="">';
                    echo '</a>';
                    echo '<div class="content-box">';
                    echo '<form method="post" class="author-likes" id="' . $imageid . '">';
                    echo '<a href="" class="author-block" ><i class="fa fa-user-circle fa-lg author-img" aria-hidden="true"></i>' . $authorName . '</a>';
                    if (isset($_SESSION['user_name'])) {
                        $checkLikeSql = "SELECT * FROM likes WHERE userid = $userid AND imageid = $imageid";
                        $checkResult = $conn->query($checkLikeSql);
                        if ($checkResult->num_rows > 0) {
                            echo '<button type="button" class="like-btn like-action like' . ' "><img src="img/red-heart.png"></i></button>';
                        } else {
                            echo '<button type="button" class="like-btn like-action like' . '"><img src="img/heart-icon.png"></button>';
                        }
                    } else {
                        echo '<button type="button" class="like-btn like-action like' . '" onclick="window.location.href=\'login.php\'"><img src="img/heart-icon.png"></button></button>';
                    }echo '<span class="like-number like-action">'.$likeNumber.'</span></form>';
                    echo '<p class="img-title text-truncate">' . $imgTitle . '</p>';
                    echo '</div>';
                    echo '</div>';
                }
            }
            ?>

        </div>
        <form class="load-form">
            <button type="button" class="login-btn" name="loadmore" id="load-more">Load More</button>
        </form>
    </div>
    </section>
    <section class="index-links">
        <a href="cases.html">
            <div class="index-boxlink-square">
                <h3>Cases</h3>
            </div>
        </a>
        <a href="#">
            <div class="index-boxlink-rectangle">
                <h3>Portfolio</h3>
            </div>
        </a>
        <a href="#">
            <div class="index-boxlink-square">
                <h3>mmtuts</h3>
            </div>
        </a>
        <a href="#">
            <div class="index-boxlink-rectangle">
                <h3>YouTube Channel</h3>
            </div>
        </a>
        <a href="#">
            <div class="index-boxlink-square">
                <h3>About</h3>
            </div>
        </a>
        <a href="#">
            <div class="index-boxlink-square">
                <h3>Contact</h3>
            </div>
        </a>
    </section>
    <div class="wrapper">
        <footer>
            <ul class="footer-links-main">
                <li><a href="#">Home</a></li>
                <li><a href="#">Cases</a></li>
                <li><a href="#">Portfolio</a></li>
                <li><a href="#">About me</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
            <ul class="footer-links-cases">
                <li><a href="#">LATEST CASES</a></li>
                <li><a href="#">MALING SHAOLIN - WEB DEVELOPMENT</a></li>
                <li><a href="#">EXCELLENTO - WEB DEVELOPMENT, SEO</a></li>
                <li><a href="#">MMTUTS - YOUTUBE CHANNEL</a></li>
                <li><a href="#">WELTEC - VIDEO PRODUCTION</a></li>
            </ul>
            <div class="footer-sm">
                <a href="#">
                    <img src="img/youtube-symbol.png" alt="youtube icon">
                </a>
                <a href="#">
                    <img src="img/twitter-logo-button.png" alt="youtube icon">
                </a>
                <a href="#">
                    <img src="img/facebook-logo-button.png" alt="youtube icon">
                </a>
            </div>
        </footer>
    </div>
</main>
</body>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
<?php include 'js/main-js.php' ?>
<!--<script type="text/javascript" src="js/main.js?v=--><?php //echo time()?><!--"></script>-->
<!--<script type="text/javascript">-->
<!--    $(document).ready(function () {-->
<!--        --><?php
//        //Find userid by session
//        if (isset($_SESSION['user_name'])) {
//            $username = $_SESSION['user_name'];
//            $sqlGetLikedUser = "SELECT * FROM users WHERE username='$username'";
//            $result = $conn->query($sqlGetLikedUser);
//            if ($result->num_rows == 1) {
//                $user = $result->fetch_assoc();
//                $userid = $user['userid'];
//            }
//        } ?>
//        $(".like").click(function () {
//            var imgid = $(this).closest("form").attr("id");
//            var i = $(this).children("img").attr("src");
//            if (i == "img/heart-icon.png") {
//                $(this).children("img").attr("src", "img/red-heart.png");
//            } else if (i == "img/red-heart.png") {
//                $(this).children("img").attr("src", "img/heart-icon.png");
//            }
//            $("#" + imgid).children("span").load("includes/like.php", {
//                imageid: imgid,
//                liked: <?php //echo $userid?>
//            });
//        });
//    });
<!--</script>-->
</html>