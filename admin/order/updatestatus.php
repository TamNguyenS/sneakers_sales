
<?php
require_once '../db.php';
require_once '../func.php';
require_once '../process_root/check_session.php';
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

          
        require '../order/mail.php';
        $title=" $id_order";
        $noti= "";
        if($status==1){
            $noti="Đơn hàng đã được xác nhận";
        }else if($status==2){
            $noti="Đơn hàng đã bị hủy";
        }

        $content ="<h1>$noti</h1> <i>Vào lúc $today</i> <br> <h3> 
                <h2>Cảm ơn bạn đã đến với Hikkywannfly</h2>
                Thông tin đơn hàng </h3>
                <p>Mã đơn hàng: $id_order</p>
                <p>Chi tiết đơn hàng <a href='https://www.youtube.com/watch?v=dQw4w9WgXcQ'>xem tại đây</a></p>
        ";
         $query4 = "SELECT product.id AS product_id, product.name AS product_name,product.cost AS product_cost,
                     orders_detail.quantity AS quantity, orders.* ,
            customer.name as customer_name, customer.email as customer_email,
            customer.phone as customer_phone, customer.address as customer_address 
            FROM ((((product LEFT JOIN orders_detail ON product.id = orders_detail.product_id)
            LEFT JOIN orders ON orders_detail.orders_id = orders.id))
            LEFT JOIN customer ON orders.recipient_id = customer.id)
                WHERE orders.id = '$id_order'";
        $result_records4 = get_list($query4);
        foreach($result_records4 as $record) {
            $cost =  number_format($record['product_cost'] , 0, '', ',');
            $content .= "<p>Tên sản phẩm:  $record[product_name]</p>";
            $content .= "<p>Số lượng:  $record[quantity]</p>";
            $content .= "<p>Giá:    $record[product_cost]</p>";
            $content .= "<hr>";
           
        }
        $total_cost = number_format($record['total_cost'], 0, '', ',');
        $content .= "<p>Tổng tiền:<span style='color:red; font-weight:bold;'> $total_cost </span> <span class='cost'>đ</p>";


        $query = "SELECT * from orders where id = $id_order";
        $result_records_order = get_list($query);
      
        mailHikky($result_records_order[0]['recipent_email'], $result_records_order[0]['recipent_name'], $title,$content);
        unset($_SESSION['cart']);
         
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
        echo "<script>window.location.assign('index.php')</script>";
    }
    // header('location: index.php');
    exit;
}
?>