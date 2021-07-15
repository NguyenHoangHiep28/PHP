<?php
if (isset($_SESSION['user_name'])) {
    $username = $_SESSION['user_name'];
    $sqlGetLikedUser = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sqlGetLikedUser);
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        $userid = $user['userid'];
    }
}
?>
<script type="text/javascript">
    $(".fancybox").fancybox({
        type: "html",
        beforeShow: function () {
            $('.fancybox-inner').html('<img style="max-width:700px" src="' + this.href + '" alt="" />');
            $('.fancybox-inner').prepend('<form style="text-align: center; margin-bottom: 20px" method="get">' +
                '<a href="#" class="author-block"><i class="fa fa-user-circle fa-lg author-img" aria-hidden="true" ></i>username</a>' +
                '<button type="submit" class="like-btn"><i class="fa fa-heart-o fa-lg " aria-hidden="true" ></i></button>' +
                '<input type="text" value="" readonly class="like-number"></form>');
            $.fancybox.update();
        }
    });
    var imageCount = 12;
    $("#load-more").click(function () {
        imageCount += 4;
        $(".row").load("includes/gallery-load-more.inc.php", {
            imageNewCount: imageCount
        });
    });
    $(".zoom").hover(function () {

        $(this).addClass('transition');
    }, function () {

        $(this).removeClass('transition');
    });
    $(".zoom").hover(function () {
        $(this).closest("div").find('.content-box').toggleClass('to-bot');
    });
        //Find userid by session
        $(".like").click(function () {
            var imgid = $(this).closest("form").attr("id");
            var i = $(this).children("img").attr("src");
            if (i == "img/heart-icon.png") {
                $(this).children("img").attr("src", "img/red-heart.png");
            } else if (i == "img/red-heart.png") {
                $(this).children("img").attr("src", "img/heart-icon.png");
            }
            $("#" + imgid).children("span").load("includes/like.php", {
                imageid: imgid,
                liked: <?php echo $userid?>
            });
        });
</script>