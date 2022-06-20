<?php
require_once '../admin/process_root/check_session.php';
require_once '../admin/db.php';
require_once '../admin/func.php';
?>
<?php

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
    <link rel="stylesheet" href="../css/payment.css?v=2">
    <link rel="stylesheet" href="../admin/css/toast.css?v=2">
    <style>
        .heading-page:after {
            content: "";
            background: #252a2b;
            display: block;
            width: 60px;
            height: 4px;
            margin: 25px 0px 0;
        }

        .box {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .group {
            position: relative;
            margin-bottom: 30px;
        }

        .group input {
            font-size: 18px;
            padding: 15px 7px 15px 12px;
            display: block;
            width: 100%;
            border-radius: 5px;
            background: rgb(236, 236, 236);
            border: none;
            border: 1px solid rgb(236, 236, 236);
            transition: border 0.5s ease-in-out;


        }


        input:focus {
            outline: none;
            border: 1px solid rgb(149, 149, 149);
            transition: all 0.5s ease-in-out;
        }

        label {
            color: #999;
            font-size: 18px;
            font-weight: normal;
            position: absolute;
            pointer-events: none;
            left: 5px;
            top: 15px;
            transition: 0.2s ease all;

        }

        input:focus~label,
        input:valid~label {
            top: -25px;
            font-size: 16px;
            color: #353538;
            z-index: 100 !important;
        }

        .box {
            padding: 30px;
        }
        .warmings{
            color: red;
        }
    </style>
</head>

<body>


    <header>
        <?php require_once '../root/header.php' ?>
    </header>
    <!-- nav -->
    <div id="toast"></div>
    <?php require_once '../root/user.php' ?>
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
                <div class="col-5" style="margin-top:-250px">
                    <div class="dsdad" style="position:sticky ">
                        <h1 style="font-size: 40px; "> Tạo tài khoản</h1>
                        <br>
                        <div class="heading-page">

                        </div>

                    </div>

                </div>


                <div class="col-5" style="border-left: 1px solid rgb(226, 226, 226); " >
                    <div class="warmings">

                    </div>
                    <form  action="" method="POST" id="uploadFrom" >
                        <br> <br><br>
                        <div class="group">
                            <input type="text" name="name" required>
                            <label>Họ và tên</label>
                            <span class="from-msg"></span>
                        </div>
                        <br>
                        <div class="group">
                            <input type="email" name="email" required>
                            <label>Email</label>
                            <span class="from-msg"></span>
                        </div>
                        <br>
                        <div class="group">
                            <input type="text" name="phone"  required>
                            <label>Số điện thoại</label>
                            <span class="from-msg"></span>
                        </div>
                        <br>
                        <div class="group">
                            <input type="date" name="date" required>
                            <label style="z-index:-1">Ngày sinh</label>
                            <span class="from-msg"></span>
                        </div>
                        <br>
                        <div class="group">
                            <input type="text" name="address"required>
                            <label>Địa chỉ</label>
                            <span class="from-msg"></span>
                        </div>
                        <br>
                        <div class="group">
                            <input type="password" name="password" required>
                            <label>Mật Khẩu</label>
                            <span class="from-msg"></span>
                        </div>
                        <br>
                        <div class="clearfix large_form sitebox-recaptcha">
                            This site is protected by reCAPTCHA and the Google
                            <a href="https://policies.google.com/privacy" target="_blank" rel="noreferrer">Privacy Policy</a>
                            and <a href="https://policies.google.com/terms" target="_blank" rel="noreferrer">Terms of Service</a> apply.
                        </div>
                        <br>
                        <p><button style="width :150px" type="submit" id="add-to-cart" class="button dark buttonadd btn-cart-add-to"">Đăng kí</button>

                    </p>
                    <br><br><br>
                    <div class=" clearfix req_pass">
                                <a class="come-back" href="../product/"><i class="fa fa-long-arrow-left"></i> Quay lại trang chủ</a>
                </div>
                </form>
            </div>


        </div>


        </box>
    </div>
    </div>
    <!-- end products content -->
    <?php require_once '../root/footer.php' ?>
    <!-- app js -->
</body>
<script src=" https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="../js/headersticky.js"></script>
<script src="../js/cart.js"></script>
<script src="../admin/js/toast.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#uploadFrom").on('submit', (function(e) {
            e.preventDefault();
                $.ajax({
                    url: "./process_regis.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    // success: function(response) {
                    //     $('#uploadFrom').find('input').val('');
                    //     $('#uploadFrom').find('textarea').val('');
                    //     showSuccessToast("Thành công", "Thêm thành công sản phẩm!")
                    // },
                }).done(function(data) {
                    if (data == 1) {
                        showSuccessToast("Thành công", "Đăng kí thành công!")
                        setTimeout(function() {
                            window.location.href = "./login.php";
                        }, 2000);
                    } else{
                        console.log(data);
                        $('.warmings').empty();
                       $('.warmings').append(data)
                    }
                });

        }));
    });
</script>
<script>
    function showSuccessToast(type, message) {
        toast({
            title: type,
            message: message,
            type: "success",
            duration: 5000
        });
    }

    function showErrorToast(type, message) {
        toast({
            title: type,
            message: message,
            type: "error",
            duration: 5000
        });
    }
</script>
</html>