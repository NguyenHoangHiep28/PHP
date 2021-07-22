<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Fpt-Aptech library</title>
        <meta charset="UTF-8">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div class="wrapper">
            <div class="container">
                    <h2><a href="index.php">FPT-Aptech library <i class="fa fa-book"></i></a></h2>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" style="width: 600px">
                    <div class="form-group">
                        <label for="name">Search book by title: </label>
                        <input type="text" class="form-control" name="title" id="name">
                        <button type="submit" class="btn primary-btn">
                            <i class="fa fa-search"></i> Search
                        </button>
                    </div>
                </form>
                <div class="row">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-dark">
                            <th>Title</th>
                            <th class="text-center">Author</th>
                            <th class="text-center">ISBN</th>
                            <th class="text-center">Publication Year</th>
                            <th class="text-center">Available</th>
                        </thead>
                        <tbody>
                            <?php
                                include 'includes/dbh.inc.php';
                                if (isset($_POST['title'])){
                                    $title = $_POST['title'];
                                    $sql = "SELECT * FROM books WHERE title LIKE '%$title%';";
                                }else {
                                    $sql = "SELECT * FROM books ORDER BY title";
                                }
                                $result = $conn->query($sql);
                                if ($result->num_rows >0){
                                    while ($row = $result->fetch_assoc()){
                                        echo '<tr>';
                                            echo '<td>'.$row['title'].'</td>';

                                            //find author name by id
                                            $authorId = $row['authorid'];
                                            $sqlFindAuthor = "SELECT * FROM authors WHERE authorid = $authorId";
                                            $authorResult = $conn->query($sqlFindAuthor);
                                            while ($record = $authorResult->fetch_assoc()){
                                                if ($record['authorid'] === $authorId){
                                                    $authorName = $record['name'];
                                                }
                                            }

                                            echo '<td class="text-center">'.$authorName.'</td>';
                                            echo '<td class="text-center">'.$row['ISBN'].'</td>';
                                            echo '<td class="text-center">'.$row['pub_year'].'</td>';
                                            if ($row['available'] == 1){
                                                $available = "Yes";
                                            }else {
                                                $available = "No";
                                            }
                                            echo '<td class="text-center">'.$available.'</td>';
                                        echo '</tr>';
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>