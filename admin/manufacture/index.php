<?php
$name = isset($_POST['name']) ? $_POST['name'] : false;
//fix sửa địa chỉ thành danh mục nhỏ//
$address = isset($_POST['address']) ? $_POST['name'] : false;
$phone = isset($_POST['phone']) ? $_POST['phone'] : false;
$email = isset($_POST['email']) ? $_POST['email'] : false;
$date = isset($_POST['datee']) ? $_POST['datee'] : false;
$note = isset($_POST['note']) ? $_POST['note'] : false;

$isSubmit = false; //submit
$error = ''; //loi
$msg = ''; //thong bao
$isError = false; //loi

if (
    $name !== false
    && $address !== false
    && $phone !== false
    && $email !== false
    && $date !== false
    && $note !== false

) {

    $isSubmit = true;
    require_once '../db.php';
    require_once '../func.php';
    // fix validate
    // if (!isName($name)) {
    //     $error .= 'Tên không hợp lệ<br>';
    //     $isError = true;
    // }
    // if (!isPhone($phone)) {
    //     $error .= 'Số điện thoại không hợp lệ<br>';
    //     $isError = true;
    // }
    // if (!isEmail($email)) {
    //     $error .= 'Email không hợp lệ<br>';
    //     $isError = true;
    // }
    // if (isName($address)) {
    //     $error .= 'Địa chỉ không hợp lệ<br>';
    //     $isError = true;
    // }
    if (!$isError) {
        $result = insert('manufacture', array(
            'name' => $name,
            'address' => $address,
            'phone' => $phone,
            'email' => $email,
            'datee' => $date,
            'note' => $note
        ));

        if ($result) {
            $msg = 'Chúc mừng bạn đã thêm thành công !<br>';
        } else {
            $error = 'Có lỗi xảy ra, vui lòng thử lại sau!<br>';
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
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/font-awesome-line-awesome/css/all.min.css">
</head>

<body>

    <div class="row2">
        <div id="from-add" style="display: none;">
            <span id="exit" onclick="turn_off()">x</span>
            <div class="form-content">
                <form action="" method="POST">
                    <p>Nhập tên nhà sản xuất </p>
                    <input type="text" name="name" required placeholder="Nhập tên nhà sản xuất">
                    <p>Nhập địa chỉ: </p>
                    <input type="text" name="address" required placeholder="Nhập địa chỉ ">
                    <p>Email liên hệ: </p>
                    <input type="email" name="email" required placeholder="Email liên hệ">
                    <p>Số điện thoại liên hệ: </p>
                    <input type="phone" name="phone" required placeholder="Số điện thoại liên hệ">
                    <p>Ngày thêm: </p>
                    <input type="date" name="datee" required>
                    <p>Ghi chú: </p>
                    <input type="text" name="note" required>
                    <div class="table-button">
                        <div class="btn-ok">
                            <button> OK </button>
                        </div>

                    </div>

                </form>
            </div>

        </div>


    </div>
    <div id="main">

        <div class="side-menu">
            <!-- Tạo pop-up thông báo -->
            <?php echo $msg ?>
            <?php echo $error ?>
            <?php
            ini_set('display_errors', 'On');
            error_reporting(E_ALL); ?>
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
        <?php

        require_once '../db.php';
        require_once '../func.php';

        $search = empty($_GET['search']) ? '' : $_GET['search'];
        $search = validate($search);

        //page 
        $page = empty($_GET['page']) ? 1 : $_GET['page'];
        if (!is_numeric($page)) die();

        $page_limit = 6;
        $page_total_length = get_count('SELECT count(*) FROM manufacture WHERE NAME LIKE \'%' . $search . '%\'');
        $page_length = ceil($page_total_length / $page_limit);
        $page_skip =  $page_limit * ($page - 1);

        $query = "SELECT * FROM manufacture WHERE NAME LIKE '%$search%' LIMIT  $page_limit OFFSET $page_skip";
        $records = get_list($query);

        ?>
        <div class="container">
            <header>
                <div class="search-wrapper">
                    <span class="fa fa-search"> </span>
                    <form method="get" action="">
                        <input placeholder="Search" name="search" type="search" value="<?php echo  $search; ?>">
                    </form>

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

                        <button class="btn btn1" id="button" onclick="turn_on()"><span class="fas fa-plus-circle" style="color: rgb(238, 56, 223); "></span> Thêm nhà sản xuất</button>
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
                        <?php foreach ($records as $post) { ?>
                            
                            <tr>
                                <td>
                                    <p><?php echo $post['id'] ?></p>
                                </td>
                                <td>
                                    <p><?php echo $post['name'] ?></p>
                                </td>
                                <td>
                                    <p><?php echo $post['address'] ?></p>
                                </td>
                                <td>
                                    <p><?php echo $post['email'] ?></p>
                                </td>
                                <td>
                                    <p><?php echo $post['phone'] ?></p>
                                </td>
                                <td>
                                    <p><?php echo $post['datee'] ?></p>
                                </td>
                                <td>
                                    <p><?php echo $post['note'] ?></p>
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
                        <?php } ?>
                    </thead>
                </table>
                <br>
                <div class="page">
                    <nav class="pagination-outer" aria-label="Page navigation">
                        <ul class="pagination">
                           <?php for($i = 1 ; $i <= $page_length;$i ++){
                            if( $i == $page){?>
                            <li class="page-item active"><a class="page-link" href="#"><?php echo $i; ?></a></li>
                            <?php } else{ ?>
                                <li class="page-item"><a class="page-link" href="./?page=<?php echo $i ?>"><?php echo $i; ?></a></li>
                            <?php
                                 }
                             } ?>
                        </ul>
                    </nav>
                </div>
                <br>
        </main>

    </div>


</body>

</html>