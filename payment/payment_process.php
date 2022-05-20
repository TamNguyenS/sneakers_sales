<?php 
require_once '../admin/process_root/check_session.php';
require_once '../admin/db.php';
require_once '../admin/func.php';

$id = $_SESSION['id_user'];
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$note = $_POST['note'];
$total = $_POST['total'];
$address1 = $_POST['address1'];
$address = $_POST['address'];
date_default_timezone_set('Asia/Ho_Chi_Minh');
$today = date("Y-m-d H:i:s"); 
$dres = " $address, $address1 ";
// die();
// echo"$id $name $phone $email $note $address";
$token = uniqid($id . '_client', true);
$result = insert('orders', array(
    'recipient_id' => $id,
    'recipent_name' => $name,
    'recipent_address' => $dres,
    'recipent_phone' => $phone,
    'recipent_email' => $email,
    'total_cost' => $total,
    'note' => $note,
    'status' => 0,
    'time_order' => $today,
    'token' => $token
));

$sql = "SELECT id FROM orders WHERE token = '$token' LIMIT 1";
$result1 = get_list($sql);
$id_order = $result1[0]['id'];


$cart = $_SESSION['cart'];
print_r($cart);
foreach ($cart as $key => $value) {
    $id_product = $key;
    $quantity = $value['quantity'];
    $result2 = insert('orders_detail', array(
        'orders_id' => $id_order,
        'product_id' => $id_product,
        'quantity' => $quantity
    ));
    echo $id_product;
    echo $quantity;
}
// for ($i=0; $i < count($cart); $i++) { 
//    echo $cart[$i]['id'];
//    echo $cart[$i]['quantity'];

   
// }
header('location: ./sucess.php?id='.$id_order);
exit();

?>