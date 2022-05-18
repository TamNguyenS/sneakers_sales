<?php
require_once '../admin/process_root/check_session.php';
require_once '../admin/db.php';
require_once '../admin/func.php';
?>
<?php
$search = empty($_GET['search']) ? '' : $_GET['search'];
$search = validate($search);

//page 
$page = empty($_GET['page']) ? 1 : $_GET['page'];
if (!is_numeric($page)) die();

$page_limit = 20;
$page_total_length = get_count('SELECT count(*) FROM product WHERE NAME LIKE \'%' . $search . '%\'');

$page_length = ceil($page_total_length / $page_limit);
$page_skip =  $page_limit * ($page - 1);

$query = "SELECT product.* ,MONTH(date) as month, DAY(date) as day FROM product 
 WHERE NAME LIKE'%$search %' ORDER BY id DESC  LIMIT  $page_limit OFFSET $page_skip";
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
    <link rel="stylesheet" href="../css/loading.css?v=2">
    <style>
        .activeimg {
            border: 1 solid black;
        }
        .active1{
    color:white;
    background-color:rgb(55, 55, 55);
}

    </style>
</head>

<body onload="slider()">

    <div class="loading" hidden>
        <div>
            <div class="c1"></div>
            <div class="c2"></div>
            <div class="c3"></div>
            <div class="c4"></div>
        </div>
        <span>loading</span>
    </div>
    <header>
        <?php require_once '../root/header.php' ?>
    </header>


    <?php require_once '../root/user.php' ?>

    
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
                        <a href="./products.html" style="font-style:italic">Tất cả sản phẩm</a>
                    </div>

                </div>
            </div>

            <!-- <img src="https://file.hstatic.net/200000346037/file/mockup_web_2_b93d6d62704c4cb3a0579d71c863683f.png"> -->
            <!-- <div class="slider">
                <div class="slider-banner">
                    <img id="slideImg" class="zoom" style="width: 100%; height: 500px; max-height: 500px;" src="./6.jpg">
                </div>
            </div> -->
            <img id="slide" class="zoom" style="width: 100%;  max-height: 500px;" src="https://file.hstatic.net/200000346037/file/mockup_web_2_b93d6d62704c4cb3a0579d71c863683f.png">

            <br><br>


            <div class="box">
                <div class="row">


                    <?php require_once '../root/filter.php' ?>


                    <div class="col-9 col-md-12">
                        <div class="row-title title-product" style="margin-top:30px;">
                            <h3>Tất cả sản phẩm <span style="font-size:15px; font-weight:normal; color:gey"></span></h3>
                            <br>
                        </div>

                        <div class="row-select">

                            <select class="">

                                <!-- <option>Sắp xếp <i class="fa-solid fa-angles-down"></i>< /option> -->
                                <option>Giá: Tăng dần &#xf103;</option>
                                <option>Tên: Z-A</option>
                                <option>Tên: Z-A</option>
                                <option>Tên: Z-A</option>
                            </select>
                        </div>

                        <div class="box">


                            <div id="product-zone">



                                <div class="row products-d " id="products">

                                    <?php foreach ($records as $record) {

                                        $id = $record['id'];
                                        $query_img = "SELECT img FROM product_img WHERE product_id =  $id ";
                                        $get_list_img = get_list($query_img);
                                    ?>
                                        <div class="col-4 showimg">
                                            <div class="product-card">
                                                <?php
                                                $this_day = date('d');
                                                $this_month = date('m');
                                                $product_day = (int)$record['day'];
                                                $product_month = (int)$record['month'];
                                                if ((int)$this_month == $product_month) {
                                                    echo '
                <div class="discount">
                 <p>New</p>
                </div>
            ';
                                                }
                                                if ($record['sale'] != null) {
                                                    echo '
            <div class="discount blue">
             <p>Sale</p>
            </div>
        ';
                                                }
                                                ?>
                                                <!-- <div class="discount">
                <p>New</p>
            </div> -->
                                                <div class="sale">
                                                    <p>- <?php
                                                            if ($record['sale'] == null) echo 0;
                                                            echo $record['sale'];

                                                            ?>%</p>
                                                </div>
                                                <div class="product-card-img">
                                                    <picture>
                                                        <img src="../admin/photos/<?= $get_list_img[0]['img'] ?>" alt="">
                                                    </picture>
                                                    <picture>
                                                        <img src="../admin/photos/<?= $get_list_img[1]['img'] ?>" alt="">
                                                    </picture>


                                                </div>
                                                <div class="product-card-info">
                                                    <div class="product-btn">
                                                        <a href="../productdetail/?id=<?= $record['id'] ?>" class="btn-flat btn-hover btn-shop-now">Chi tiết </a>

                                                        <button class="btn-flat btn-hover btn-cart-add btn-cart-add-to" id="cart-add-id" value="<?= $record['id'] ?>">
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
                                                        <span class="curr-price"><?php
                                                                                    $discount = (int)$record['sale'];
                                                                                    $cost = (float) $record['cost'] * (1 - $discount / 100);

                                                                                    echo number_format($cost, 0, '', ','); ?> <span class="cost">đ</span></span>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="box pagee">
                                    <ul class="pagination">
                                        <li><a href="#"><i class='bx bxs-chevron-left'></i></a></li>
                                        <?php for ($i = 1; $i <= $page_length; $i++) {
                                            if ($i == $page) { ?>
                                                <li><a class="active" href="#"><?php echo $i; ?></a></li>
                                            <?php } else { ?>
                                                <li><a href="./?&search=<?php echo $search ?>&page=<?php echo $i ?>"><?php echo $i; ?></a></li>
                                        <?php
                                            }
                                        } ?>
                                        <!-- <li><a href="#" class="active">1</a></li>
                                <li><a href="#">2</a></li> -->
                                        <li><a href="#"><i class='bx bxs-chevron-right'></i></a></li>
                                    </ul>
                                </div>





                            </div>
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
    var $loading = $('.loading').hide();

    $(document).ready(function() {
        $('.filter-product-type').click(function() {
            let type_id = $(this).data('id');
            console.log(type_id);
            // $loading.show();
            $.ajax({
                type: "POST",
                url: "../content/product.php",
                data: "type_id=" + type_id,
                beforeSend: function() {
                    $loading.show();

                },
                success: function(response) {
                    setTimeout(function() {
                        $loading.hide();

                        $('#product-zone').html(response);

                    }, 2000);
                }
            });
            $.ajax({
                type: "POST",
                url: "../content/title.php",
                data: "type_id=" + type_id,
                success: function(response) {
                    setTimeout(function() {
                        $('.title-product').html(response);

                    }, 2000);


                }
            });

        })
        $('.filter-product-brand').click(function() {
            let brand_id = $(this).data('id');
            console.log(type_id);
            // $loading.show();
            $.ajax({
                type: "POST",
                url: "../content/product.php",
                data: "brand_id=" + brand_id,
                beforeSend: function() {
                    $loading.show();

                },
                success: function(response) {
                    setTimeout(function() {
                        $loading.hide();
                        $('#product-zone').html(response);

                    }, 2000);
                }
            });

        })

    });
</script>
<script>
    var img = document.getElementById('slideImg');
    var images = new Array(
        "1.jpg",
        "2.jpg",
        "3.jpg"

    );
    var i = 0;
    var length = images.length;

    function slider() {
        if (i > length - 1) {
            i = 0;
        }
        img.src = images[i];
        i++;
        setTimeout('slider()', 3000);
    }
</script>
<script>
    $(document).ready(function() {
        let boll = true;
        $('.filter-header').click(function() {
            let data = $(this).data('id');
            if (boll) {
                $(`#${data}`).hide();
                $(`.${data}`).addClass('rotate');
                boll = false;
            } else {
                $(`#${data}`).show();
                $(`.${data}`).removeClass('rotate');
                boll = true;
            }
        });

    });
</script>

</html>