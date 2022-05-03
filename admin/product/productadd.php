<?php
require '../root/checklogin.php';
?>

<?php
require_once '../db.php';
require_once '../func.php';
?>

<?php
$query = 'SELECT id, name FROM manufacture';
$manufacture_list = get_list($query);
// print_r($manufacture_list );
?>

<?php
$query = 'SELECT id, name FROM type';
$type_list = get_list($query);
// print_r($type_list );
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
    <!-- icon -->
    <script src="https://kit.fontawesome.com/945e1fd97f.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/font-awesome-line-awesome/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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

                <div id="toast">

                </div>

                <script src="../js/toast.js"></script>



                <div class="form-content">
                    <p><?php  ?></p>
                    <form action="" method="POST" enctype="multipart/form-data" id="uploadFrom">

                        <p>Nhập tên sản phẩm </p>
                        <input type="text" name="name" placeholder="Nhập tên sản phẩm" required>
                        <p>Hình ảnh sản phẩm</p>

                        <div id="image-product-upload">

                            <label for="image-product"> <i class="fas fa-upload"></i>Tải ảnh lên </label>
                            <input type="file" name="image-product" accept="image/png, image/jpeg, image/jpg" id="image-product" hidden>
                        </div>
                        <div class="img-preview">
                            <img id="img-preview" src=" " />
                        </div>

                        <br>
                        <p>Giá bán </p>
                        <input type="text" name="cost" placeholder="" required>
                        <p>Số lượng </p>
                        <input type="int" name="quantity" placeholder="Nhập số lượng" required>
                        <p> Loại sản phẩm</p>
                        <select name="type" id="type" class="select-1">
                            <?php foreach ($type_list as $post) { ?>
                                <option value="<?php echo $post['id'] ?>"> <?php echo $post['name'] ?> </h1>
                                <?php } ?>
                        </select>
                        <p> Nhà sản xuất</p>
                        <select name="manufacture" id="manufacture" class="select-1">
                            <?php foreach ($manufacture_list as $post) { ?>
                                <option value="<?php echo $post['id'] ?>"> <?php echo $post['name'] ?> </option>
                            <?php } ?>
                        </select>
                        <p>Ngày thêm</p>
                        <input type="date" name="date" id="datePicker" required readonly>
                        <p>Mô tả</p>
                        <textarea name="description" cols="170" rows="10" id="txarea"></textarea>

                        <div class="table-button">
                            <div class="btn-ok">
                                <button type="submit" id="btn-update"> OK </button>
                            </div>
                    </form>
                </div>


            </div>
        </div>
    </div>
    </div>
</body>
<script type="text/javascript">
    document.getElementById('datePicker').valueAsDate = new Date();
</script>
<script src="../js/previewImg.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#uploadFrom").on('submit', (function(e) {
            e.preventDefault();
            var submit = 0;
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
            if (image == null) {
                // var submit = new Boolean(false);
                showErrorToast("VCL", " Có cái ảnh mà cũng thiếu đm");
                submit += 1;
            }
            if (quantity / quantity !== 1) {
                // var submit = new Boolean(false);
                showErrorToast("Nhập ngu vl thế", " Kiểm tra chổ SỐ LƯỢNG kìa bạn ơi!");
                submit += 1;
            }
            if (name == null || type == null || manufacture == null || date == null || description == null) {
                // var submit = new Boolean(false);
                showErrorToast("Thất bại!", "Đã có lỗi xảy ra ⊙﹏⊙∥");
                submit += 1;
            }
            if (submit === 0) {
                $.ajax({
                    url: "../process_root/productadd.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    // success: function(response) {
                    //     $('#uploadFrom').find('input').val('');
                    //     $('#uploadFrom').find('textarea').val('');
                    //     showSuccessToast("Thành công", "Thêm thành công sản phẩm!")
                    // },
                }).done(function(data) {
                    if (data == 1) {
                        $('#uploadFrom').find('input').val('');
                        $('#uploadFrom').find('textarea').val('');
                        showSuccessToast("Thành công", "Thêm thành công sản phẩm!")
                    }
                    else if (data == 0) {
                        showErrorToast("Thất bại", "Đã có lỗi xãy ra zui lòng kiểm tra lại ⊙﹏⊙∥!")
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