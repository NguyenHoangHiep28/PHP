<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Gallery</title>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900|Cormorant+Garamond:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
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
            <li><a href="login.php" class="upload-link">Upload Images</a></li>
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
        <div class="register-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 form-wrapper">
                        <div class="register-form">
                            <h2>Register</h2>
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                <div class="log-input-group">
                                    <label for="username">Name *
                                        <?php
                                        include 'includes/dbh.inc.php';
                                        if (isset($_POST['username']) && isset($_POST['password']) & isset($_POST['confirm-password'])) {
                                            $username = $_POST['username'];
                                            $sql = "SELECT * FROM users WHERE username='$username'";
                                            $result = mysqli_query($conn, $sql);
                                            $found = mysqli_num_rows($result);
                                            if ($found > 0) {
                                                echo '<span class="text-danger" style="display:block;">This name was used!</span>';
                                            }
                                        }
                                        mysqli_close($conn);
                                        ?>
                                    </label>
                                    <input type="text" id="username" name="username"
                                           value="<?php if (isset($username)) {
                                               $username = $_POST['username'];
                                               echo $username;
                                           } ?>"
                                           required="required">
                                </div>
                                <div class="log-input-group">
                                    <label for="password">Password *
                                        <?php
                                        if (isset($_POST['username']) && isset($_POST['password']) & isset($_POST['confirm-password'])) {
                                            $password = $_POST['password'];
                                            $confirmPass = $_POST['confirm-password'];
                                            if (strlen($password) < 8) {
                                                echo '<span class="text-danger" style="display:block;">Password is too short !</span>';
                                            }
                                        }
                                        ?>
                                    </label>
                                    <input type="password" id="password" name="password" required="required">
                                </div>
                                <div class="log-input-group">
                                    <label for="confirm-password">Confirm Password *
                                        <?php
                                        if (isset($_POST['username']) && isset($_POST['password']) & isset($_POST['confirm-password'])) {
                                            $password = $_POST['password'];
                                            $confirmPass = $_POST['confirm-password'];
                                            if ($password != $confirmPass) {
                                                echo '<span class="text-danger" style="display:block;">Incorrect confirm password !</span>';
                                            }
                                        }
                                        ?>
                                    </label>
                                    <input type="password" id="confirm-password" name="confirm-password"
                                           required="required">
                                </div>
                                <button type="submit" class="login-btn">Register</button>
                            </form>
                        </div>
                        <div class="login-switch">
                            <a href="login.php" id="log-switch-link">or login</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 welcome-section">
                        <div class="welcome-text" style="">
                            <h2>Welcome to YGALLERY !</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    include 'includes/dbh.inc.php';

    if (isset($_POST['username']) && isset($_POST['password']) & isset($_POST['confirm-password'])) {
        $username = $_POST['username'];
        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($conn, $sql);
        $found = mysqli_num_rows($result);
        if ($found <= 0) {
            $password = $_POST['password'];
            $confirmPass = $_POST['confirm-password'];
            if (strlen($password) >= 8 && $password === $confirmPass) {
                $username = $_POST['username'];
                $sql = "INSERT INTO users (username, password) VALUES (?,?);";
                if ($statement = mysqli_prepare($conn, $sql)) {
                    mysqli_stmt_bind_param($statement, 'ss', $username_param, $password_param);
                    //set params
                    $username_param = $username;
                    $password_param = $password;
                    if (mysqli_stmt_execute($statement)) {
                        //insert successfully
                        $host = $_SERVER['HTTP_HOST'];
                        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                        $extra = 'login.php';
                        header("Location: http://$host$uri/$extra");
                        exit;
                    } else {
                        echo "Something went wrong!";
                    }
                }
                mysqli_stmt_close($statement);
            }
            mysqli_close($conn);
        }
    }
    ?>
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
