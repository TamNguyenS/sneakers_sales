<?php
require_once'../admin/process_root/check_session.php';
$id = $_POST['id'];
$quantity = $_POST['quantity'];
if (!empty($_SESSION['cart'])) {
    $_SESSION['cart'][$id]['quantity']=$quantity;
    $price = $_SESSION['cart'][$id]['quantity'] * $_SESSION['cart'][$id]['cost'] * (1-(int)$_SESSION['cart'][$id]['sale']/100);
    echo number_format($price, 0, '', ',') ;
    echo '
    <span class="cost">đ</span>
    ';
}
?>