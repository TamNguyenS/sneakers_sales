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
    <link rel="stylesheet" href="../css/grid.css">
    <link rel="stylesheet" href="../css/app.css">
    <script src="https://kit.fontawesome.com/945e1fd97f.js" crossorigin="anonymous"></script>
    <script src="../lib/icon.js" crossorigin="anonymous"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@200&display=swap');

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
            margin-left: -185px;
        }

        .logo-bottom {
            position: relative;
            top: 0px;
            right: 400px;
            font-size: 10px;
            display: none;
        }

        .row-title {
            float: left;
        }

        .row-select {
            display: flex;
            float: right;
            position: relative;
            left: 20px;
        }
    </Style>
</head>

<body>

    <!-- header -->
    <header>
        <!-- main header -->
        <div class="header-wrapper" id="header-wrapper">
            <span class="mb-menu-toggle mb-menu-close" id="mb-menu-close">
                <i class='bx bx-x'></i>
            </span>
            <!-- top header -->

            <!-- end top header -->
            <!-- mid header -->
            <div class="bg-main">
                <div class="mid-header container">

                    <img style="width:180px" src="https://file.hstatic.net/200000346037/file/toptokago_b47efd92e9634fac8ed8e2583d341e60.png">
                    <div class="search">
                        <input type="text" placeholder="Search">
                        <i class='bx bx-search-alt'></i>
                    </div>
                    <ul class="user-menu">
                        <li><a href="#"><i class='bx bx-bell'></i></a></li>
                        <li><a href="#"><i class='bx bx-user-circle'></i></a></li>
                        <li><a href="#"><i class='bx bx-cart'></i></a></li>
                    </ul>
                </div>
            </div>
            <!-- end mid header -->
            <!-- bottom header -->
            <div class="bg-second">
                <div class="bottom-header container">
                    <ul class="main-menu">
                        <div class="logo-bottom">
                            <img style="width:180px" src="https://file.hstatic.net/200000346037/file/toptokago_b47efd92e9634fac8ed8e2583d341e60.png">
                        </div>

                        <li><a href="#">home</a></li>
                        <!-- mega menu -->
                        <li class="mega-dropdown">
                            <a href="./products.html">Sản phẩm<i class='bx bxs-chevron-down'></i></a>
                            <div class="mega-content">
                                <div class="row">
                                    <div class="cmd-12">
                                        <div class="box">
                                            <h3> Danh mục sản phẩm</h3><span>  </span>
                                            <div class="animation">

                                                <ul class="">
                                                    <li><a href="#">Tất cả sản phẩm</a></li>
                                                    <?php $query_type = "SELECT name FROM type";
                                                    foreach (get_list($query_type) as $type) {
                                                    ?>
                                                        <li><a href="#"><?= $type['name'] ?></a></li>
                                                    <?php } ?>
                                                </ul>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </li>
                        <!-- end mega menu -->
                        <li><a href="#">blog</a></li>
                        <li><a href="#">contact</a></li>

                    </ul>
                </div>
            </div>



            <!-- end bottom header -->
        </div>
        <!-- end main header -->
    </header>
    <!-- end header -->



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

                        <div class="box">
                            <span class="filter-header">
                            <i class="fa-solid fa-angle-right"></i>   Danh mục sản phẩm 
                            </span>
                            <ul class="filter-list">
                                <?php $query_type = "SELECT name FROM type";
                                foreach (get_list($query_type) as $type) {
                                ?>
                                    <li> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="#"><?= $type['name'] ?></a></li>
                                <?php } ?>
                            </ul>

                        </div>
                        <div class="box">
                            <span class="filter-header">
                            <i class="fa-solid fa-angle-right"></i>   Giá tiền
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



                    </div>

                    <div class="col-9 col-md-12">
                        <div class="row-title">
                            <h3>Tất cả sản phẩm</h3>
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

    <!-- footer -->
    <footer class="bg-second">
        <div class="container">
            <div class="row">
                <div class="col-3 col-md-6">
                    <h3 class="footer-head">Products</h3>
                    <ul class="menu">
                        <li><a href="#">Help center</a></li>
                        <li><a href="#">Contact us</a></li>
                        <li><a href="#">product help</a></li>
                        <li><a href="#">warranty</a></li>
                        <li><a href="#">order status</a></li>
                    </ul>
                </div>
                <div class="col-3 col-md-6">
                    <h3 class="footer-head">services</h3>
                    <ul class="menu">
                        <li><a href="#">Help center</a></li>
                        <li><a href="#">Contact us</a></li>
                        <li><a href="#">product help</a></li>
                        <li><a href="#">warranty</a></li>
                        <li><a href="#">order status</a></li>
                    </ul>
                </div>
                <div class="col-3 col-md-6">
                    <h3 class="footer-head">support</h3>
                    <ul class="menu">
                        <li><a href="#">Help center</a></li>
                        <li><a href="#">Contact us</a></li>
                        <li><a href="#">product help</a></li>
                        <li><a href="#">warranty</a></li>
                        <li><a href="#">order status</a></li>
                    </ul>
                </div>
                <div class="col-3 col-md-6 col-sm-12">
                    <div class="contact">
                        <h3 class="contact-header">
                            ATShop
                        </h3>
                        <ul class="contact-socials">
                            <li><a href="#">
                                    <i class='bx bxl-facebook-circle'></i>
                                </a></li>
                            <li><a href="#">
                                    <i class='bx bxl-instagram-alt'></i>
                                </a></li>
                            <li><a href="#">
                                    <i class='bx bxl-youtube'></i>
                                </a></li>
                            <li><a href="#">
                                    <i class='bx bxl-twitter'></i>
                                </a></li>
                        </ul>
                    </div>
                    <div class="subscribe">
                        <input type="email" placeholder="ENTER YOUR EMAIL">
                        <button>subscribe</button>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end footer -->

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
        } else {
            yourNavigation.removeClass(stickyDiv);
            $(".logo-bottom").css("display", "none");
        }
    });
</script>

</html>