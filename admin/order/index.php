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
$page_total_length = get_count('SELECT count(*) FROM orders WHERE recipent_name LIKE \'%' . $search . '%\'');
$page_length = ceil($page_total_length / $page_limit);
$page_skip =  $page_limit * ($page - 1);

$query = "SELECT orders.* , customer.name as customer_name, 
customer.phone as customer_phone, customer.address as customer_address 
FROM orders INNER JOIN customer ON orders.recipient_id = customer.id
WHERE recipent_name LIKE '%$search%' LIMIT  $page_limit OFFSET $page_skip";

$records = get_list($query);
?>

<!DOCTYPE html>
<html>
</div>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Order</title>
    <link rel="stylesheet" href="../css/cssdb.css?v=2">
    <link rel="stylesheet" href="../css/cssmf.css?v=2">
    <script src="../js/mf.js"></script>
    <!-- icon -->
    <script src="https://kit.fontawesome.com/945e1fd97f.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/font-awesome-line-awesome/css/all.min.css">
</head>

<body>

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
                    <h1> Đơn hàng hiện tại </h1>
                </div>

            </div>
            <main>
                <div class="cards" style="margin-top:-5px; margin-bottom: 10px;  margin-left: 100px;  grid-template-columns: repeat(5, 1fr);">

                    <div class="card-single">
                        <div>
                            <h1> 15</h1>
                            <span>Tổng số đơn</span>
                        </div>
                        <div class="card-icon" style="background-color: rgb(252, 242, 210);">
                            <span class="fa-solid fa-store" style="color: rgb(248, 225, 52)"></span>
                        </div>
                    </div>

                    <div class="card-single">
                        <div>
                            <h1> 13</h1>
                            <span>Tổng số đơn hôm nay</span>
                        </div>
                        <div class="card-icon" style="  background-color: rgb(221, 230, 254);">
                            <span class="fa-solid fa-file-invoice-dollar" style=" color: rgb(30, 90, 255);"></span>

                        </div>
                    </div>
                    <div class="card-single">
                        <div>
                            <h1> 13</h1>
                            <span>Đơn đang chờ xử lý</span>
                        </div>
                        <div class="card-icon" style="background-color: rgb(249, 219, 237);">
                            <span class="fa-solid fa-chart-bar" style="color: rgb(252, 64, 176);"></span>
                        </div>
                    </div>
                    <div class="card-single">
                        <div>
                            <h1> 13</h1>
                            <span>Đơn đã hủy</span>
                        </div>
                        <div class="card-icon" style="background-color: #ffe9ed;">
                            <span class="fa-solid fa-sack-xmark" style="color: #f3272a;;"></span>

                        </div>
                    </div>

                </div>
                <div class="table-content">
                    <!-- <php echo $msg ?> -->
                    <div class="table-button">
                        <div class="btn-add">

                            <a href="./manufactureadd.php"><button class="btn btn1" id="button"><span class="fas fa-plus-circle"></span>Đơn chưa duyệt</button> </a>
                        </div>
                        <div class="btn-out">

                            <button> <span class="fa-solid fa-file-excel"></span> &nbsp; Xuất file Excel</button>
                        </div>

                    </div>
                    <div class="fillter">
                        <select class="" value="Sắp xếp">
                            <option value="">Sắp xếp1</option>
                            <option value="">Sắp xếp2</option>
                        </select>
                    </div>

                    <table border="1px">
                        <thead>
                            <tr>
                                <th>
                                    <h3>ID  </h3>
                                </th>
                                <th>
                                    <h3>Thời gian đặt &nbsp;<i class="fa-solid fa-caret-down"></i></h3>
                                </th>
                                <th>
                                    <h3>Thông tin người nhận</h3>
                                </th>
                                <th>
                                    <h3>Thông tin người đặt</h3>
                                </th>
                                <th>
                                    <h3>Trạng thái &nbsp;<i class="fa-solid fa-caret-down"></i></h3>
                                </th>
                                <th>
                                    <h3>Tổng tiền &nbsp;<i class="fa-solid fa-caret-down"></i></h3>
                                </th>
                                <th>
                                    <h3>Ghi chú</h3>
                                </th>
                                <th>
                                    <h3>Quản lí</h3>
                                </th>

                            </tr>
                            <?php foreach ($records as $record) {?>


                            <tr>
                                <td>
                                    <p><?= $record['id'] ?></p>
                                </td>
                                <td style="width: 150px;">
                                    <p><?= $record['time_order'] ?></p>
                                </td>
                                <td>
                                    <p><?= $record['recipent_name'] ?></p>
                                   
                                    <p><?= $record['recipent_address'] ?></p>
                              
                                    <p><?= $record['recipent_phone'] ?></p>
                                </td>
                                <td>
                                    <p><?= $record['customer_name'] ?></p>
                                    <p><?= $record['customer_address'] ?></p>
                                    <p><?= $record['customer_phone'] ?></p>
                                </td>
                                <td style="width: 110px; ">
                                    <?php $satuss = $record['status'];
                                 
                                    switch ($satuss){
                                        case 0:echo '<p class="status1">Chờ duyệt</p>'; 
                                        break;
                                        case 1: echo '<p class="status2">Đã duyệt</p>'; 
                                        break;
                                        case 2: echo '<p class="status3">Đã Hủy</p>'; 
                                        break;
                                    }
                                    ?>
                                </td>
                                <td>
                                <p><?php echo number_format($record['total_cost'], 0, '', ','); ?> <span class="cost">đ</span></p>
                                </td>
                                <td>
                                    <p><?= $record['note'] ?></p>
                                </td>
                                <td class="table-manager">
                                    <div class="table-button2">
                                    <?php  if( $record['status']==0){
                                        require_once '../root/buttonD.php';
                                        require_once '../root/buttonU.php';
                                    } ?>
                        
                                        <div class="btn-detail">

                                            <a href="./productdetail.php?id=<?= $post['id'] ?>"><button> <i class="fa-solid fa-ellipsis"></i>&nbsp; Chi tiết</button> </a>
                                        </div>

                                    </div>
                                </td>
                            </tr>
<?php }?>
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
                    }
                });
            }
        })
    });
</script>

</html>