<?php
require_once '../admin/process_root/check_session.php';
require_once '../admin/db.php';
require_once '../admin/func.php';



$type_id = isset($_POST['type_id']) ? $_POST['type_id'] : '';
$brand_id = isset($_POST['brand_id']) ? $_POST['brand_id'] : '';
$search = empty($_GET['search']) ? '' : $_GET['search'];
$search = validate($search);

//page 
$page = empty($_GET['page']) ? 1 : $_GET['page'];
if (!is_numeric($page)) die();

$page_limit = 20;
$page_total_length = get_count("SELECT count(*) FROM product WHERE NAME LIKE '%$search%' AND TYPE_ID = '$type_id' AND manufacture_id = '$brand_id'");
$page_length = ceil($page_total_length / $page_limit);
$page_skip =  $page_limit * ($page - 1);
$query = "SELECT product.* ,MONTH(date) as month, DAY(date) as day FROM product 
 WHERE NAME LIKE'% %' AND type_id ='$type_id' OR manufacture_id = '$brand_id'  ORDER BY id DESC  LIMIT  $page_limit OFFSET $page_skip";
$records = get_list($query);

if($type_id == ''){
    echo' <h1> Khum có sản phẩm nào cả!! </h1>';
}
?>

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
                <li><a href="./?&search=<?= $search ?>&page=<?=$i?>&type=<?=$type_id?>"        
            ><?= $i; ?></a></li>
        <?php
            }
        } ?>
        <!-- <li><a href="#" class="active">1</a></li>
<li><a href="#">2</a></li> -->
        <li><a href="#"><i class='bx bxs-chevron-right'></i></a></li>
    </ul>
</div>
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
