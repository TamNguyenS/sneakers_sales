<?php
require_once '../admin/db.php';
require_once '../admin/func.php';
?>
<?php
$search = empty($_GET['search']) ? '' : $_GET['search'];
$search = validate($search);

//page 
$page = empty($_GET['page']) ? 1 : $_GET['page'];
if (!is_numeric($page)) die();

$page_limit = 6;
$page_total_length = get_count('SELECT count(*) FROM product WHERE NAME LIKE \'%' . $search . '%\'');
$page_length = ceil($page_total_length / $page_limit);
$page_skip =  $page_limit * ($page - 1);

$query = "SELECT product.* FROM product 
 WHERE NAME LIKE'% %'";
$records = get_list($query);

// print_r($records);
// die();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATShop</title>
    <!-- google font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">

    <!-- boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <!-- app css -->
    <link rel="stylesheet" href="../css/grid.css?v=2">
    <link rel="stylesheet" href="../css/app.css?v=2">
    <script src="https://kit.fontawesome.com/945e1fd97f.js" crossorigin="anonymous"></script>
    <script src="../lib/icon.js" crossorigin="anonymous"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@300&display=swap');

        .sticky {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            background: #fff;
            padding: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 .5rem 1rem rgba(97, 97, 97, 0.1);
            margin-left: -180px;

        }

        .logo-bottom {
            position: relative;
            top: 0px;
            right: 280px;
            font-size: 10px;
            display: none;
        }

        .row-title {
            float: left;
            margin-left: 100px;
        }

        .row-select {
            display: flex;
            float: right;
            position: relative;
            left: 20px;
        }

        .cart-second {
            position: absolute;
            top: 10px;
            right: 18px;
            
            font-size: 5px;
            display: none;
        }

        .count2 {
            position: absolute;
            top: -7px;
            right: -10px;
            background: rgb(245, 59, 59);
            color: white;
            font-size: 12px;
            font-weight: bold;
            line-height: 1;
            padding: 2px 4px;
            -webkit-border-radius: 20px;
            border-radius: 20px;
            justify-content: center;
        }
    </style>
</head>

<body>


    <header>
        <?php require_once '../root/header.php' ?>
    </header>
    <!-- nav -->
    <?php require_once '../root/nav-cart-user.php' ?>

    <!-- products content -->
    <div class="bg-main">
        <div class="container">
            <div class="box">
                <div class="breadcumb">
                    <a href="./index.html">home</a>
                    <span><i class="fa-solid fa-angle-right"></i></span>
                    <a href="./products.html">Tất cả sản phẩm</a>
                </div>
            </div>
            <img src="https://file.hstatic.net/200000346037/file/mockup_web_2_b93d6d62704c4cb3a0579d71c863683f.png">
            <br><br>
            <div class="box">
                <div class="row">
                    <div class="col-3 filter-col" id="filter-col">

                        <div class="box" style="border-bottom: 1px solid rgb(207, 206, 206) ">
                            <span class="filter-header">
                                <i class="fa-solid fa-angle-right"></i> Danh mục sản phẩm
                            </span>
                            <ul class="filter-list">
                                <?php $query_type = "SELECT name FROM type";
                                foreach (get_list($query_type) as $type) {
                                ?>
                                    <li> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="#"><?= $type['name'] ?></a></li>
                                <?php } ?>
                            </ul>

                        </div>

                        <div class="box" style="border-bottom: 1px solid rgb(207, 206, 206) ">
                            <span class="filter-header">
                                <i class="fa-solid fa-angle-right"></i> Giá tiền
                            </span>
                            <ul class="filter-list">
                                <li>
                                    <div class="group-checkbox">
                                        <input type="checkbox" id="status1">
                                        <label for="status1">
                                            <span style="color:grey; font-weight:bold">Dưới 1,000,000₫</span>
                                            <i class='bx bx-check'></i>
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="group-checkbox">
                                        <input type="checkbox" id="status2">
                                        <label for="status2">
                                            <span style="color:grey; font-weight:bold">1tr -5,000,000₫</span>
                                            <i class='bx bx-check'></i>
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="group-checkbox">
                                        <input type="checkbox" id="status3">
                                        <label for="status3">
                                            <span style="color:grey; font-weight:bold">Dưới 10,000,000₫</span>
                                            <i class='bx bx-check'></i>
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="group-checkbox">
                                        <input type="checkbox" id="status4">
                                        <label for="status4">
                                            <span style="color:grey; font-weight:bold">Trên 10,000,000₫</span>
                                            <i class='bx bx-check'></i>
                                        </label>
                                    </div>
                                </li>
                            </ul>

                        </div>

                        <div class="box" style="border-bottom: 1px solid rgb(207, 206, 206) ">
                            <span class="filter-header">
                                <i class="fa-solid fa-angle-right"></i> Thương hiệu
                            </span>
                            <ul class="filter-list">
                                <?php $query_type = "SELECT name FROM manufacture";
                                foreach (get_list($query_type) as $type) {
                                ?>
                                    <li> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="#"><?= $type['name'] ?></a></li>
                                <?php } ?>
                            </ul>

                        </div>

                    </div>

                    <div class="col-9 col-md-12">
                        <div class="row-title">
                            <h2>Tất cả sản phẩm</h2>
                            <br><br>
                        </div>

                        <div class="row-select">

                            <select class="">
                                <option>Giá: Tăng dần</option>
                                <option>Tên: Z-A</option>
                                <option>Tên: Z-A</option>
                                <option>Tên: Z-A</option>
                            </select>
                        </div>

                        <div class="box">


                            <div class="row products-d" id="products">

                                <?php foreach ($records as $record) {
                                    $id = $record['id'];
                                    $query_img = "SELECT img FROM product_img WHERE product_id =  $id ";
                                    $get_list_img = get_list($query_img);
                                ?>
                                    <div class="col-4 col-md-6 col-sm-12">
                                        <div class="product-card">
                                            <div class="product-card-img">
                                                <img src="../admin/photos/<?= $get_list_img[0]['img'] ?>" alt="">
                                                <img src="../admin/photos/<?= $get_list_img[1]['img'] ?>" alt="">
                                            </div>
                                            <div class="product-card-info">
                                                <div class="product-btn">
                                                    <a href="./product-detail.html" class="btn-flat btn-hover btn-shop-now">Chi tiết </a>
                                                    <button class="btn-flat btn-hover btn-cart-add">
                                                        <i class='bx bxs-cart-add'></i>
                                                    </button>
                                                    <button class="btn-flat btn-hover btn-cart-add">
                                                        <i class='bx bxs-heart'></i>
                                                    </button>
                                                </div>
                                                <div class="product-card-name">
                                                    <?= $record['name'] ?>
                                                </div>
                                                <div class="product-card-price">
                                                    <span><del><?php echo number_format($record['cost'], 0, '', ','); ?></del></span>
                                                    <br>
                                                    <span class="curr-price"><?php echo number_format($record['cost'], 0, '', ','); ?> <span class="cost">đ</span></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>


                        </div>
                        <div class="box">
                            <ul class="pagination">
                                <li><a href="#"><i class='bx bxs-chevron-left'></i></a></li>
                                <li><a href="#" class="active">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li><a href="#"><i class='bx bxs-chevron-right'></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end products content -->
    <div class="box">
        <div class="breadcumb" style=" padding: 30px">
            <div class="text-bread" style=" margin-left: 100px">
                <i class="fa fa-phone "></i>
                &nbsp;&nbsp;
                <a href="./index.html">Liên hệ</a>
                <span><i class="fa-solid fa-angle-right"></i></span>
                <a href="./products.html">Hổ trợ : <span style="color: red">Hikkywannafly</span></a>
            </div>

        </div>
    </div>
    <footer class="bg-second">
        <?php require_once '../root/footer.php' ?>
    </footer>

    <!-- app js -->
    <script src="./js/app.js"></script>
    <script src="./js/products.js"></script>
    <script src="./js/index.js"></script>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    var yourNavigation = $(".bottom-header");
    var logo = $('.logo-bottom');
    stickyDiv = "sticky";
    yourHeader = $('.mid-header').height();

    $(window).scroll(function() {
        if ($(this).scrollTop() > yourHeader) {
            yourNavigation.addClass(stickyDiv);

            $(".logo-bottom").css("display", "block");
            $(".cart-second ").css("display", "block");
            
        } else {
            yourNavigation.removeClass(stickyDiv);
            $(".logo-bottom").css("display", "none");
            $(".cart-second ").css("display", "none");

        }
    });
</script>
<script>
    var nav_cart_user = $('.navbar');
    $(document).ready(function() {
        $('.click-user').click(function() {
            nav_cart_user.addClass("active");
        });
        $('#close').click(function() {
            nav_cart_user.removeClass("active");
        });
    });
</script>

</html>