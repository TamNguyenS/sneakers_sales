
<?php
require_once '../db.php';
require_once '../func.php';
?>
<?php
$id= $_GET['id'];
$sale= $_GET['sale'];
 $result = update('product', array(
    'sale'  => $sale,
), "id =$id");
?>