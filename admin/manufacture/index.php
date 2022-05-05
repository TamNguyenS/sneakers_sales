<?php
require '../root/checklogin.php';
?>
<?php

$isSubmit = false;
$error = '';
$msg = '';
$isError = false;
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
$page_total_length = get_count('SELECT count(*) FROM manufacture WHERE NAME LIKE \'%' . $search . '%\'');
$page_length = ceil($page_total_length / $page_limit);
$page_skip =  $page_limit * ($page - 1);

$query = "SELECT * FROM manufacture WHERE NAME LIKE '%$search%' LIMIT  $page_limit OFFSET $page_skip";
$records = get_list($query);

?>
<?php
$delete = empty($_GET['delete']) ? 'false' : $_GET['delete'];
if ($delete !== false) {
    // $id = $_GET['delete'];
    $result = remove('manufacture', $delete);

    if ($result) {
        $msg = 'Xóa thành công';
        // header('Location: ./index.php');
        // die();
    } else {
        $msg = 'Xóa Không thành công ';
    }
}
?>

<!DOCTYPE html>
<html>
</div>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - manufacture</title>
    <link rel="stylesheet" href="../css/cssdb.css?v=2">
    <link rel="stylesheet" href="../css/cssmf.css?v=2">
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
                    <h2> Nhà cung cấp</h2>
                </div>

            </div>

            <main>
                <div class="cards"  style="margin-top:-5px; margin-bottom: 10px;  margin-left: 200px;  grid-template-columns: repeat(3, 1fr);">
               
                    <div class="card-single" >
                        <div>
                            <h1> 15</h1>
                            <span>Số nhà cung cấp hiện tại</span>
                        </div>
                        <div class="card-icon" style="background-color: rgb(252, 242, 210);">
                            <span class="fa-solid fa-industry" style="color: rgb(248, 225, 52)"></span>
                        </div>
                    </div>

                    <div class="card-single" >
                        <div>
                            <h1> 13</h1>
                            <span>Số nhà cung cấp mới trong năm nay</span>
                        </div>
                        <div class="card-icon" style="  background-color: rgb(221, 230, 254);">
                            <span class="fa-regular fa-chart-bar" style=" color: rgb(30, 90, 255);"></span>
                        </div>
                    </div>
                    <!-- <div class="card-single">
                        <div>
                            <h1> 13</h1>
                            <span>Số sản phẩm bán được trong tháng</span>
                        </div>
                        <div class="card-icon" style="background-color: rgb(249, 219, 237);">
                            <span class="fa-solid fa-chart-bar" style="color: rgb(252, 64, 176);"></span>
                        </div>
                    </div> -->

                </div>
                <div class="table-content">
                    <!-- <php echo $msg ?> -->
                    <div class="table-button">
                        <div class="btn-add">

                            <a href="./manufactureadd.php"><button class="btn btn1" id="button"><span class="fas fa-plus-circle"></span> Thêm nhà cung cấp</button> </a>
                        </div>
                        <div class="btn-out">

                            <button> <span class="fa-solid fa-file-excel"></span> &nbsp; Xuất file Excel</button>
                        </div>

                    </div>

                    <table border="1px">
                        <thead>
                            <tr>
                                <th>
                                    <h3>ID</h3>
                                </th>
                                <th>
                                    <h3>Tên nhà cung cấp</h3>
                                </th>
                                <th>
                                    <h3>Xuất xứ</h3>
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
                                        <p><span style="color: rgb(250, 35, 189); font-weight:bold">#</span><?php echo $post['id'] ?></p>
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
                                                <button class="btn-delete-real" data-name=" <?= $post['name'] ?>" data-id="<?= $post['id'] ?>"> <span class="fa-solid fa-eraser"></span> Xóa</button> </a>
                                            </div>

                                            <div class="btn-update">

                                                <a href="./manufactureupdate.php?id=<?= $post['id'] ?>"><button> <span class="fa-regular fa-pen-to-square"></span> &nbsp; Sửa</button> </a>
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
                                <?php for ($i = 1; $i <= $page_length; $i++) {
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
            </main>

        </div>
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