
<?php
require_once '../db.php';
require_once '../func.php';
?>
<?php 
$id = $_POST['id'];
?>
<?php 
$dateorder = isset($_POST['thistime']) ? $_POST['thistime'] : '';
if( $dateorder == 'month'){
    require_once '../root/chartmonth.php';
}
?>
