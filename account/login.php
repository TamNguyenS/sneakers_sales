<?php
require_once '../admin/process_root/check_session.php';
require_once '../admin/db.php';
require_once '../admin/func.php';
?>
<?php
if (isset($_SESSION['id_user'])) {
    header('location: ../product');
    exit;
}
$cookies_temp = isset($_COOKIE['token_remem_user']) ? isset($_COOKIE['token_remem_user'])  : false;
if ($cookies_temp != false) {

    $token = $_COOKIE['token_remem_user'];
    $sql = "SELECT * FROM customer WHERE token = '$token' limit 1";
    $record = get_list($sql);
    $conn = connect();
    $query = "SELECT * FROM customer WHERE token = '$token'";
    $result = mysqli_query($conn, $query);
    $number_rows = mysqli_num_rows($result);
    if ($number_rows == 1) {
        $_SESSION['id_user'] = $record[0]['id'];
        $_SESSION['name'] = $record[0]['name'];
        $_SESSION['loginsucces'] = true;
    }
}



?>

<?php
if (isset($_POST['remember'])) {
    $remember = true;
} else {
    $remeber = false;
}

$email = isset($_POST['email']) ? $_POST['email'] : false;
$password = isset($_POST['password']) ? $_POST['password'] : false;
$isEnror = false;
$error = '';
$msg = '';

if ($email != false && $password != false) {

    $conn = connect();
    $query = "SELECT * FROM customer WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $query);
    $number_rows = mysqli_num_rows($result);
    if ($number_rows == 1) {

        $info = mysqli_fetch_array($result);
        $id = $info['id'];
       
        $_SESSION['id_user'] = $id;
        $_SESSION['name'] = $info['name'];
        $_SESSION['loginsucces'] = true;
        // $_SESSION['position'] = $info['position']
        if ($remember) {
            $token = uniqid($info['username'] . '_client', true);
            $update_token = update('customer', array('token' => $token), "id = $id");

            setcookie('token_remem_user', $token, time() + (24 * 30 *30), '/', '', 0);
        }
        $msg = 'Ban da dang nhap thanh cong';
        header('Location: ../product');
        exit;
    } else {
        $error = "Tên tài khoản và mật khẩu khum đúng! ";
    }
}
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


        .group input:focus {
            outline: none;
            border: 1px solid rgb(149, 149, 149);
            transition: all 0.5s ease-in-out;
        }

        .group label {
            color: #999;
            font-size: 18px;
            font-weight: normal;
            position: absolute;
            pointer-events: none;
            left: 5px;
            top: 15px;
            transition: 0.2s ease all;
        }

        .group input:focus~label,
        .group input:valid~label {
            top: -25px;
            font-size: 16px;
            color: #353538;
        }

        .box {
            padding: 30px;
        }

        .content-l {
            margin-left: 70px;
        }
        .dd a{
            color: blue;
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

        <a href="../cart/" class="linktocart button dark">Xem giỏ hàng</a>
        &emsp;&emsp;&emsp;&emsp;&nbsp;
        <a href="../payment/" class="linktocheckout button dark">Thanh toán</a>

    </nav>

    <form method="POST" action="">
    <!-- products content -->
    <div class="bg-main close-cart">

        <div class="container">
            <div class="box">

                <div class="col-5">
                    
                        <h1 style="font-size: 50px;"> Đăng Nhập </h1>
                        <br>
                        <div class="heading-page">

                        </div>
                </div>


                <div class="col-5" style="border-left: 1px solid rgb(226, 226, 226);">
                    <div class="content-l">
                        <span style="color:red; font-weight: bold;"><?php echo $error ?></span> <br><br><br>

                        <div class="group">
                            <input name="email" type="text" required>
                            <label>Email</label>
                        </div>
                        <br>
                        <div class="group">
                            <input name="password"type="password" required>
                            <label>Mật Khẩu</label>
                        </div>


                        <div class="checkbox-content">
                            <label>Remember me
                                <input type="checkbox" name="remember">
                            </label>
                        </div>

                        <br>

                        <div class="dd" style="color:grey">
                            This site is protected by reCAPTCHA and the Google
                            <a href="https://policies.google.com/privacy" target="_blank" rel="noreferrer">Privacy Policy</a>
                            and <a href="https://policies.google.com/terms" target="_blank" rel="noreferrer">Terms of Service</a> apply.
                        </div>
                        <br>
                        <p><button style="width :150px" onlicks="" type="submit" id="add-to-cart" class="button dark buttonadd btn-cart-add-to"">Đăng Nhập</button>
                    <a href=" #"> Quên mật khẩu? </a>
                                <span style="color :grey">hoặc</span>
                                <a href="#"> Đăng ký </a>
                        </p>
                        <br><br><br>
                        
                    </div>
                </div>


            </div>
            </form>

        </div>
    </div>
    <!-- end products content -->
    <?php require_once '../root/footer.php' ?>
    <!-- app js -->
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="../js/headersticky.js"></script>
<script src="../js/cart.js"></script>
<script src="../admin/js/toast.js"></script>


</script>

</html>