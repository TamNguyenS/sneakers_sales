<?php
require '../root/checklogin.php';
?>

<?php
require_once '../db.php';
require_once '../func.php';
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

$query = "SELECT product.*, product_img.img AS image FROM product INNER JOIN product_img
ON product.id = product_img.product_id WHERE NAME LIKE'%$search%' GROUP BY name LIMIT  $page_limit OFFSET $page_skip";
$records = get_list($query);

// print_r($records);
// die();
?>

<?php
$delete = empty($_GET['delete']) ? 'false' : $_GET['delete'];
if ($delete !== false) {
    $remove_chill = remove1('product_img', $delete);
    $result = remove('product', $delete);

    if ($result) {
        $msg = 'Xóa thành công';
    } else {
        $msg = 'Xóa Không thành công ';
    }
}
?>

<?php
$this_month = date('m');
$this_year = date('Y');
$count_product = get_count("SELECT count(*) FROM product");
$count_product_sold_month = get_count_v2("SELECT SUM(quantity) AS TOTAL FROM orders_detail LEFT JOIN orders ON orders_detail.orders_id = orders.id WHERE MONTH(time_accept) = $this_month ");
$count_product_sold_year = get_count_v2("SELECT SUM(quantity) AS TOTAL FROM orders_detail LEFT JOIN orders ON orders_detail.orders_id = orders.id WHERE YEAR(time_accept) = $this_year");
?>
<!DOCTYPE html>
<html>
</div>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Product</title>
    <link rel="stylesheet" href="../css/cssdb.css?v=2">
    <link rel="stylesheet" href="../css/cssmf.css?v=2">
    <link rel="stylesheet" href="../css/toast.css?v=2">
    <script src="../js/mf.js"></script>
    <!-- icon -->
    <script src="https://kit.fontawesome.com/945e1fd97f.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/font-awesome-line-awesome/css/all.min.css">
    <style>
        main {
            height: auto;
        }
    </style>

</head>

<body>
    <div id="toast"></div>
    <div class="grid-container">
        <div class="container-header">
            <?php include '../root/header.php' ?>
        </div>
        <div class="container-siderbar">
            <?php include '../root/sidebar.php' ?>

        </div>

        <div class="container-main">
            <div class="container">
                <div class="tag-name">
                <h1> <a href="../main/"> <span class="link-1"> Home-</span> </a>
                 Product</h1>
                        <br>
                </div>

            </div>


            <main>
                <div class="cards" style="margin-top:-5px; margin-bottom: 10px; ">

                    <div class="card-single">
                        <div>
                            <h1><?= $count_product ?></h1>
                            <span>Sản phẩm hiện tại</span>
                        </div>
                        <div class="card-icon" style="background-color: rgb(252, 242, 210);">
                            <span class="fa-solid fa-store" style="color: rgb(248, 225, 52)"></span>
                        </div>
                    </div>

                    <div class="card-single">
                        <div>
                            <h1> <?= $count_product_sold_month ?></h1>
                            <span>Sản phẩm bán được trong tháng này</span>
                        </div>
                        <div class="card-icon" style="  background-color: rgb(221, 230, 254);">
                            <span class="fa-regular fa-chart-bar" style=" color: rgb(30, 90, 255);"></span>
                        </div>
                    </div>
                    <div class="card-single">
                        <div>
                            <h1><?= $count_product_sold_year ?></h1>
                            <span>Sản phẩm bán được trong năm này</span>
                        </div>
                        <div class="card-icon" style="background-color: rgb(249, 219, 237);">
                            <span class="fa-solid fa-chart-bar" style="color: rgb(252, 64, 176);"></span>
                        </div>
                    </div>

                </div>
                <div class="table-content">

                    <div class="table-button">
                        <div class="btn-add">

                            <a href="./productadd.php"><button class="btn btn1" id="button"><span class="fas fa-plus-circle"></span> Thêm sản phẩm</button> </a>
                        </div>
                        <div class="btn-out">

                            <button> <span class="fa-solid fa-file-excel"></span> &nbsp; Xuất file Excel</button>
                        </div>
                        <form action=" " name="test">
                            <div class="fillter">
                            
                                <i class="fa-solid fa-arrow-up-short-wide"></i>&nbsp;

                                <select class="fillter-orders" name="statusorder" id="statusorder">

                                    <option disabled selected value="">Loại giày </option>
                                    <option value="2">Tông lào</option>
                                    <option value="1">Sneaker</option>
                                    <option value="0">Dress shoes</option>
                                    <option value="2">Bosst</option>
                                </select>

                                <!-- <input type="submit" class=""></input> -->
                            </div>
                        </form>
                    </div>

                    <table border="1px">
                        <thead>
                            <tr>
                                <th>
                                    <h3>ID</h3>
                                </th>
                                <th>
                                    <h3>Image</h3>
                                </th>
                                <th>
                                    <h3>Tên sản phẩm</h3>
                                </th>
                                <th>
                                    <h3>Giá</h3>
                                </th>
                                <th>
                                    <h3>Đã bán</h3>
                                </th>
                                <th>
                                    <h3>Mô tả</h3>
                                </th>

                                <th>
                                    <h3>Quản lí</h3>
                                </th>

                            </tr>

                            <?php foreach ($records as $post) {   ?>
                                <tr>
                                    <td>
                                        <p><span style="color: rgb(250, 35, 189); font-weight:bold">#</span><?= encodeID($post['id']) ?></p>
                                    </td>
                                    <td class="table-image">
                                        <img src="../photos/<?php echo $post['image']; ?>" style="width: 150px; height 150px; border-radius: 5px;">
                                    </td>
                                    <td>
                                        <p><?php echo $post['name']; ?> </p>
                                    </td>
                                    <td style=" width: 150px;">
                                        <p><?php echo number_format($post['cost'], 0, '', ','); ?> <span class="cost">đ</span></p>
                                    </td>
                                    <td style=" width: 150px;">
                                        <p><?php echo $post['sold']; ?></p>
                                    </td>
                                    <!-- <td>
                                   <p><php echo $post['manufacture_id']; ?> </p>
                                </td> -->
                                    <td class="table-description">
                                        <p><?php echo mb_strimwidth($post['description'], 0, 94, "..."); ?> </p>


                                    </td>

                                    </td>
                                    <td class="table-manager">
                                        <div class="table-button2">

                                            <div class="btn-delete">

                                                <button class="btn-delete-real" data-name=" <?= $post['name'] ?>" data-id="<?= $post['id'] ?>"> <span class="fa-solid fa-eraser"></span> Xóa</button>
                                            </div>
                                            <div class="btn-update">

                                                <a href="./productupdate.php?id=<?php echo $post['id'] ?>"><button> <span class="fa-regular fa-pen-to-square"></span> &nbsp; Sửa</button> </a>
                                            </div>

                                            <div class="btn-detail">

                                                <a href="./productdetail.php?id=<?php echo $post['id'] ?>"><button> <span class="fa-solid fa-square-up-right"></span> &nbsp; Chi tiết</button> </a>
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
                                <?php for ($i = 1; $i   <= $page_length; $i++) {
                                    if ($i == $page) { ?>
                                        <li class="page-item active"><a class="page-link" href="#"><?php echo $i; ?></a></li>
                                    <?php } else { ?>
                                        <li class="page-item"><a class="page-link" href="./?&search=<?php echo $search ?>&page=<?php echo $i ?>"><?php echo $i; ?></a></li>
                                <?php
                                    }
                                } ?>
                            </ul>
                        </nav>
                    </div>
                    <br>
                </div>
            </main>
        </div>

    </div>
</body>
<script src="../js/toast.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.btn-delete-real').click(function() {
            let btn = $(this);
            let id = $(this).data('id');
            let name = $(this).data('name');
            let result = confirm('Bạn có chắc muốn xóa?: ' + name);
            if (result == true) {
                $.ajax({
                    type: "GET",
                    url: "./?delete=" + id,
                    success: function(response) {
                        btn.parents('tr').remove();
                        showSuccessToast();
                    },
                    enror: function(response) {
                        showErrorToast();
                    }
                });
            }
        })
    });
</script>
<script>
    function showSuccessToast() {
        toast({
            title: "Thành công!",
            message: "Bạn đã xóa thành công",
            type: "success",
            duration: 5000
        });
    }

    function showErrorToast() {
        toast({
            title: "Thất bại!",
            message: "Có lỗi xảy ra, vui lòng liên hệ quản trị viên.",
            type: "error",
            duration: 5000
        });
    }
</script>

</html>