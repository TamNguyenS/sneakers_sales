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
$statusorder = isset($_GET['status']) ? $_GET['status'] : '';
$statusorder = validate($statusorder);
$search = validate($search);
$status_order_query = '';

//page 
$page = empty($_GET['page']) ? 1 : $_GET['page'];
if (!is_numeric($page)) die();

$page_limit = 6;
$page_total_length = get_count('SELECT count(*) FROM orders WHERE recipent_name LIKE \'%' . $search . '%\'');
$page_length = ceil($page_total_length / $page_limit);
$page_skip =  $page_limit * ($page - 1);

$query = "SELECT orders.* , customer.name as customer_name, 
customer.phone as customer_phone, customer.address as customer_address 
FROM orders LEFT JOIN customer ON orders.recipient_id = customer.id
WHERE (recipent_name LIKE '%$search%')   ORDER BY id DESC LIMIT  $page_limit OFFSET $page_skip";
// echo $query;
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
    <script src="../lib/icon.js" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="../lib/icon.css"> -->
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/font-awesome-line-awesome/css/all.min.css">
    <!-- <link rel="stylesheet" href="../lib/loader/style.css?v=2"> -->
    <style>
        .loader {
            border: 6px solid #f3f3f3;
            border-radius: 50%;
            border-top: 6px solid #3498db;
            width: 60px;
            height: 60px;
            -webkit-animation: spin 2s linear infinite;
            /* Safari */
            animation: spin 2s linear infinite;
            margin-left: 600px;
          
        }

        /* Safari */
        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
       
       main{
           height: auto;
       }
      
    </style>
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

                            <a href="./orderadd.php"><button class="btn btn1" id="button"><span class="fas fa-plus-circle"></span>&nbsp;Tạo đơn mới</button> </a>
                        </div>
                        <div class="btn-out">

                            <button> <span class="fa-solid fa-file-excel"></span> &nbsp; Xuất file Excel</button>
                        </div>
                        <form action=" " name="test">
                            <div class="fillter">
                                <i class="fa-solid fa-arrow-down-a-z"></i>&nbsp;
                                <input type="date" class="fillter-orders inputdate" name="datesorder" id="datesorder"></input>

                                <i class="fa-solid fa-arrow-down-short-wide"></i>&nbsp;

                                <select class="fillter-orders" name="statusorder" id="statusorder">

                                    <option disabled selected value="">Loại đơn </option>
                                    <option value="2">Đơn hủy</option>
                                    <option value="1">Đơn duyệt</option>
                                    <option value="0">Chờ duyệt</option>

                                </select>

                                <!-- <input type="submit" class=""></input> -->
                            </div>
                        </form>
                    </div>

                    <div class="container-table">
                        <table border="1px">
                            <thead>
                                <tr>
                                    <th>
                                        <h3>ID </h3>
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
                                <tr class="loader-add" >
                                <!-- <td colspan="8" style="text-align: center; " > <div class="loader" ></div> </td> -->
                                </tr>
                                <?php foreach ($records as $record) { ?>

                                    <tr class="remove">
                                        <td>
                                            <p><span style="color: rgb(250, 35, 189); font-weight:bold">#</span><?= encodeID($record['id']) ?></p>
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

                                            switch ($satuss) {
                                                case 0:
                                                    echo '<p class="status1">Chờ duyệt</p>';
                                                    break;
                                                case 1:
                                                    echo '<p class="status2">Đã duyệt</p>';
                                                    break;
                                                case 2:
                                                    echo '<p class="status3">Đã Hủy</p>';
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
                                        <td class="table-manager" style="width: 90px; ">
                                            <div class="table-button2">
                                                <?php if ($record['status'] == 0) {
                                                    require '../root/buttonD.php';
                                                    require '../root/buttonU.php';
                                                } ?>

                                                <div class="btn-detail">
                                                    <a href="./orderdetail.php?id=<?= $record['id'] ?>"> <i class="fa-solid fa-arrow-up-right-from-square icon-detail"></i></a>
                                                    <!-- <a href="./productdetail.php?id=<?= $post['id'] ?>"><button> <i class="fa-solid fa-ellipsis"></i>&nbsp; Chi tiết</button> </a> -->
                                                </div>

                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </thead>
                        </table>



                        <br>
                        <div class="page remove">
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
        $('#statusorder').change(function() {
            var value = $(this).val();
            // alert(value);
            $ajax = $.ajax({
                url: './ordersort.php',
                type: 'POST',
                data: 'status=' + value,
                beforeSend: function() {
                    $('.remove').remove();
                    $('.loader-add').html('<td colspan="8" style="text-align: center"> <div class="loader" ></div> </td>');
                    
                },
                success: function(data) {
                    $('.container-table').html(data);
                }
            })

        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#statusorder').change(function() {
            var value = $(this).val();
            // alert(value);
            $ajax = $.ajax({
                url: './ordersort.php',
                type: 'POST',
                data: 'status=' + value,
                beforeSend: function() {
                    $('.remove').remove();
                    $('.loader-add').html('<td colspan="8" style="text-align: center"> <div class="loader" ></div> </td>');
                    
                },
                success: function(data) {
                    $('.container-table').html(data);
                }
            })

        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#datesorder').change(function() {
            var value = $(this).val();
            // alert(value);
            $ajax = $.ajax({
                url: './ordersort.php',
                type: 'POST',
                data: 'date=' + value,
                beforeSend: function() {
                    $('.remove').remove();
                    $('.loader-add').html('<td colspan="8" style="text-align: center"> <div class="loader" ></div> </td>');
                    
                },
                success: function(data) {
                    $('.container-table').html(data);
                }
            })

        });
    });
</script>
</html>