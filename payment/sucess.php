<?php
require_once '../admin/process_root/check_session.php';
require_once '../root/checklogin.php';

$id_order = $_GET['id'];
$query = "SELECT product.id AS product_id, product.name AS product_name,product.cost AS product_cost,
orders_detail.quantity AS quantity, orders.* ,
customer.name as customer_name, customer.email as customer_email,
customer.phone as customer_phone, customer.address as customer_address 
FROM ((((product LEFT JOIN orders_detail ON product.id = orders_detail.product_id)
LEFT JOIN orders ON orders_detail.orders_id = orders.id))
LEFT JOIN customer ON orders.recipient_id = customer.id)
WHERE orders.id = '$id_order'";

$records = get_list($query);

// if(count($records)==0){
//     header("Location: ../root/404page.php");
//     exit();
// }
 foreach ($records as $record) { 
    $id_order = $record['id'];
 }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="../css/loading.css?v=2">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito&display=swap');

        body {
            margin: 0;
            padding: 0;
            font-family: 'Nunito', sans-serif;
        }

        html::-webkit-scrollbar {
            width: .44rem;
        }

        html::-webkit-scrollbar-track {
            background: white;
        }

        html::-webkit-scrollbar-thumb {
            background: grey;
            border-radius: 10rem;
        }

        .container {
            width: 90%;
            display: flex;
            justify-content: center;
            margin: 0px auto;

        }

        .left-site {
            width: 60%;
            /* border-right: 1px solid grey; */
        }

        .right-site {
            /* margin-left: 50px; */
            width: 50%;
            /* max-height: 100vh; */
            border-left: 1px solid grey;

        }

        .content {
            position: sticky;
        }

        .content2 {
            margin-left: 50px;
        }

        a {
            text-decoration: none;
            color: rgb(45, 146, 223);
            ;
        }

        ul {
            margin: 0;
            padding: 0;
            list-style-type: none;
        }

        .breadcrumb .breadcrumb-item {
            display: inline-block;
            font-size: 0.85714em;
            color: #999999;
        }

        .group {
            position: relative;
            margin-bottom: 30px;
        }

        select,
        input {
            font-size: 18px;
            padding: 8px 0px 8px 5px;
            display: block;
            width: 90%;
            border-radius: 8px;
            border: none;
            border: 1px solid grey;
            transition: border 0.5s ease-in-out;


        }

        select {
            font-size: 14px;
        }

        input:focus {
            outline: none;
            border: 1px solid rgb(9, 131, 237);
            transition: all 0.5s ease-in-out;

        }

        label {
            color: #999;
            font-size: 18px;
            font-weight: normal;
            position: absolute;
            pointer-events: none;
            left: 5px;
            top: 8px;
            transition: 0.2s ease all;
        }

        /* active state */
        input:focus~label,
        input:valid~label {
            top: -20px;
            font-size: 16px;
            color: #5264AE;
        }

        .info2 {

            position: relative;
            width: 99%;
        }

        .div1 {
            width: 56%;
            /* margin: auto; */
            margin-right: 0px;
            display: inline-block;
        }

        .div2 {
            width: 41%;
            /* margin: auto; */
            margin-left: -20px;
            display: inline-block;
        }

        .div3 {
            width: 31%;
            /* margin: auto; */

            display: inline-block;
        }

        .div3 .group label {
            color: #5264AE;
            font-size: 16px;
            font-weight: normal;
            position: absolute;
            pointer-events: none;
            left: 5px;
            top: -22px;
        }

        .content2 {
            /* left: 30px; */
            height: 1000px;

        }

        th img {
            width: 100px;
            height: 100px;
            border-radius: 10px;
            border: 1px solid #ccc;
        }

        .mid-table {
            width: 400px;
        }

        .bar {
            position: relative;
            display: block;
            width: 100%;
            color: grey;
            background-color: grey;
            height: 1px;
        }

        .btn {
            padding: 10px;
            background-color: rgb(18, 144, 198);
            border: none;
            color: white;
        }

        input[type="submit"] {
            width: 180px;
            border-radius: 0px;
            font-size: 13px;
            margin-top: -30px;
            margin-left: 350px;
        }

        .error {
            color: red;
            font-weight: bold;
            margin-bottom: 20px;
        }
        th{
            width: 150px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="left-site">

            <div class="content">



                <h2>Hikkywannafly Payment</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/cart">Giỏ hàng</a>
                    </li>
                    |
                    <li class="breadcrumb-item breadcrumb-item-current">
                        Đang chờ duyệt
                    </li>
                    
                </ul>
                <h3>ĐẶT HÀNG THÀNH CÔNG <span style="color:grey; font-size: 12px; font-style:italic">(Zui lòng check mail để theo dõi trạng thái đơn hàng)</span></h3>
                <div class="error">
                    <!-- <span>• sd</span> -->
                </div>
                <div class="content">
                <div class="order-detail">
                                <h5 class="title-detail">Thông tin người đặt hàng :</h5>
                                <br>
                                <div class="table-order">
                                    <table style=" text-align: left; ">
                                        <thead>
                                            <tr>
                                                <th>Tên người đặt </th>

                                                <td><?= $record['customer_name'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Địa chỉ </th>
                                                <td><?= $record['customer_address'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Số điện thoại </th>
                                                <td><?= $record['customer_phone'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Email </th>
                                                <td><?= $record['customer_email'] ?></td>
                                            </tr>
                                        </thead>
                                    </table>



                                </div>
                                <br>
                                <h5 class="title-detail">Thông tin người nhận hàng :</h5>
                                <br>
                                <div class="table-order">
                                    <table style=" text-align: left; ">
                                        <thead>
                                            <tr>
                                                <th>Tên người nhận </th>

                                                <td><?= $record['recipent_name'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Địa chỉ </th>
                                                <td><?= $record['recipent_address'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Số điện thoại </th>
                                                <td><?= $record['recipent_phone'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Email </th>
                                                <td><?= $record['customer_email'] ?></td>
                                            </tr>
                                        </thead>
                                    </table>



                                </div>
                                <br>
                
                                
                            </div>
                </div>

            </div>
        </div>
        <div class="right-site">

            <div class="content2">
                <?php $cart = $_SESSION['cart'];
                $count = 0;
                foreach ($cart as $value) {
                    $count++;
                ?>
                    <table style="margin-bottom: 30px; margin-top: 30px;">
                        <tr>
                            <th rowspan="4" style="width: 80px; height: 80px"> <img src="../admin/photos/<?= $value['image'] ?>">
                            <td></td>
                            </th>
                            <td class="mid-table" style="font-weight:bold; font-size:19px;"><?= $value['name'] ?></td>

                        </tr>
                        <tr>
                            <td></td>
                            <td class="mid-table">SL: <?= $value['quantity'] ?></td>

                        </tr>
                        <tr>
                            <td></td>
                            <td class="mid-table">Size: 43</td>
                            <td style="text-align: right; width:120px;font-weight:bold">
                                <span class="curr-price price">
                                    <?= number_format($value['cost'] *  $value['quantity'] * (1 - (int)$value['sale'] / 100), 0, '', ','); ?>
                                    <span class="cost">đ</span></span>
                            </td>
                        </tr>


                    </table>

                <?php } ?>
                <div class="total">
                    <span class="bar"></span>
                    <p>Tạm tính:<span style="color: red; font-weight: bold; font-size: 18px; float:right
                    "> <span class="curr-price payment_total">
                                <?php
                                $total = 0;
                                if (isset($_SESSION['cart'])) {
                                    $cart = $_SESSION['cart'];

                                    foreach ($cart as $value) {
                                        $total += $value['cost'] * $value['quantity'] * (1 - (int)$value['sale'] / 100);
                                    }
                                }
                                echo number_format($total, 0, '', ',');
                                ?>

                            </span> VNĐ </p>
                    <p>Phí vận chuyển:<span style=" float:right
                    ">FREE </span> </p>
                    <p>Thuế VAL: <span style=" float:right
                    ">10% </span></p>
                    <span class="bar"></span>
                    <br>
                    <p>Tổng cộng: <span style="color: red; font-weight: bold; font-size: 20px; float:right
                    "> <span class="curr-price payment_total">
                                <?php
                                $total = 0;
                                if (isset($_SESSION['cart'])) {
                                    $cart = $_SESSION['cart'];

                                    foreach ($cart as $value) {
                                        $total += $value['cost'] * $value['quantity'] * (1 - (int)$value['sale'] / 100)
                                            + $value['cost'] * $value['quantity'] * (1 - (int)$value['sale'] / 100) * 0.1;
                                    }
                                }
                                echo number_format($total, 0, '', ',');
                                ?>

                            </span> VNĐ</p>
                    <br><br>
                </div>
            </div>

        </div>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script src="../js/city.js"></script>
<script src="../js/checkPayment.js"></script>

</html>