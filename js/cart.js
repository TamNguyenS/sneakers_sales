var nav_cart_user = $('.navbar');
var drop_user = $('.drop-user');
var bool = true;
$(document).ready(function() {
    $('.click-cart').click(function() {
        nav_cart_user.addClass("active");
        console.log("clicked");
       
    });
    $('#close').click(function() {
        nav_cart_user.removeClass("active");
    });
    $('.close-cart').click(function() {
        nav_cart_user.removeClass("active");
    });
        $('.click-user').click(function() {
            if(bool == true){
                drop_user.addClass("active1");
                bool = false;
                console.log("clicked1");
            }
            else{
                drop_user.removeClass("active1");
                console.log("clicked12");
                bool = true;
            }
        });

   
});