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

<?php
$name = isset($_POST['name']) ? $_POST['name'] : false;
$image = isset($_FILES['image-product']) ? $_FILES['image-product'] : false;
$description = isset($_POST['description']) ? $_POST['description'] : false;
$cost = isset($_POST['cost']) ? $_POST['cost'] : false;
$quantity = isset($_POST['quantity']) ? $_POST['quantity'] : false;
$manufacture_id = isset($_POST['manufacture']) ? $_POST['manufacture'] : false;
$type_id = isset($_POST['type']) ? $_POST['type'] : false;
$date = isset($_POST['date']) ? $_POST['date'] : false;
$upload = false;
$isSumit = false;
$isError = false;
$error = '';
$msg = '';

if (
    $name !== false
    && $image !== false
    && $description !== false
    && $cost !== false
    && $quantity !== false
    && $manufacture_id  !== false
    && $type_id  !== false
    && $date  !== false
) {
    $isSubmit = true;
    //validate image
    $folder = '../photos/';
    $imageFileType = explode('.', $image['name'])[1];
    if ($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg' && $imageFileType != 'gif') {
        echo "Cái lày không phải file ảnh ";
        $upload = true;
        $isError = true;
    }
    if (!$upload) {
        $file_extension = time() . '.' . $imageFileType;
        $path_file = $folder . $file_extension;
        move_uploaded_file($image['tmp_name'], $path_file);
    }
    //validate de khi khác :V


    if (!$isError) {
        $result = insert('product', array(
            'name' => $name,
            'image' => $file_extension,
            'quantity' => $quantity,
            'description' => $description,
            'cost' => $cost,
            'manufacture_id' => $manufacture_id,
            'type_id'  => $type_id,
            'date' => $date

        ));
        if ($result) {
            $msg = 'Chúc mừng bạn đã thêm thành công !<br>';
        } else {
            $error = 'Có lỗi xảy ra, vui lòng thử lại sau!<br>';
        }
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
    <title>Add</title>
    <link rel="stylesheet" href="../css/cssdb.css">
    <link rel="stylesheet" href="../css/cssmf.css">
   
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
                    <p><?php  ?></p>
                    <form action="" method="POST" enctype="multipart/form-data">

                        <p>Nhập tên sản phẩm </p>
                        <input type="text" name="name" placeholder="Nhập tên sản phẩm">
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
                        <input type="text" name="cost" placeholder="">
                        <p>Số lượng </p>
                        <input type="int" name="quantity" placeholder="Nhập số lượng">
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
                        <textarea name="description" id="" cols="170" rows="10"></textarea>
                        <div class="table-button">
                            <div class="btn-ok">
                                <button> OK </button>
                                <p>
                                    <?php echo $msg ?>
                                </p>
                                <p>
                                    <?php echo $error ?>
                                </p>
                            </div>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript">
    document.getElementById('datePicker').valueAsDate = new Date();
</script>
<script src="../js/previewImg.js"></script>
</html>