
<?php
require_once '../db.php';
require_once '../func.php';
?>
<?php
$id_order = empty($_GET['id']) ? 'false' : $_GET['id'];
$status = empty($_GET['status']) ? 'false' : $_GET['status'];
date_default_timezone_set('Asia/Ho_Chi_Minh');
$today = date("Y-m-d H:i:s");   
?>
<?php 


$query = "SELECT product.id  AS product_id ,product.sold AS product_sold,
product.quantity AS product_quantity, orders_detail.quantity AS quantity_order
FROM (((product INNER JOIN orders_detail ON product.id = orders_detail.product_id)
INNER JOIN orders ON orders_detail.orders_id = orders.id))
WHERE orders.id = $id_order";
$result_records = get_list($query);


if($id_order!=false 
&& $status !=false


){
    $result_status = update('orders', array(
        'status'  => $status,
        'time_accept' => $today
          ), "id =$id_order");

          for ($i = 0; $i < count($result_records); $i++) {
            $product_quantity = $result_records[$i]['product_quantity'] - $result_records[$i]['quantity_order'];
            $product_sold = $result_records[$i]['product_sold'] + $result_records[$i]['quantity_order'];
            $product_id = $result_records[$i]['product_id'];
            $result_product = update('product', array(
                'quantity'  => $product_quantity,
                'sold' => $product_sold
            ), "id =$product_id");
    
        }


    if($result_status){
        $msg = 'Cập nhật thành công';
        header('location: index.php');
    }
}
?>
