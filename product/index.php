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
                if(isset($_SESSION['cart'])){
                    $cart = $_SESSION['cart'];
                    
                    foreach($cart as $value){
                        $total += $value['cost'] * $value['quantity'];
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
                <div class="breadcumb">
                    <div class="text-b" style="margin-left:50px;">
                    <a href="./index.html">home</a>
                    <span><i class="fa-solid fa-angle-right"></i></span>
                    <a href="./products.html" style="font-style:italic">Tất cả sản phẩm</a>
                    </div>
                    
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
                        <div class="row-title" style="margin-top:30px;">
                            <h3>Tất cả sản phẩm <span style="font-size:15px; font-weight:normal; color:gey">(34)</span></h3>
                            <br>
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

</html>