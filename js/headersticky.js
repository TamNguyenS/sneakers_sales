var yourNavigation = $(".bottom-header");
var logo = $('.logo-bottom');
stickyDiv = "sticky";
yourHeader = $('.mid-header').height();

$(window).scroll(function() {
    if ($(this).scrollTop() > yourHeader) {
        yourNavigation.addClass(stickyDiv);

        $(".logo-bottom").css("display", "block");
        $(".cart-second ").css("display", "block");
        
    } else {
        yourNavigation.removeClass(stickyDiv);
        $(".logo-bottom").css("display", "none");
        $(".cart-second ").css("display", "none");

    }
});