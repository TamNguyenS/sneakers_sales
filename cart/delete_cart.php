<?php 
require_once'../admin/process_root/check_session.php';
$id = $_GET['id'];
if (!empty($_SESSION['cart'])) {
    unset($_SESSION['cart'][$id]);
    header('Location:./');
    exit();
}
?>