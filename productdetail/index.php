<?php
require_once '../admin/process_root/check_session.php';
require_once '../admin/db.php';
require_once '../admin/func.php';
?>
<?php
$id = $_GET['id'];
$query = "SELECT * FROM product_img WHERE product_id = $id";
$img_result = get_list($query);

?>

<!DOCTYPE html>
<html lang="en">

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
    <style>
        .row {
            margin-left: 50px;
        }
    </style>
</head>

<body>


    <header>
        <?php require_once '../root/header.php' ?>
    </header>
    <!-- nav -->
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
                                $total += $value['cost'] * $value['quantity'];
                            }
                        }
                        echo number_format($total, 0, '', ',');
                        ?>

                        ₫ </span></td>
            </tr>
        </table>

        <a href="/cart" class="linktocart button dark">Xem giỏ hàng</a>
        &emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;
        <a href="/checkout" class="linktocheckout button dark">Thanh toán</a>

    </nav>


    <!-- products content -->
    <div class="bg-main close-cart">
        <div class="container">
            <div class="box">
                <div class="breadcumb">
                    <a href="./index.html">home</a>
                    <span><i class="fa-solid fa-angle-right"></i></span>
                    <a href="../product">Tất cả sản phẩm</a>
                    <span><i class="fa-solid fa-angle-right"></i></span>
                    <a href="./products.html" style="font-style:italic">Sản phẩm gì đây</a>
                </div>
            </div>

            <div class="box">
                <div class="row">
                    <div class="col-1">
                        <div class="hold-img">
                            <?php foreach ($img_result as $value) {
                            ?>
                                <img src="../admin/photos/<?= $value['img'] ?>">
                            <?php } ?>

                        </div>

                    </div>
                    <div class="col-7" style="margin-top:20px;">
                    <div class="img-mid">
                    <?php foreach ($img_result as $value) {
                        ?>
                            <img style=" width: 956px;" src="../admin/photos/<?= $value['img'] ?>">
                        <?php } ?>
                    </div>
                        
                    </div>
                    <div class="col-51">
                        <div class="hold-des">
                            <table>
                                <tr>
                                    <p>dsdsd</p>
                                </tr>
                                <tr>
                                    <p>dsds</p>
                                </tr>
                                <tr>
                                    <p>dsds</p>
                                </tr>
                                <tr>
                                    <p><button type="button" id="add-to-cart" class="button dark buttonadd" name="add">Thêm vào giỏ</button></p>
                                </tr>
                            </table>
                        </div>

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