<?php
require_once '../admin/process_root/check_session.php';
require_once '../admin/db.php';
require_once '../admin/func.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hikkywannafly</title>
    <!-- google font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">

    <!-- boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <!-- app css -->
    <link rel="stylesheet" href="../css/grid.css?v=2">
    <link rel="stylesheet" href="../css/app.css?v=2">
    <script src="https://kit.fontawesome.com/945e1fd97f.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/cart.css?v=2">
    <link rel="stylesheet" href="../css/detail.css?v=2">
    <link rel="stylesheet" href="../admin/css/toast.css?v=2">
    <style>
        .header-tittle {
            display: flex;
            justify-content: center;
        }

        .heading-page:after {
            content: "";
            background: #252a2b;
            display: block;
            width: 60px;
            height: 4px;
            margin: 25px auto 0;
        }

        .bottomm {
            border-bottom: 1px solid #dfe0e1;
        }

        .right-site {
            border: 1px solid #dfe0e1;
            padding: 20px 10px;
        }

        .product-card-price {
            display: flex;
            justify-content: space-between;
        }

        .buttonadd {
            width: 460px;
            padding: 18px;
            font-weight: 700;
        }
    </style>
</head>

<body>


    <header>
        <?php require_once '../root/header.php' ?>
    </header>
    <!-- nav -->
    <div id="toast"></div>
    <nav class="navbar">

        <div id="close">&nbsp;<i class="fas fa-times"></i></div>
        <p class="ttbold">Giỏ hàng</p>

        <div class="cart">
            <?php
            if (!isset($_SESSION['cart'])) {

                echo '<br><br>
               <img  style="width:90px; margin-left: 190px"src="https://i.pinimg.com/originals/15/4f/df/154fdf2f2759676a96e9aed653082276.png">
    <h4 style="margin-left:115px">Không có sản phẩm nào trong đây cả :((</h4><br><br>';
            } else {
                require_once '../root/nav-cart-user.php';
            }

            ?>



        </div>

        <table class="table-total">
            <tr>
                <td class="text-left">TỔNG TIỀN:</td>
                <td class="text-right" id="total-view-cart"><span style="color:red">
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

                        ₫ </span></td>
            </tr>
        </table>

        <a href="/cart" class="linktocart button dark">Xem giỏ hàng</a>
        &emsp;&emsp;&emsp;&emsp;&nbsp;
        <a href="/checkout" class="linktocheckout button dark">Thanh toán</a>

    </nav>


    <!-- products content -->
    <div class="bg-main close-cart">
        <div class="container">
            <div class="box">
                <div class="breadcumb">
                    <div class="text-b" style="margin-left:50px;">
                        <a href="./index.html">home</a>
                        <span><i class="fa-solid fa-angle-right"></i></span>
                        <a href="../product">Giỏ hàng</a>
                    </div>

                </div>
            </div>
            <div class="box">
                <div class="row">

                    <div class="col-41" style="margin:auto;">
                        <h1>Giỏ hàng của bạn </h1>
                        <p> Có 1 sản phẩm trong giỏ hàng</p>
                        <div class="heading-page">

                        </div>
                    </div>


                </div>
            </div>


            <div class="box">
                <div class="row" style="margin-left:50px;width:100%">
                    <div class="col-7 ">
                        <div class="show-cart">
                            <table border="1">
                                <tr>
                                    <th rowspan="4">Favorite</th>
                                    <td>Tên sản phẩm</td>
                                    <td>X</td>
                                </tr>
                                <tr>
                                    <th>219,000₫ (299,000₫)</th>
                                    
                                </tr>
                                <tr>
                                    <th>SL: 1</th>
                                   
                                </tr>
                                <tr>
                    
                                    <td>Size/ 34</td>
                                    <td>23423432d</td>
                                </tr>
                            
                            </table>
                        </div>
                    </div>
                    <div class="col-52">
                        <div class="right-site" style="margin-left:30px;">
                            <h3>Thông tin đơn hàng</h3>
                            <br>
                            <div class="row1-text bottomm ">
                            </div>
                            <div class="text-2">
                                <br>
                                <div class="product-card-price">
                                    <span style="font-size:16px; font-weight:600; color:grey">Tổng tiền:</span> &emsp;
                                    <span class="curr-price">
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

                                        <span class="cost">đ</span></span>

                                </div>
                            </div>
                            <br>
                            <div class="row1-text bottomm ">
                            </div>
                            <br>
                            <p>Phí vận chuyển sẽ được tính ở trang thanh toán.</p>
                            <p> Bạn cũng có thể nhập mã giảm giá ở trang thanh toán.</p>
                            <br>

                            <button type="button" id="add-to-cart" class="button dark buttonadd btn-cart-add-to" value="<?= $value['id'] ?>">Thanh toán</button>
                            <br>
                            <br>
                            <p class="link-continue" style="text-align:center; color:red">
                                <a href="/collections/all">
                                    <i class="fa fa-reply"></i> Tiếp tục mua hàng
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end products content -->
        <?php require_once '../root/footer.php' ?>
        <!-- app js -->
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="../js/headersticky.js"></script>
<script src="../js/cart.js"></script>

</html>