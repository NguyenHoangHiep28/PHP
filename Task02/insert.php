<html lang="en">
<head>
    <title>Personalized Greeting Form</title>
    <style>
        form {
            width: 20%;
            padding: 10px;
            position: fixed;
            top: 0;
            float: left;
        }

        form fieldset {
            padding-top: 25px;
        }

        form fieldset legend {
            font-weight: bold;
        }

        form input {
            width: 80%;
            margin: 5px 5px 5px 25px;

        }
        form input[type=radio]{
            width: 10%;
            display: inline-block;
            margin: 0px 50px 20px 10px;

        }
        form#search #title-search-block{
            display: none;
        }
        form input[type='submit'] {
            width: 40%;
            display: inline-block;

        }

        table {
            position: relative;
            background-color: transparent;
            text-align: center;
        }

        table tr#fist-row {
            background-color: #cccccc;
            color: #333333;
        }

        table tr#second-row {
            font-weight: bold;
        }

        table tr#fist-row h3 {
            margin-top: 10px;
            font-family: fantasy;
        }
        table tr#fist-row form {
            display: inline-block;
            position: relative;
            float: right;
            padding: 0;
            margin-right: 20px;
        }
        table tr#fist-row form input {
            margin: 0;
            width: 100%;
            height: 30px;
            text-align: center;
            font-weight: bold;
            color: #333333;
            border-radius: 50%;
        }
        form#delete {
            position: fixed;
            right: 0;
        }
        form#search {
            position: fixed;
            right: 0;
            top: 35%;
        }
    </style>
</head>

<body>
<?php
$bookId = "";
$authorId = '';
$title = "";
$ISBN = "";
$pub_year = "";
$available = "";
$src = "";

if (!empty($_POST['bookId'])) {
    $bookId = $_POST['bookId'];
}

if (!empty($_POST['authorId'])) {
    $authorId = $_POST['authorId'];
}

if (!empty($_POST['title'])) {
    $title = $_POST['title'];
}

if (!empty($_POST['ISBN'])) {
    $ISBN = $_POST['ISBN'];
}

if (!empty($_POST['pub_year'])) {
    $pub_year = $_POST['pub_year'];
}

if (!empty($_POST['available'])) {
    $available = $_POST['available'];
}
if (!empty($_POST['src'])) {
    $src = $_POST['src'];
}
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <fieldset>
        <legend>Book Information:</legend>
        Book id: <br/><input type="text" name="bookId" required="required"/><br/>
        Author id: <br/><input type="text" name="authorId" required="required"/><br/>
        Title: <br/><input type="text" name="title" required="required"/><br/>
        ISBN: <br/><input type="text" name="ISBN" required="required"/><br/>
        Public Year: <br/><input type="text" name="pub_year" required="required"/><br/>
        Available: <br/><input type="text" name="available" required="required"/><br/>
        Image: <br/><input type="text" name="src" required="required"/><br/>
        <br/><input type="submit" value="Add Book">
    </fieldset>
</form>
<?php
$myDB = new mysqli('localhost', 'root', '', 'library');
if ($myDB->connect_error) {
    die('Connect Error (' . $myDB->connect_errno . ') '
        . $myDB->connect_error);
}

if ($title != '' && $ISBN != '') {
    $insert = "INSERT INTO books(bookId, authorId, title, ISBN, pub_year, available, src) 
                VALUES ($bookId,$authorId,'$title','$ISBN',$pub_year,$available,'$src')";
    echo $insert;
    $success = $myDB->query($insert);
    if ($success) {
        echo "New record created successfully";
    }
}

?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="delete">
    <fieldset>
        <legend>Delete Information</legend>
        Book id: <br/><input type="text" name="bookId" required="required"/><br/>
        Title: <br/><input type="text" name="title" required="required"/><br/>
        <br/><input type="submit" value="Delete Book">
    </fieldset>
</form>
<?php
if ($bookId != '' && $title != '' && $authorId == '' && $ISBN == ''
    && $pub_year == '' && $available == '' && $src == '') {
    $deleteSql = "DELETE FROM books WHERE bookId = $bookId AND title = '$title'";
    $complete = $myDB->query($deleteSql);
    if ($complete){
        echo 'Delete successfully';
    }
}
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="search">
    <fieldset>
        <legend>Search Information</legend>
        <label>Book id<input type="radio" name="searchby" value="bookid" checked onclick="displaySearch('bookid-search-block')"></label>
        <label>Title<input type="radio" name="searchby" value="title" onclick="displaySearch('title-search-block')"></label>
        <br>
        <div class="search-options" id="bookid-search-block">
        Book id: <br/><input type="text" name="bookId" class="search-box"/><br/>
        </div>
        <div class="search-options" id="title-search-block">
        Title: <br/><input type="text" name="title" class ="search-box"/><br/>
        </div>
        <br/><input type="submit" value="Search Book">
    </fieldset>
</form>
<?php
if (($bookId != '' || $title != '') && ($authorId == '' && $ISBN == ''
    && $pub_year == '' && $available == '' && $src == '')) {
    if ($bookId!=''){
        $searchSql = "SELECT * FROM books WHERE bookId = $bookId";
    } else if($title != ''){
        $searchSql = "SELECT * FROM books WHERE title LIKE '%$title%'";
    }
    $result = $myDB->query($searchSql);
}
?>
<table cellspacing="2" cellpadding="6" align="center" border="1">
    <tr id="fist-row">
        <td colspan="5">
            <h3 align="center">These Books are currently available</h3>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>", method="post">
                <input type="submit" value="Show All Book">
            </form>
            <?php
            if ($bookId == '' && $title == '' && $authorId == '' && $ISBN == ''
            && $pub_year == '' && $available == '' && $src == ''){
                $sql = "SELECT * FROM books WHERE available = 1 ORDER BY title";
                $result = $myDB->query($sql);
            }
            ?>
        </td>
    </tr>
    <tr id="second-row">
        <td align="center">Id</td>
        <td align="center">Title</td>
        <td align="center">Year Publisher</td>
        <td align="center">ISBN</td>
        <td align="center">Image</td>
    </tr>
    <?php
    if ($result->num_rows <= 0){
        $sql = "SELECT * FROM books WHERE available = 1 ORDER BY title";
        $result = $myDB->query($sql);
    }
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td align='center'>";
        echo $row["bookId"];
        echo "</td>";
        echo "<td>";
        echo $row["title"];
        echo "</td><td align='center'>";
        echo $row["pub_year"];
        echo "</td><td>";
        echo $row["ISBN"];
        echo "</td><td>";
        echo "<img src='";
        echo $row["src"];
        echo "' width='156px' height='156px'/></td>";
        echo "</tr>";
    }
    ?>
</table>
</body>
<script>
    function displaySearch(optionName) {
        var content;
        content = document.getElementsByClassName("search-options");
        for (var i = 0; i < content.length; i++) {
            content[i].style.display = "none";
        }
        document.getElementById(optionName).style.display = "block";
        var inputs = document.getElementsByClassName("search-box");
        for (var j = 0; j<inputs.length; j++){
            inputs[j].value ='';
        }
    }
</script>
</html>
