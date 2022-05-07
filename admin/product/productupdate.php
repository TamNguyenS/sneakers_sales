<?php
require '../root/checklogin.php';
?>
<?php
require_once '../db.php';
require_once '../func.php';
?>
<?php
$query_m = 'SELECT id, name FROM manufacture';
$manufacture_list = get_list($query_m);
// print_r($manufacture_list );
?>

<?php
$query_t = 'SELECT id, name FROM type';
$type_list = get_list($query_t);
// print_r($type_list );
?>
<?php

$id = $_GET['id'];
// die($id);
$query = "SELECT product.* , 
manufacture.name AS manufacture_name,
type.name AS type_name FROM product 
INNER JOIN manufacture ON product.manufacture_id = manufacture.id
INNER JOIN type ON product.type_id = type.id
WHERE product.id = '$id'";
$product_info = get_list($query);

$query_img = "SELECT img FROM product_img WHERE product_id = '$id'";
$product_img = get_list($query_img);
// print_r($product_info); 
?>
<?php
foreach ($product_info as $value) {
    $manufacture_id_selected = $value['manufacture_id'];
    $type_id_selected = $value['type_id'];
}
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
    <link rel="stylesheet" href="../css/toast.css?v=2">
    <script src="../js/toast.js"></script>
    <!-- icon -->
    <script src="https://kit.fontawesome.com/945e1fd97f.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/font-awesome-line-awesome/css/all.min.css">
    <style>
        #result {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            padding: 10px 0;
        }

        .thumbnail {
            height: 192px;
        }

        .old-img {
            height: 192px;
            border-radius: 20px;
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
            <div id="toast">
            </div>
            <script src="../js/toast.js"></script>

            <div class="container">
                <div class="tag-name">
                    <a href="./index.php">
                        <h2> <span class="fa fa-arrow-circle-left"></span> Sửa sản phẩm</h2>
                        <br>
                    </a>
                </div>
            </div>
            <div class="container-content">
                <div class="form-content">

                    <p><?php  ?></p>
                    <form action="" method="POST" enctype="multipart/form-data" id="uploadFrom">
                        <input value="<?= $id ?>" hidden name="id">
                        <?php foreach ($product_info as $post) { ?>
                            <p>Tên sản phẩm </p>
                            <input type="text" name="name" placeholder="Nhập tên nhà sản xuất" value="<?php echo $post['name'] ?>">
                            <p>Hình ảnh sản phẩm</p>
                            <div id="image-product-upload">
                                <label for="image-product"> <i class="fas fa-upload"></i>Tải ảnh lên </label>
                                <input type="file" name="files[]" multiple="multiple" multiple accept="image/jpeg, image/png, image/jpg" id="image-product" hidden>
                            </div>
                            <output id="result"></output>

                            <p>Hình ảnh củ </p>

                            <div class="img-preview old">
                                <?php foreach ($product_img as $img) { ?>
                                    <img src="../photos/<?php echo $img['img'] ?>" alt="" class="old-img">
                                <?php } ?>
                            </div>


                            <br>
                            <p>Giá bán </p>
                            <input type="text" name="cost" placeholder="" value="<?php echo $post['cost'] ?>">
                            <p>Số lượng </p>
                            <input type="int" name="quantity" placeholder="Nhập số lượng" value="<?php echo $post['quantity'] ?>">
                            <p> Loại sản phẩm</p>

                            <select name="type" id="type" class="select-1">
                                <?php foreach ($type_list as $post1) { ?>
                                    <option value="<?php echo $post1['id'] ?>" <?php if ($type_id_selected == $post1['id']) { ?> selected <?php } ?>> <?php echo $post1['name'] ?> </h1>
                                    <?php } ?>
                            </select>
                            <p> Nhà sản xuất</p>
                            <select name="manufacture" id="manufacture" class="select-1">
                                <?php foreach ($manufacture_list as $post2) { ?>

                                    <option value="<?php echo $post2['id'] ?>" <?php if ($manufacture_id_selected  == $post2['id']) { ?> selected <?php } ?>><?php echo $post2['name'] ?> </option>
                                <?php } ?>
                            </select>
                            <p>Ngày thêm</p>
                            <input type="date" name="date" id="datePicker" value="<?php echo $post['date'] ?>" readonly>
                            <p>Mô tả</p>
                            <textarea name="description" id="txarea" cols="170" rows="10"> <?php echo $post['description'] ?></textarea>

                            <div class="table-button">
                                <div class="btn-ok">
                                    <button> OK </button>
                                </div>

                            </div>
                        <?php } ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="../js/previewImg.js"></script>
<script type="text/javascript">
    document.getElementById('datePicker').valueAsDate = new Date();
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#uploadFrom").on('submit', (function(e) {
            e.preventDefault();
            var submit = 0;
            var id = $('input[name="id"]').val();
            var name = $('input[name="name"]').val();
            var image = $('input[name="image-product"]').val();
            var cost = parseInt($('input[name="cost"]').val());
            var quantity = parseInt($('input[name="quantity"]').val());
            var type = $('#type').val();
            var manufacture = $('#manufacture').val();
            var date = $('input[name="date"]').val();
            var description = $('#txarea').val();
            if (cost / cost !== 1) {
                // var submit = new Boolean(false);
                showErrorToast("Nhập ngu vl thế", " Kiểm tra chổ GIÁ BÁN kìa bạn ơi!");
                submit += 1;

            }
            if (quantity / quantity !== 1) {
                // var submit = new Boolean(false);
                showErrorToast("Nhập ngu vl thế", " Kiểm tra chổ SỐ LƯỢNG kìa bạn ơi!");
                submit += 1;
            }
            if (name == null || type == null || manufacture == null || date == null || description == null) {
                // var submit = new Boolean(false);
                showErrorToast("Thất bại!1", "Đã có lỗi xảy ra ⊙﹏⊙∥");
                submit += 1;
            }
            if (submit === 0) {
                $.ajax({
                    url: "../process_root/productupdate.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                }).done(function(data) {
                    if (data == 1) {
                        showSuccessToast("Thành công", "Sửa thành công sản phẩm!");
                    } else {
                        showErrorToast("Thất bại2", "Đã có lỗi xãy ra zui lòng kiểm tra lại ⊙﹏⊙∥!");
                        showErrorToast("Thất bại", data);
                    }

                });
            }

        }));
    });
</script>
<script>
    function showSuccessToast(type, message) {
        toast({
            title: type,
            message: message,
            type: "success",
            duration: 5000
        });
    }

    function showErrorToast(type, message) {
        toast({
            title: type,
            message: message,
            type: "error",
            duration: 5000
        });
    }
</script>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

</html>