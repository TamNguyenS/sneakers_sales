<?php
require_once '../db.php';
require_once '../func.php';
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add</title>
    <link rel="stylesheet" href="../css/detail.css">
    <link rel="stylesheet" href="../css/cssdb.css">
    <link rel="stylesheet" href="../css/cssmf.css">

    <script src="../js/uploadFile.js"></script>
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
                    <a href="./index.php">
                        <h2> <span class="fa fa-arrow-circle-left"></span> Xem chi tiết sản phẩm</h2><br>
                    </a>
                </div>
            </div>

            <div class="container-content">
                <!-- containner connetent -->

                <div class="table-button-detail">
                    <div class="btn-out">
                        <a> <button> <span class="fa-solid fa-file-excel"></span> &nbsp; Excel</button> </a>
                    </div>
                    <div class="btn-addd">
                        <a href="./productadd.php"><button><span class="fa-regular fa-pen-to-square"></span> Sửa</button> </a>
                    </div>
                    <div class="btn-delete">
                        <a href="./productadd.php"><button><span class="fa-solid fa-eraser"></span> Xóa</button> </a>
                    </div>
                </div>
                <div class="product-detail">
                    <div class="product-title">
                        <h1>Sản phẩm :<h1>
                                <div class="detail-img">
                                    <img src="../photos/1650042430.png" alt="">
                                </div>

                    </div>
                    <div class="product-content">
                    
                        <div class="table-detail">
                            <table>
                                <tr>
                                    <th>Tên sản phẩm</th>
                                    <td>sadasdasd </td>
                                </tr>

                                <tr>
                                    <th>Đã bán</th>
                                    <td>sadasdasd </td>
                                </tr>

                                <tr>
                                    <th>Số lượng hiện có</th>
                                    <td>sadasdasd </td>
                                </tr>
                                <tr>
                                    <th>Nhà sản xuất</th>
                                    <td>sadasdasd </td>
                                </tr>
                                <tr>
                                    <th>Loại sản phẩm</th>
                                    <td>sadasdasd </td>
                                </tr>
                                <tr>
                                    <th>Xuất sứ</th>
                                    <td>sadasdasd </td>
                                </tr>
                                <tr>
                                    <th>Ngày thêm</th>
                                    <td>sadasdasd </td>
                                </tr>
                                <tr>
                                    <th>Mô tả</th>
                                    <td><textarea readonly>sadasdsad</textarea></td>
                                </tr>
                            </table>
                        </div>

                    </div>


                </div>

            </div>
        </div>

    </div>
</body>

</html>