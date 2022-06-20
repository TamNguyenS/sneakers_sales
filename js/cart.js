var nav_cart_user = $(".navbar");
var drop_user = $(".drop-user");
var bool = true;
var bool1 = true;
var nav_mobi_main = $(".main-menu-mobile");
var menu_mobile = $("#_btn")
$(document).ready(function () {
  $(".click-cart").click(function () {
    nav_cart_user.addClass("active");
    console.log("clicked");
  });
  $("#close").click(function () {
    nav_cart_user.removeClass("active");
  });
  $(".close-cart").click(function () {
    nav_cart_user.removeClass("active");
  });
  $(".click-user").click(function () {
    if (bool == true) {
      drop_user.addClass("active1");
      bool = false;
      console.log("clicked1");
    } else {
      drop_user.removeClass("active1");
      console.log("clicked12");
      bool = true;
    }
  });
  $(".mobi-nav").click(function () {
    nav_mobi_main.removeClass("active-menu");
    console.log(" mbinav clicked");
  });
  $(".close-moblie").click(function () {
    nav_mobi_main.addClass("active-menu");
    console.log(" close-moblie");
  });
  menu_mobile.click(function () {
    
    if (bool == true) {
        $(".nav-child-menu").css("display","block");
        bool = false;
      } else {
        $(".nav-child-menu").css("display","none");
        bool = true;
      }
  });
});

