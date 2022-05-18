<?php
session_start();
setcookie('token_remem', false, -99, '/', '', 0);
print_r($_COOKIE);

session_destroy();
try{
    if ($_COOKIE['token_remem'] == false || empty($_COOKIE['token_remem'])) {
        print_r($_COOKIE);
        header('Location: ../product');
        exit();
       
    } else {
        print_r($_COOKIE);
        echo "false";
        header('Location: ../product');
        exit();
    }
    
}
catch (Exception $e) {
    header('root: ../admin/root/404.php');
    exit();
}
?>
