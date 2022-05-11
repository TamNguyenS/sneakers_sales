<?php
require_once'../admin/process_root/check_session.php';

if (!empty($_SESSION['cart'])) {
    $total = 0;
    $cart = $_SESSION['cart'];
    foreach ($cart as $value) {
        $total += $value['quantity'];
    }
    echo $total;
}
if(empty($_SESSION['cart'])){
    echo 0;
}

?>