<?php
require '../root/checklogin.php';
?>
<?php
require_once '../db.php';
require_once '../func.php';
?>
<?php

$id_order = $_GET['id'];
$query = "SELECT product.id AS product_id, product.name AS product_name,product.cost AS product_cost,
product.image AS product_image,
orders_detail.quantity AS quantity, orders.* ,
customer.name as customer_name, customer.email as customer_email,
customer.phone as customer_phone, customer.address as customer_address 
FROM ((((product INNER JOIN orders_detail ON product.id = orders_detail.product_id)
INNER JOIN orders ON orders_detail.orders_id = orders.id))
INNER JOIN customer ON orders.recipient_id = customer.id)
WHERE orders.id = '$id_order'";

$records = get_list($query);

if(count($records)==0){
    header("Location: ../root/404page.php");
    exit();
}
 foreach ($records as $record) { 
    $id_order = $record['id'];
 }
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add</title>
    <link rel="stylesheet" href="../css/detail.css">
    <link rel="stylesheet" href="../css/cssdb.css">
    <link rel="stylesheet" href="../css/cssmf.css">

    <script src="../js/uploadFile.js"></script>
    <!-- icon -->
    <script src="https://kit.fontawesome.com/945e1fd97f.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/font-awesome-line-awesome/css/all.min.css">
    <style>
        .order-detail {
            margin-top: 0px;
            color: black;
            
        }

        .table-order th {
            background-color: white;
            width: 30%;
            font-size: 16px;
            color: gray;
            font-weight: 600;
        }

        .table-order td {
            text-align: left;
        }

        .algin-td {
            text-align: left;
            border: none;
            
        }

        .algin-tr td {
            border: none;
          
        }

        .btnstatus {
            text-align: left;
            align-items: left;
            color: black;
        }

        main {
            margin-top: -30px;
        }

        .status {
            display: flex;
            justify-content: center;

            border-radius: 10px;
            font-size: 13px;
            width: 80px;
            font-weight: bold;
            text-align: left;
        }

        .two {
            background-color: #e0fddb;
            color: #27f364;
        }
        .one {
          
            background-color: #ffe9ed;
            color: #f3272a;
        }
        .zero {
            background-color: #fdf1db;
            color: #f3a527;
        }
    </style>
</head>

<body>

    <div class="grid-container">

        <div class="container-header">
            <div class="header">
                <div class="search-wrapper" style="color:azure; border: none">
                    <form method="get" action="">
                        <span class="fa fa-search"> </span>

                        <input placeholder="Search" name="search" type="search" value=" " hidden>

                </div>

                <div class="user-wrapper">
                    <img src="../img/sikimori.jpg" alt="anh">
                    <div>
                        <input class="dropdown" type="checkbox" id="dropdown" name="dropdown" hidden />
                        <label class="for-dropdown" for="dropdown">
                            <h4> <?php echo $_SESSION['username'] ?> <i class="fa-solid fa-caret-down"></i> </h4>
                        </label>
                        <div class="section-dropdown">
                            <div class="section-dropdown-sub">
                                <a href="../process_root/signout.php">Đăng xuất </a>
                                <a href="#">Thông tin </a>
                            </div>

                        </div>
                        <?php
                        $role = '';
                        if ($_SESSION['position'] == 0) {
                            $role = 'Super Admin';
                        } else {
                            $role = 'Admin';
                        }
                        ?>
                        <small> <?php echo $role;  ?></small>

                        </form>


                    </div>
                </div>
            </div>
        </div>

        <div class="container-siderbar">
            <?php include '../root/sidebar.php' ?>

        </div>

        <div class="container-main">
           
                <div class="container">
                    <div class="tag-name">
                        <a href="./index.php">
                            <h2> <span class="fa fa-arrow-circle-left"></span> Chi tiết mã đơn/
                                <span style="color: rgb(250, 35, 189); font-weight:bold">#</span><?= encodeID($id_order) ?>
                            </h2>
                            <br>
                        </a>
                    </div>
                </div>
             
                <div class="container-content">
                    <main>
                        <div class="table-content">
                            <div class="table-button-detail">
                                <div class="btn-out">
                                    <a> <button> <span class="fa-solid fa-print"></span> In HĐ</button> </a>
                                </div>
                     
                                <?php if ($record['status'] == 0) {
                                    echo '<div class="btn-addd">';
                                    echo '<a href="./productadd.php"><button><span class="fa-solid fa-check"></span> Duyệt</button> </a> </div>';
                                    echo '<div class="btn-delete">';
                                    echo ' <a href="./productadd.php"><button><span class="fa-solid fa-xmark"></span> Hủy</button> </a> </div>';
                                } ?>

                            </div>
                            <br>
                            <div class="order-detail">
                                <h1 class="title-detail">Thông tin người đặt hàng :</h1>
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
                                <h1 class="title-detail">Thông tin người nhận hàng :</h1>
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
                                <h1 class="title-detail">Trạng thái đơn hàng :</h1>
                                <br>
                                <div class="table-order">
                                    <table style=" text-align: left; ">
                                        <thead>
                                            <tr>
                                                <th>Thời gian đặt</th>

                                                <td><?= $record['time_order'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Trạng thái đơn </th>
                                                <td>
                                                    <?php $satuss = $record['status'];

                                                            switch ($satuss) {
                                                                case 0:
                                                                    echo '<p class="status zero" >Chờ duyệt</p>';
                                                                    break;
                                                                case 1:
                                                                    echo '<p class="status two" style=" text-align: left;">Đã duyệt</p>';
                                                                    break;
                                                                case 2:
                                                                    echo '<p class="status one">Đã Hủy</p>';
                                                                    break;
                                                            }
                                                            ?>
                                                    <!-- <p class="status two" style=" text-align: left;">Đã duyệt</p> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Thời gian tiếp nhận </th>
                                                <td><?= $record['time_accept'] ?></td>
                                            </tr>
                                        </thead>
                                    </table>

                                    <br>

                                </div>

                            </div>

                            <h1 class="title-detail">Sản phẩm mua :</h1>
                            <br>
                            <table border="1px" class="table-content-display">
                                <thead>
                                    <tr>
                                        <th style="width: 100px;">ID</th>
                                        <th>Image</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Giá tiền (1/SP)</th>
                                        <th>Số lượng đặt</th>
                                        <th style="width: 20%;">Tổng tiền</th>
                                    </tr>
                                    <?php $sum =0; ?>
                                    <?php foreach ($records as $record) { ?>
                                    <tr>
                            
                                        <td> <span style="color: rgb(250, 35, 189); font-weight:bold">#</span><?= $record['product_id'] ?></td>
                                        <td><img src="../photos/<?php echo $record['product_image']; ?>" style="width: 150px; height 150px; border-radius: 5px;"></td>
                                        <td><?=$record['product_name'] ?></td>
                                        <td><?= number_format($record['product_cost'] , 0, '', ','); ?> <span class="cost">đ</span></td>
                                        <td><?=$record['quantity'] ?></td>
                                        <td><?php
                                       
                                        $total_cost_product = $record['product_cost'] * $record['quantity'];
                                        $sum += $total_cost_product;
                                         echo number_format($total_cost_product, 0, '', ','); 
                                        ?> <span class="cost">đ</span></td>
                                        <?php } ?>
                                    </tr>
                                    <tr class="algin-tr">
                                        <td></td>
                                    </tr>
                                    <tr class="algin-tr">
                                      
                                 
                                        <td class="algin-td" colspan="5">
                                            <h1  >Tổng tiền sản phẩm: </h1>
                                        </td>
                                     

                                        <td><span style="color:red;"><?=number_format($sum, 0, '', ',');  ?> </span> <span class="cost">đ</span></td>
                                    </tr>
                                    <tr class="algin-tr">
                                      
                                        
                                        <td class="algin-td" colspan="5">
                                            <h1> Thuế VAl(10%):</h1>
                                        </td>
                                       

                                        <td><span style="color:red;"><?=number_format($sum* 10/100, 0, '', ',');  ?> </span> <span class="cost">đ</span></td>
                                    </tr>
                                    </tr>
                                    <tr class="algin-tr">
                                       
                                        
                                        <td class="algin-td" colspan="5">
                                            <h1>Khuyến mãi</h1>
                                        </td>
                                       

                                        <td><span style="color:red;">0% </span></td>
                                    </tr>
                                    <tr class="algin-tr">
                                        
                                      
                                        <td class="algin-td" colspan="5">
                                            <h1>Tổng tiền: </h1>
                                        </td>
                                        

                                        <td ><span style="color:red; font-weight:bold;"><?=number_format($sum* 10/100 +$sum, 0, '', ',');  ?> </span> <span class="cost">đ</span></td>
                                      
                                    </tr>
                                </thead>
                            </table>
                            <br>

                        </div>
                    </main>

                </div>
        </div>
  
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">

</script>

</html>