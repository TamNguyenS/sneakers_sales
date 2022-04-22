<?php
session_start();
// setcookie('remember1sdsd', false, -1);;
setcookie('remember1', false, -99, '/', '', 0);
print_r($_COOKIE);
session_destroy();
if ($_COOKIE['remember1'] == false) {
    print_r($_COOKIE);
    echo "Đã xãy ra một số lỗi";
    die();
    //   header('Location: ../');
    exit();
} else {
    print_r($_COOKIE);
    echo "false";
    header('Location: ../');

}
