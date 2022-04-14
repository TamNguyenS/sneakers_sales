<?php
require_once '../db.php';
require_once '../func.php';


?>

<!DOCTYPE html>
<html>
</div>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Product</title>
    <link rel="stylesheet" href="../css/cssdb.css">
    <link rel="stylesheet" href="../css/cssmf.css">
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
                    <h2> Sản phẩm hiện tại </h2>
                </div>

            </div>


            <main>
                <div class="cards" style="margin-top:-5px; margin-bottom: 10px; ">

                    <div class="card-single">
                        <div>
                            <h1> 15</h1>
                            <span>Số sản phẩm hiện tại</span>
                        </div>
                        <div>
                            <span class="fa fa-industry"> </span>
                        </div>
                    </div>

                    <div class="card-single">
                        <div>
                            <h1> 13</h1>
                            <span>Số sản phẩm bán được trong tuần</span>
                        </div>
                        <div>
                            <span class="fa fa-line-chart"> </span>
                        </div>
                    </div>
                    <div class="card-single">
                        <div>
                            <h1> 13</h1>
                            <span>Số sản phẩm bán được trong tháng</span>
                        </div>
                        <div>
                            <span class="fa fa-area-chart"> </span>
                        </div>
                    </div>

                </div>
                <div class="table-content">

                    <div class="table-button">
                        <div class="btn-add">

                            <a href="./productadd.php"><button class="btn btn1" id="button"><span class="fas fa-plus-circle" style="color: rgb(237, 205, 24); "></span> Thêm sản phẩm</button> </a>
                        </div>
                        <div class="btn-out">

                            <button> <span class="fa-solid fa-file-excel" style="color: rgb(14, 172, 40); height: 20px; width: 20px;"></span> &nbsp; Xuất file Excel</button>
                        </div>
                      
                    </div>

                    <table border="1px">
                        <thead>
                            <tr>
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
                                    <h3>Nhà sản xuất</h3>
                                </th>
                                <th>
                                    <h3>Mô tả</h3>
                                </th>

                                <th>
                                    <h3>Quản lí</h3>
                                </th>
                                
                            </tr>


                            <tr>
                                <td class="table-image">
                                    <p></p>
                                </td>
                                <td>
                                    <p< /p>
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

                                </td>
                                <td class="table-manager">
                                    <div class="table-button2">

                                        <div class="btn-delete">
                                            <a onclick="return confirm('Bạn có chắc muốn xóa?')"" > <button >  <span class="fa-solid fa-trash"></span> Xóa</button> </a>
                                        </div>

                                        <div class="btn-update">

                                            <a href=""><button> <span class="fa-solid fa-pen"></span> &nbsp; Sửa</button> </a>
                                        </div>
                                        <div class="btn-detail">

                                            <a href=""><button> <span class="fa-solid fa-eye"></span> &nbsp; Xem chi tiết</button> </a>
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
        </div>


</body>

</html>