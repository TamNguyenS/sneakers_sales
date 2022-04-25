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
            <!-- <php include '../root/header.php' ?> -->
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
                            <span class="fa-regular fa-chart-bar" style=" color: rgb(30, 90, 255);"></span>
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
                        <div class="card-icon" style="background-color: rgb(249, 219, 237);">
                            <span class="fa-solid fa-chart-bar" style="color: rgb(252, 64, 176);"></span>
                        </div>
                    </div>

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
                                    <h3>Thời gian đặt</h3>
                                </th>
                                <th>
                                    <h3>Thông tin người nhận</h3>
                                </th>
                                <th>
                                    <h3>Thông tin người đặt</h3>
                                </th>
                                <th>
                                    <h3>Trạng thái</h3>
                                </th>
                                <!-- <th>
                                    <h3>Tổng tiền</h3>
                                </th> -->
                                <th>
                                    <h3>Ghi chú</h3>
                                </th>
                                <th>
                                    <h3>Quản lí</h3>
                                </th>

                            </tr>

                            <tr>
                                <td>
                                    <p></p>
                                </td>
                                <td>
                                    <p></p>
                                </td>
                                <td>
                                    <p></p>
                                </td>
                                <td>
                                    <p></p>
                                </td>
                                <td>
                                    <p></p>
                                </td>
                                <!-- <td>
                                    <p></p>
                                </td> -->
                                <td>
                                    <p></p>
                                </td>
                                <td class="table-manager">
                                    <div class="table-button2">

                                        <div class="btn-delete">

                                            <button class="btn-delete-real" data-name=" <?= $post['name'] ?>" data-id="<?= $post['id'] ?>"> <i class="fa-solid fa-xmark"></i>&nbsp; &nbsp;Hủy </button>
                                        </div>
                                        <div class="btn-update">

                                            <a href="./productupdate.php?id=<?php echo $post['id'] ?>"><button> <i class="fa-solid fa-check"></i>&nbsp;  Duyệt</button> </a>
                                        </div>

                                        <div class="btn-detail">

                                            <a href="./productdetail.php?id=<?php echo $post['id'] ?>"><button> <i class="fa-solid fa-ellipsis"></i>&nbsp; Chi tiết</button> </a>
                                        </div>

                                    </div>
                                </td>
                            </tr>

                        </thead>
                    </table>
                    <br>
                    <div class="page">
                        <nav class="pagination-outer" aria-label="Page navigation">
                            <ul class="pagination">

                                <li class="page-item active"><a class="page-link" href="#"></a></li>

                                <li class="page-item"><a class="page-link" href="./?&search="> </a></li>

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