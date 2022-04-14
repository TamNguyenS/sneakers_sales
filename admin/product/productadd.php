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
    <title>Add</title>
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
                        <h2> <span class="fa fa-arrow-circle-left"></span> Thêm sản phẩm</h2>
                        <br>

                    </a>
                </div>

            </div>
            <div class="container-content">
                <!-- <h1> <php echo $msg ?> </h1>
                <h1> <php echo $error ?></h1> -->
                <div class="form-content">
                    <form action="" method="POST">

                        <p>Nhập tên sản phẩm </p>
                        <input type="text" name="name" required placeholder="Nhập tên nhà sản xuất">
                        <p>Hình ảnh sản phẩm</p>
                        <div id="image-product-upload">
                            <label for="image-product" id="image-upload"> <i class="fas fa-upload"></i>Tải ảnh lên </label>
                            <input type="file" name="image" required accept="image/png, image/jpeg, image/jpg" id="image-product" hidden>
                        </div>
                        <p>perview hình ảnh đang làm</p>
                        <br>
                        <p>Giá bán </p>
                        <input type="text" name="cost" required placeholder="">
                        <p>Số lượng </p>
                        <input type="int" name="quantity" required placeholder="Nhập số lượng">
                        <p> Nhà sản xuất</p>
                        <select name="manufacture" id="manufacture">
                            <option value="volvo">Volvo</option>
                            <option value="saab">Saab</option>
                            <option value="mercedes">Mercedes</option>
                            <option value="audi">Audi</option>
                        </select>
                        <p>Mô tả</p>
                        <textarea name="description" id="" cols="170" rows="10"></textarea>

                        <div class="table-button">
                            <div class="btn-ok">
                                <button> OK </button>
                                <p>
                                    <php echo $msg ?>
                                </p>
                                <p>
                                    <php echo $error ?>
                                </p>
                            </div>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>