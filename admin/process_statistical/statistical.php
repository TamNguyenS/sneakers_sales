<?php
require '../root/checklogin.php';
?>
<?php
require_once '../db.php';
require_once '../func.php';
?>
<?php 
$count_product = get_count("SELECT count(*) FROM product");

?>