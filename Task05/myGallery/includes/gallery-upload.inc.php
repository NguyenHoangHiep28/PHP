<?php
session_start();
if (isset($_POST['submit'])) {
    $newFileName = $_POST['filename'];
    if (empty($newFileName)) {
        $newFileName = "gallery";
    } else {
        $newFileName = strtolower(str_replace(" ", "-", $newFileName));
    }
    $imageTitle = $_POST['filetitle'];

    $file = $_FILES['file'];

    $fileName = $file["name"];
    $fileType = $file["type"];
    $fileTempName = $file["tmp_name"];

    $fileError = $file['error'];
    $fileSize = $file["size"];

    $fileExt = explode(".", $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array("jpg", "jpeg", "png");

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 7000000) {
                $imageFullName = $newFileName . "." . uniqid("", true) . "." . $fileActualExt;
                $fileDestination = "../img/gallery/" . $imageFullName;

                include_once 'dbh.inc.php';

                if (empty($imageTitle)) {
                    header("Location: ../index.php?upload=empty");
                    exit();
                } else {
                    $sql = "SELECT * FROM images;";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        echo "SQL statement failed!";
                    } else {
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        $rowCount = mysqli_num_rows($result);
                        $setImageOrder = $rowCount + 1;

                        $sql = "INSERT INTO images(title, imgFullName, orderGallery) VALUES (?, ?, ?);";
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            echo "SQL statement failed";
                        } else {
                            mysqli_stmt_bind_param($stmt, "ssi",$imageTitle, $imageFullName, $setImageOrder);
                            mysqli_stmt_execute($stmt);

                            move_uploaded_file($fileTempName, $fileDestination);
                            if (!empty($_SESSION['user_name'])) {
                                $userid = "";
                                $username = $_SESSION['user_name'];
                                $findUserSql = "SELECT * FROM users WHERE username = '$username';";
                                $findUser = $conn->query($findUserSql);
                                if ($Num = $findUser->num_rows > 0) {
                                    $user = $findUser->fetch_assoc();
                                    $userid = $user['userid'];
                                } else {
                                    echo "failed!";
                                }
                                $findImgIdSql = "SELECT * FROM images WHERE orderGallery = $setImageOrder";
                                $findImgId = $conn->query($findImgIdSql);
                                if ($numRow = $findImgId->num_rows > 0) {
                                    $img = $findImgId->fetch_assoc();
                                    $imageid = $img['imageid'];
                                } else {
                                    echo "failed!";
                                }
                                $insertSql = "INSERT INTO userpostimages (userid, imageid) VALUES ($userid, $imageid);";
                                $conn->query($insertSql);
                                header("Location: ../index.php?upload=success");
                            }
                        }
                    }
                }
            } else {
                echo "File size is too big!";
                exit();
            }
        } else {
            echo "You had an error!";
            exit();
        }
    } else {
        echo "You need to upload a proper file type!";
    }
}
?>