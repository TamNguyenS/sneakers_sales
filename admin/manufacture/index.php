<?php
$name = isset($_POST['name']) ? $_POST['name'] : false;
$address = isset($_POST['address']) ? $_POST['address'] : false;
$phone = isset($_POST['phone']) ? $_POST['phone'] : false;
$email = isset($_POST['email']) ? $_POST['email'] : false;
$date = isset($_POST['datee']) ? $_POST['datee'] : false;
$note = isset($_POST['note']) ? $_POST['note'] : false;

$isEnror = false;
$isSumit = false;
$Enror = '';
$msg = '';

if (
    $name != false
    && $address != false
    && $phone != false
    && $email != false
    && $date != false
    && $note != false
) {
    $isSumit = true;
    require '../db.php';
    require '../func.php.php';

    if (!isEmail($email)) {
        $isEnror = true;
        $Enror .= 'Email Không hợp lệ';
    }
    if (!isPhone($phone)) {
        $isEnror = true;
        $Enror .= 'Số điện thoại không hợp lệ ';
    }
    if (!isname($name)) {
        $isEnror = true;
        $Enror .= 'Tên không hợp lệ ';
    }

    if (!$isEnror) {
        $result =  insert('manufacture', array(
            'name' => $name,
            'age' => $age,
            'address' => $address,
            'phone' => $phone,
            'email' => $email,
            'datee' => $date,
            'note' => $note,
        ));
        if ($result) {
            $msg = "Thêm thành công";
        }
        else {
            $msg = "Thêm thất bại";
        }
    }
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard </title>
    <link rel="stylesheet" href="../css/cssdb.css">
    <link rel="stylesheet" href="../css/cssmf.css">
    <script src="../js/mf.js"></script>
    <!-- icon -->
    <script src="https://kit.fontawesome.com/945e1fd97f.js" crossorigin="anonymous"></script>
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/font-awesome-line-awesome/css/all.min.css">
</head>

<body>
    <div id="main">  
    <div class="side-menu">
        <div class="barnd-logo">
            <img src="../img/logo.png" style=" width: 100px; height: 100px;">
        </div>
        <div class="barnd-name">
            <h2> Hikky's shop</h2>
        </div>
        <ul>
            <li class="tool"> <a href="#"> <img src="../img/eye.png" alt="anh"> <span> &nbsp;&nbsp; Tổng quan</span>
                </a>
            </li>
            <li></li>
            <li class="tool"> <a href="#"> <img src="../img/chart-histogram.png" alt="anh"> <span> &nbsp;&nbsp; Thống kê
                </a> </span></li>
            <li></li>
            <li class="tool"> <a href="#"> <img src="../img/shopping-cart1.png" alt="anh"> <span> &nbsp;&nbsp;Các mặt
                        hàng </a> </span></li>
            <li></li>
            <li class="tool"><a href="#"><img src="../img/shopping-cart.png" alt="anh"><span> &nbsp;&nbsp;Đơn hàng
                    </span> </a> </li>
            <li></li>
            <li class="tool"><a href="./manufacture/"> <img src="../img/briefcase.png" alt="anh"> <span> &nbsp;&nbsp;Nhà
                        cung cấp </span> </a></li>
            <li></li>
            <li class="tool"><a href="#"> <img src="../img/clock.png" alt="anh"> <span> &nbsp;&nbsp;Lịch sử GD </span>
                </a></li>
            <li></li>
            <li class="tool"> <a href="#"><img src="../img/info.png " alt="anh"><span> &nbsp;&nbsp; Thông tin </span>
                </a> </li>
            <li></li>
        </ul>
    </div>

    <div class="container">
        <header>
            <div class="search-wrapper">
                <span class="fa fa-search"> </span>
                <input placeholder="Search">
            </div>

            <div class="user-wrapper">
                <img src="../img/rikka.png" alt="anh" width="40px" height="40px" style="border-radius: 50px;">
                <div>
                    <h4>Hikky nè</h4>
                    <small>Super admin</small>
                </div>
            </div>
        </header>




        <div class="tag-name">

            <h2> Nhà cung cấp</h2>
        </div>

    </div>


    <main>
        <div class="cards">
            <div class="card-single">
                <div>
                    <h1> 45</h1>
                    <span>Nhà sản xuất hiện tại</span>
                </div>
                <div>
                    <span class="fa fa-industry"> </span>
                </div>
            </div>

            <div class="card-single">
                <div>
                    <h1> 45</h1>
                    <span>Nhà sản xuất trong tháng này</span>
                </div>
                <div>
                    <span class="fa fa-line-chart"> </span>
                </div>
            </div>
            <div class="card-single">
                <div>
                    <h1> 45</h1>
                    <span>Nhà sản xuất trong tháng này</span>
                </div>
                <div>
                    <span class="fa fa-line-chart"> </span>
                </div>
            </div>
        </div>

        <div class="table-content">
            <div class="table-button">
                <div class="btn-add">

                    <button class="btn btn1" id="button" onclick="turn_on()"><span class="fas fa-plus-circle"
                            style="color: rgb(238, 56, 223); "></span> Thêm nhà sản xuất</button>
                </div>
                <div class="btn-out">

                    <button> <span class="fas fa-file-excel" style="color: rgb(14, 172, 40);"></span> &nbsp; Xuất file
                        Excel</button>
                </div>

            </div>

            <table border="1px">
                <thead>
                    <tr>
                        <th>
                            <h3>ID</h3>
                        </th>
                        <th>
                            <h3>Tên nhà sản xuất</h3>
                        </th>
                        <th>
                            <h3>Địa chỉ</h3>
                        </th>
                        <th>
                            <h3>Email</h3>
                        </th>
                        <th>
                            <h3>Điện thoại</h3>
                        </th>
                        <th>
                            <h3>Ngày thêm</h3>
                        </th>
                        <th>
                            <h3>Ghi chú</h3>
                        </th>
                        <th>
                            <h3>Quản lí</h3>
                        </th>

                    </tr>
                    <tr>
                        <td>
                            <p>1</p>
                        </td>
                        <td>
                            <p>Nguyễn Chí Tâm</p>
                        </td>
                        <td>
                            <p>Amarica</p>
                        </td>
                        <td>
                            <p>adidas@gmail.com</p>
                        </td>
                        <td>
                            <p>0766614580</p>
                        </td>
                        <td>
                            <p>20/21/2022</p>
                        </td>
                        <td>
                            <p>ok ok</p>
                        </td>
                        <td>
                            <div class="table-button2">
                                <div class="btn-delete">

                                    <button><span class="fa fa-times"></span> Xóa</button>
                                </div>
                                <div class="btn-update">

                                    <button> <span class="fa fa-eraser"></span> &nbsp; Sửa</button>
                                </div>

                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>1</p>
                        </td>
                        <td>
                            <p>Nguyễn Chí Tâm</p>
                        </td>
                        <td>
                            <p>Amarica</p>
                        </td>
                        <td>
                            <p>adidas@gmail.com</p>
                        </td>
                        <td>
                            <p>0766614580</p>
                        </td>
                        <td>
                            <p>20/21/2022</p>
                        </td>
                        <td>
                            <p>ok ok</p>
                        </td>
                        <td>
                            <div class="table-button2">
                                <div class="btn-delete">

                                    <button "><span class="fa fa-times"></span> Xóa</button>
                                </div>
                                <div class="btn-update">

                                    <button> <span class="fa fa-eraser"></span> &nbsp; Sửa</button>
                                </div>

                            </div>
                        </td>
                    </tr>

                </thead>
            </table>
            <br>
        </div>

    </main>

</div>

    <div class="row2">
        <div id="from-add">
            <span id="exit" onclick="turn_off()">x</span>
            <div class="form-content">
                <form method="post">
                    <p>Nhập tên nhà sản xuất </p>
                    <input type="text" name="name" id="name" required placeholder="Nhập tên nhà sản xuất">
                    <p>Nhập địa chỉ: </p>
                    <input type="text" name="address" id="address" required placeholder="Nhập địa chỉ ">
                    <p>Email liên hệ: </p>
                    <input type="email" name="email" id="email" required placeholder="Email liên hệ">
                    <p>Số điện thoại liên hệ: </p>
                    <input type="text" name="name" id="name" required placeholder="Số điện thoại liên hệ">
                    <p>Ngày thêm: </p>
                    <input type="date" name="datee" required id="datee">
                    <p>Ghi chú: </p>
                    <input type="text" name="note" required id="note">
                    <div class="table-button">
                        <div class="btn-ok">
                        <button > OK </button>
                        </div>
                   
                    </div>
              
                </form>
            </div>

        </div>


    </div>
</body>
</html>