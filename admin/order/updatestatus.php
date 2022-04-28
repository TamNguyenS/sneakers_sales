
<?php
require_once '../db.php';
require_once '../func.php';
?>

<?php
$id_order = empty($_GET['id']) ? 'false' : $_GET['id'];
$status = empty($_GET['status']) ? 'false' : $_GET['status'];
date_default_timezone_set('Asia/Ho_Chi_Minh');
$today = date("Y-m-d H:i:s");   
if($id_order!=false 
&& $status !=false

){
    $result = update('orders', array(
        'status'  => $status,
        'time_accept' => $today
          ), "id =$id_order");

    if($result){
        $msg = 'Cập nhật thành công';
        header('location: index.php');
    }
}
?>
