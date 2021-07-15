<?php session_start();
$like= 10;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>My Portfolio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900|Cormorant+Garamond:300,300i,400,400i,500,500i,600,600i,700,700i"
          rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"  media="screen">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="styles/style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css"/>
</head>
<body>
<header>
    <a href="index.php" class="header-brand">ygallery</a>
    <nav>
        <ul>
            <li><a href="index.php">Home Page</a></li>
            <li><a href="about.html">Discover</a></li>
            <li><a href="contact.html">Charts</a></li>
            <li><a href="<?php if (!isset($_SESSION['user_name'])) {
                    echo 'login.php';
                } else {
                    echo 'usergallery';
                } ?>" class="upload-link" style="background-color: #0b7dda;">Upload Images</a></li>
        </ul>
        <?php
        if (isset($_SESSION['user_name'])) {
            $username = $_SESSION['user_name'];
            echo '<a href="includes/gallery-login.inc.php" class="header-cases"><i class="fa fa-user-circle fa-lg" aria-hidden="true">';
            echo '</i><span style="font-size: 14px"> ' . $username . '</span></a>';
        } else {
            echo '<a href="login.php" class="header-cases">Join</a>';
        }
        ?>
    </nav>
</header>
<main>
    <section class="upload">
        <div class="upload-form">
            <h2 id="upload-title">upload your image</h2>
            <form action="includes/gallery-upload.inc.php" method="post" enctype="multipart/form-data">
                <input type="text" name="filename" placeholder="File name..."><br>
                <input type="text" name="filetitle" placeholder="Image title..."><br>
                <input type="file" name="file"><br>
                <button type="submit" name="submit">UPLOAD</button>
            </form>
        </div>
    </section>
    <section class="user-gallery">
        <div class="container-fluid">
            <h4 style="margin-bottom: 50px;text-align: center;"><?php echo $_SESSION['user_name']; ?>'s Gallery</h4>
            <div class="row">
                <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                    <a class="fancybox" rel="fancybox-thumb"
                       href="https://images.pexels.com/photos/62307/air-bubbles-diving-underwater-blow-62307.jpeg?auto=compress&cs=tinysrgb&h=650&w=940"
                       title="Golden Manarola (Sanjeev Deo)1">
                        <img src="https://images.pexels.com/photos/62307/air-bubbles-diving-underwater-blow-62307.jpeg?auto=compress&cs=tinysrgb&h=650&w=940"
                             class="zoom img-fluid " alt="">
                    </a>
                    <div class="content-box">
                        <form method="post" class="author-likes">
                            <a href="" class="author-block" ><i class="fa fa-user-circle fa-lg author-img"
                                                                aria-hidden="true"></i>username</a>
                            <button type="submit" class="like-btn"><i class="fa fa-heart-o fa-lg "
                                                                      aria-hidden="true"></i></button>
                            <input type="text" class="like-number" value="<?php echo $like ?>" readonly >
                        </form>
                        <p class="img-title text-truncate">Title Golden Manarola (Sanjeev Deo)1</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                    <a href="https://images.pexels.com/photos/38238/maldives-ile-beach-sun-38238.jpeg?auto=compress&cs=tinysrgb&h=650&w=940"
                       class="fancybox" rel="fancybox-thumb" title="Golden Manarola (Sanjeev Deo)">
                        <img src="https://images.pexels.com/photos/38238/maldives-ile-beach-sun-38238.jpeg?auto=compress&cs=tinysrgb&h=650&w=940"
                             class="zoom img-fluid" alt="">
                    </a>
                </div>

            </div>
        </div>
    </section>

</main>
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
</body>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!--<script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>-->
<script src="js/jquery.fancybox.pack.js"></script>
<script src="js/main.js"></script>
<script src="js/jquery.fancybox.pack.js"></script>
<script src="js/jquery.fancybox-thumbs.js"></script>
<script type="text/javascript">
    <?php
    $like = 10;
    ?>
    $(document).ready(function () {
        $(".fancybox").fancybox({
            type: "html",
            arrow: false,
            beforeShow: function () {
                $('.fancybox-inner').html('<img style="max-width:700px" src="' + this.href + '" alt="" />');
                $('.fancybox-inner').prepend('<form style="text-align: center; margin-bottom: 20px" method="get">' +
                    '<a href="#" class="author-block"><i class="fa fa-user-circle fa-lg author-img" aria-hidden="true" ></i>username</a>' +
                    '<button type="submit" class="like-btn"><i class="fa fa-heart-o fa-lg " aria-hidden="true" ></i></button>' +
                    '<input type="text" value="<?php echo $like?>" readonly class="like-number"></form>');
                $.fancybox.update();
            }
        });
    });
</script>
</html>
