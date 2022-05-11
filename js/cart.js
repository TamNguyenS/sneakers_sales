var nav_cart_user = $('.navbar');
$(document).ready(function() {
    $('.click-cart').click(function() {
        nav_cart_user.addClass("active");
    });
    $('#close').click(function() {
        nav_cart_user.removeClass("active");
    });
    $('.close-cart').click(function() {
        nav_cart_user.removeClass("active");
    });
});