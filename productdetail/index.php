<?php
require_once '../admin/process_root/check_session.php';
require_once '../admin/db.php';
require_once '../admin/func.php';
?>
<?php
$id = $_GET['id'];
$query_img = "SELECT * FROM product_img WHERE product_id = $id";
$img_result = get_list($query_img);
$query = "SELECT product.* , manufacture.name AS manufacture_name, manufacture.address AS manufacture_address,
type.name AS type_name FROM product 
INNER JOIN manufacture ON product.manufacture_id = manufacture.id
INNER JOIN type ON product.type_id = type.id
WHERE product.id = '$id'";
$product_info = get_list($query);
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
        .row1-text {
            margin-bottom: 10px;
        }

        .bottomm {
            border-bottom: 1px dotted #dfe0e1;
        }

        .radio-color input {
            width: 30px;
        }

        .text-description p {

            letter-spacing: 1px;
            line-height: 1.5;

        }

        .discound-s {
            background-color: rgb(220, 220, 220);
            color: rgb(239, 49, 80);
            padding: 3px 5px;
            font-weight: bold;
            border-radius: 6px;
        }

        img {
            max-width: 100%;
            max-height: 100%;
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

        <a href="../cart/" class="linktocart button dark">Xem giỏ hàng</a>
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
                        <a href="../product">Tất cả sản phẩm</a>
                        <span><i class="fa-solid fa-angle-right"></i></span>
                        <a href="./products.html" style="font-style:italic">Sản phẩm gì đây</a>
                    </div>

                </div>
            </div>

            <div class="box">
                <div class="row" style="margin-left:50px;">
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
                            <?php foreach ($product_info as $value) {

                            ?>
                                <div class="row1-text">
                                    <h2><?= $value['name'] ?></h2>
                                    <p style="color:gey; text-transform:uppercase">MS: <?= encodeID($value['id']) ?></p>
                                </div>
                                <div class="row1-text bottomm ">
                                </div>

                                <div class="row1-text">
                                    <div class="product-card-price">

                                        <span class="discound-s">-
                                            <?php
                                            if ($value['sale'] == null) echo 0;
                                            echo $value['sale'];

                                            ?>%</span>
                                        &emsp;
                                        <span class="curr-price"><?php echo number_format($value['cost'], 0, '', ','); ?>
                                            <span class="cost">đ</span></span>
                                        <span><del><?php

                                                    echo number_format($value['cost'] * (1 - (int)$value['sale'] / 100), 0, '', ','); ?></del></span>


                                    </div>
                                </div>
                                <div class="row1-text bottomm ">
                                </div>

                                <div class="row1-text">
                                    <h4 class="text-tit">Loại sản phẩm</h4>

                                    <h3><?= $value['type_name'] ?> </h3>
                                </div>
                                <div class="row1-text bottomm ">
                                </div>
                                <div class="row1-text">
                                    <h4 class="text-tit"> Thương hiệu</h4>

                                    <h3><?= $value['manufacture_name'] ?> </h3>
                                </div>
                                <div class="row1-text bottomm ">
                                </div>
                                <div class="row1-text">
                                    <h4 class="text-tit"> Size</h4>
                                    <button class="btn-size 1">39</button>
                                    <button class="btn-size 2">40</button>
                                    <button class="btn-size 3">41</button>
                                    <button class="btn-size 4">42</button>
                                    <button class="btn-size 5">43</button>

                                </div>
                                <div class="row1-text bottomm ">
                                </div>
                                <div class="row1-text">
                                    <br>
                                    <h4 class="text-tit"> </h4>
                                    <input type="button" value="-" onclick="minusQuantity()" class="qty-btn">
                                    <input type="text" id="quantity" name="quantity" value="1" min="1" class="quantity-selector">
                                    <input type="button" value="+" onclick="plusQuantity()" class="qty-btn">

                                </div>
                                <br><br><br>
                                <div class="row-btn">
                                    <p><button type="button" id="add-to-cart" class="button dark buttonadd btn-cart-add-to" value="<?= $value['id'] ?>">Thêm vào giỏ</button></p>
                                </div>
                                <br>

                                <div class="row1-text">
                                    <h4 style="color:gey; "> Mô tả</h4>
                                    <br>
                                    <div class="text-description">
                                        <p><?= $value['description'] ?></p>
                                    </div>

                                </div>
                                <img src="https://file.hstatic.net/200000346037/file/image_0c5592294cbc4853af843f6e97be5a5b_grande.png">

                            <?php } ?>
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
<script type="text/javascript">
    $(document).ready(function() {
        $('.btn-cart-add-to').click(function() {
            let id = $(this).val();
            let quantity = $('#quantity').val();

            console.log(id);
            $.ajax({
                type: "POST",
                url: "../cart/add_to_cart.php",
                data: "id=" + id,
                beforeSend: function() {

                },
                success: function(response) {
                    console.log(response);
                    $('.cart').html(response);
                    $('.navbar').addClass('active');
                }
            });
            $.ajax({
                type: "POST",
                url: "../cart/count_product.php",
                data: "id=" + id,
                success: function(data) {
                    console.log(data);
                    $('.count').html(data);
                    $('.count2').html(data);
                }
            });
            $.ajax({
                type: "POST",
                url: "../cart/cart_total_cost.php",
                data: "id=" + id,
                success: function(data) {
                    console.log(data);
                    $('.text-right').html(data);

                }
            });
        });

    });
</script>
<script>
    $(document).ready(function() {
        let access = "false";
        $('.5').click(function() {
            if (access == "true") {
                $('.5').removeClass('active1');
                access = "false";
            }


        });
        $('.5').click(function() {
            setTimeout(function() {

                if (access == "false") {
                    $('.5').addClass('active1');
                    access = "true";
                    console.log(access);
                }

            }, 1000);


        });

    });
</script>
<script src="../admin/js/toast.js"></script>
<script>
    function plusQuantity() {
        let quantity = $('#quantity').val();
        if (quantity >= 5) {
            showErrorToast("Bạn đặt giày chi lắm vậy!");
            return;
        }
        quantity++;
        $('#quantity').val(quantity);
    }

    function minusQuantity() {
        let quantity = $('#quantity').val();
        if (quantity <= 0) {
            showErrorToast("Bạn hack game à");
            return;
        }
        quantity--;

        $('#quantity').val(quantity);
    }
</script>
<script>
    function showSuccessToast() {
        toast({
            title: "Thành công!",
            message: "Bạn đã xóa thành công",
            type: "success",
            duration: 5000
        });
    }

    function showErrorToast($message) {
        toast({
            title: "DCM Bạn",
            message: $message,
            type: "error",
            duration: 5000
        });
    }
</script>

</html>