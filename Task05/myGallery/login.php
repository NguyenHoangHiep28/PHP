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
            <li><a href="index.php">Home Page</a></li>
            <li><a href="about.html">Discover</a></li>
            <li><a href="contact.html">Charts</a></li>
            <li><a href="<?php if (!isset($_SESSION['user_name'])) {
                    echo 'login.php?upload=y';
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
        }
        ?>
    </nav>
</header>
<main>

    <div class="container page-top">

        <div class="login-section">
            <div class="container">
                <div class="row" style="margin-top: 50px">
                    <div class="col-lg-6 form-wrapper">
                        <div class="login-form">
                            <h2>Login</h2>
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                <div class="error-message"><span class="text-danger"><?php if (isset($message)) {
                                            echo $message;
                                        } ?></span></div>
                                <div class="log-input-group">
                                    <label for="username">Name *</label>
                                    <input type="text" id="username" name="username" required="required"
                                           value="<?php if (!empty($_COOKIE["user_login"])) {
                                               echo $_COOKIE["user_login"];
                                           } ?>">
                                </div>
                                <div class="log-input-group">
                                    <label for="password">Password *</label>
                                    <input type="password" id="password" name="password" required="required"
                                           value="<?php if (!empty($_COOKIE["pass_word"])) {
                                               echo $_COOKIE["pass_word"];
                                           } ?>">
                                </div>
                                <div class="check-pass">
                                    <label for="save-pass">
                                        Save Password
                                        <input type="checkbox" id="save-pass"
                                               name="save-password" <?php if (!empty($_COOKIE["user_login"]) && !empty($_COOKIE["pass_word"])) { ?> checked <?php } ?>>
                                    </label>
                                    <a href="#" class="forget-pass">Forget Your Password</a>
                                </div>
                                <button type="submit" class="login-btn" name="login">Sign In</button>
                            </form>
                        </div>
                        <div class="register-switch">
                            <a href="signup.php" id="res-switch-link">or create an account</a>
                        </div>
                    </div>
                    <?php
                    include 'includes/dbh.inc.php';
                    session_start();
                    if (!empty($_POST['username']) && !empty($_POST['password'])) {
                        $username = $_POST['username'];
                        $password = $_POST['password'];
                        $sql = "SELECT * FROM users WHERE username = '$username'";
                        if (!isset($_COOKIE["user_login"])) {
                            $sql .= " AND password = '$password'";
                        }
                        $result = mysqli_query($conn, $sql);
                        $user = mysqli_fetch_array($result);
                        if ($user) {
                            $_SESSION["user_name"] = $user['username'];
                            if (!empty($_POST["save-password"])) {
                                setcookie("user_login", $username, time() + (10 * 365 * 24 * 60 * 60));
                                setcookie("pass_word", $password, time() + (10 * 365 * 24 * 60 * 60));
                            } else {
                                if (empty($_COOKIE["user_login"])) {
                                    setcookie("user_login", "");
                                    setcookie("pass_word", "");
                                }
                            }
                            $host = $_SERVER['HTTP_HOST'];
                            $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                            $extra = 'index.php';
                            header("Location: http://$host$uri/$extra");
                            exit();
                        } else {
                            $message = "Invalid Login";
                        }
                    }
                    ?>
                </div>
                <div class="row">
                    <div class="col-lg-6 welcome-section">
                        <div class="welcome-text">
                            <h2>Join 12 million others</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
</html>
