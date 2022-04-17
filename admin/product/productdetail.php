<?php
require_once '../db.php';
require_once '../func.php';
?>
<?php


$id = $_GET['id'];
// die($id);
$query = "SELECT product.* , 
manufacture.name AS manufacture_name, manufacture.address AS manufacture_address,
type.name AS type_name FROM product 
INNER JOIN manufacture ON product.manufacture_id = manufacture.id
INNER JOIN type ON product.type_id = type.id
WHERE product.id = '$id'";
$product_info = get_list($query);
// print_r($product_info); 

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
                <?php foreach ($product_info as $product){ ?>
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
                        <h1><?php echo $product['name']; ?><h1>
                                <div class="detail-img">
                                    <img src="../photos/<?php echo $product['image']; ?>" alt="">
                                </div>

                    </div>
                    <div class="product-content">
                    
                        <div class="table-detail">
                            <table>
                               
                                <tr>
                                    <th>Tên sản phẩm</th>
                                    <td><?php echo $product['name']; ?></td>
                                </tr>

                                <tr>
                                    <th>Đã bán</th>
                                    <td><?php echo $product['sold']; ?> </td>
                                </tr>

                                <tr>
                                    <th>Số lượng hiện có</th>
                                    <td><?php echo $product['quantity']; ?> </td>
                                </tr>
                                <tr>
                                    <th>Nhà sản xuất</th>
                                    <td><?php echo $product['manufacture_name']; ?> </td>
                                </tr>
                                <tr>
                                    <th>Loại sản phẩm</th>
                                    <td><?php echo $product['type_name']; ?> </td>
                                </tr>
                                <tr>
                                    <th>Xuất sứ</th>
                                    <td><?php echo $product['manufacture_address']; ?> </td>
                                </tr>
                                <tr>
                                    <th>Ngày thêm</th>
                                    <td><?php echo $product['date']; ?> </td>
                                </tr>
                                <tr>
                                    <th>Mô tả</th>
                                    <td><textarea  rows="10" readonly><?php echo $product['description']; ?></textarea></td>
                                </tr>
                                <?php }?>
                            </table>
                        </div>

                    </div>


                </div>

            </div>
        </div>

    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
    
    </script>

</html>