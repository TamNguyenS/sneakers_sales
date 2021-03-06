<?php
require_once '../admin/process_root/check_session.php';
require_once '../root/checklogin.php';

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
            width: 80%;
            display: flex;
            justify-content: center;
            margin: 0px auto;

        }

        .left-site {
            width: 50%;
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
    </style>
</head>

<body>
    <div class="container">
        <div class="left-site">

            <div class="content">



                <h2>Hikkywannafly Payment</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/cart">Gi??? h??ng</a>
                    </li>
                    |
                    <li class="breadcrumb-item breadcrumb-item-current">
                        Th??ng tin giao h??ng & Thanh to??n
                    </li>
                </ul>
                <h3>Th??ng tin giao h??ng <span style="color:grey; font-size: 12px; font-style:italic">(Zui l??ng ?????c k?? h?????ng d???n tr?????c khi th???c hi???n thanh to??n)</span></h3>
                <div class="error">
                    <!-- <span>??? sd</span> -->
                </div>
                <form method="post" action="./payment_process.php">
                    <div class="info">
                       <div class="group">
                        <input name="name" id="name" type="text" required>
                        <label>Name</label>
                    </div>

                        <div class="info2">

                            <div class="div1">
                            <div class="group">
                                <input name="email" id="email" type= "text" required>
                                <label>Email</label>
                            </div>

                        </div>
                            <div class="div2">
                                <div class="group">
                                    <input name="phone" id="phone" type="text" required >
                                    <label>S??T</label>
                                </div>
                            </div>
                        </div>

                        <div class="group">
                            <input name="address" id="address" type="text" required>
                            <label>?????a ch???</label>
                        </div>

                        <div class="info2">
                            <div class="div3">
                                <div class="group">
                                    <select id="city" required  value="Ch???n t???nh / th??nh">
                                        <option value="none">Ch???n t???nh / th??nh</option>

                                    </select>
                                    <label>T???nh / th??nh</label>
                                </div>

                            </div>
                            <div class="div3">
                                <div class="group">
                                    <select id="district" type="text" required value="Ch???n ph?????ng / x??">
                                        <option value="">Ch???n qu???n / huy???n</option>

                                    </select>

                                    <label>Qu???n / huy???n</label>
                                </div>
                            </div>
                            <div class="div3">
                                <div class="group">
                                    <select id="ward" type="text" required  value="Ch???n ph?????ng / x??">
                                        <option value="">Ch???n ph?????ng / x??</option>

                                    </select>

                                    <label>Ph?????ng / x??</label>
                                </div>
                            </div>
                            <input type="hidden" id="text" name="address1" hidden>
                            <?php
                                $total1 = 0;
                                if (isset($_SESSION['cart'])) {
                                    $cart = $_SESSION['cart'];

                                    foreach ($cart as $value) {
                                        $total1 += $value['cost'] * $value['quantity'] * (1 - (int)$value['sale'] / 100)
                                            + $value['cost'] * $value['quantity'] * (1 - (int)$value['sale'] / 100) * 0.1;
                                    }
                                }
                                ?>
                            <input type="hidden" id="text" name="total"  value="<?=$total1;?>">

                            <script type="text/javascript">
                                document.getElementById('city').addEventListener('change', function() {
                                    document.getElementById('text').value = this[this.selectedIndex].text;

                                });
                                document.getElementById('district').addEventListener('change', function() {
                                    document.getElementById('text').value +=", " + this[this.selectedIndex].text;

                                });
                                document.getElementById('ward').addEventListener('change', function() {
                                    document.getElementById('text').value +=", " + this[this.selectedIndex].text;

                                });
                            </script>
                        </div>
                        <div class="group">
                            <input name="note" id="note" type="text" required>
                            <label>Ghi ch??</label>
                        </div>
                    </div>
                    <br>

                    <a href="../cart/">Gi??? H??ng</a>
              
                    <input type="submit" class="btn b" value="X??c nh???n ?????t ????n" value="Submit" onclick="return checkPayment()">

                </form>

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
                                    <span class="cost">??</span></span>
                            </td>
                        </tr>


                    </table>

                <?php } ?>
                <div class="total">
                    <span class="bar"></span>
                    <p>T???m t??nh:<span style="color: red; font-weight: bold; font-size: 18px; float:right
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

                            </span> VN?? </p>
                    <p>Ph?? v???n chuy???n:<span style=" float:right
                    ">FREE </span> </p>
                    <p>Thu??? VAL: <span style=" float:right
                    ">10% </span></p>
                    <span class="bar"></span>
                    <br>
                    <p>T???ng c???ng: <span style="color: red; font-weight: bold; font-size: 20px; float:right
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

                            </span> VN??</p>
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