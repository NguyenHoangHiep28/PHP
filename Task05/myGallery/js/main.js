$(document).ready(function () {
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
});