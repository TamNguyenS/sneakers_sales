<?php
require_once '../admin/process_root/check_session.php';
require_once '../admin/db.php';
require_once '../admin/func.php';



$type_id = isset($_POST['type_id']) ? $_POST['type_id'] : '';

$query = "SELECT name from type WHERE id = '$type_id'";

$result= get_list($query);
if($type_id ==''){
    echo '
    <h3>Tất cả sản phẩm <span style="font-size:15px; font-weight:normal; color:gey"></span></h3>
<br>
    
    ';
    die();
}
?>

<h3><?= $result[0]['name']?><span style="font-size:15px; font-weight:normal; color:gey"></span></h3>
<br>