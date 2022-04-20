
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
// print_r($product_info); 
?>
<?php
foreach ($product_info as $value) {
    $image_old = $value['image'];
    $manufacture_id_selected = $value['manufacture_id'];
    $type_id_selected = $value['type_id'];
}
$name = isset($_POST['name']) ? $_POST['name'] : false;

// $image_new = isset($_FILES['image-new']) ?  $_FILES['image-new']  : false ;

$description = isset($_POST['description']) ? $_POST['description'] : false;
$cost = isset($_POST['cost']) ? $_POST['cost'] : false;
$quantity = isset($_POST['quantity']) ? $_POST['quantity'] : false;
$manufacture_id = isset($_POST['manufacture']) ? $_POST['manufacture'] : false;
$type_id = isset($_POST['type']) ? $_POST['type'] : false;

$upload = false;
$isSumit = false;
$isError = false;
$error = '';
$msg = '';
$file_name = '';


if(isset($_FILES["image-new"])){
    $product_image = $_FILES["image-new"];
    // print_r($product_image);
    // die();
    if(strlen($product_image['tmp_name']) != 0 ){
        $folder = '../photos/';
        $file_extension = explode('.',$product_image['name'])[1];
        $file_name =  time() . '.' . $file_extension;
        $path_file = $folder . $file_name;
        move_uploaded_file($product_image['tmp_name'], $path_file);
    }else{
        $file_name =  $image_old;
    }
    
}


if (
    $name !== false
    && $description !== false
    && $cost !== false
    && $quantity !== false
    && $manufacture_id  !== false
    && $type_id  !== false
) {
    $isSubmit = true;

    //validate!!
    if (!$isError) {
        $result = update('product', array(
            'name' => $name,
            'image' => $file_name ,
            'quantity' => $quantity,
            'description' => $description,
            'cost' => $cost,
            'manufacture_id' => $manufacture_id,
            'type_id'  => $type_id,

        ), "id =$id");
        if ($result) {
            $msg = 'Chúc mừng bạn đã sửa thành công !<br>';
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
                        <h2> <span class="fa fa-arrow-circle-left"></span> Sửa sản phẩm</h2>
                        <br>

                    </a>
                </div>

            </div>
            <div class="container-content">
                <h1> <?php echo $msg ?> </h1>
                <h1> <?php echo $error ?></h1>
                <div class="form-content">
                    <p><?php  ?></p>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <?php foreach ($product_info as $post) { ?>
                            <p>Nhập tên sản phẩm </p>
                            <input type="text" name="name" placeholder="Nhập tên nhà sản xuất" value="<?php echo $post['name'] ?>">
                            <p>Hình ảnh sản phẩm</p>
                            <div id="image-product-upload">
                                <label for="image-product" id="image-upload"> <i class="fas fa-upload"></i>Tải ảnh lên </label>
                                <input type="file" name="image-new" accept="image/png, image/jpeg, image/jpg" id="image-product" hidden>
                            </div>
                            <p>Hình ảnh củ </p>
                            <img src="../photos/<?php echo  $image_old ?> " alt="anh" style="width: 350px ; wight: 350px; border: 2px solid #ff3010; boder-radius: 100px ">

                            <br>
                            <p>Giá bán </p>
                            <input type="text" name="cost" placeholder="" value="<?php echo $post['cost'] ?>">
                            <p>Số lượng </p>
                            <input type="int" name="quantity" placeholder="Nhập số lượng" value="<?php echo $post['quantity'] ?>">
                            <p> Loại sản phẩm</p>

                            <select name="type" id="type">
                                <?php foreach ($type_list as $post1) { ?>
                                    <option value="<?php echo $post1['id'] ?>" <?php if ($type_id_selected == $post1['id']) { ?> selected <?php } ?>> <?php echo $post1['name'] ?> </h1>
                                    <?php } ?>
                            </select>
                            <p> Nhà sản xuất</p>
                            <select name="manufacture" id="manufacture">
                                <?php foreach ($manufacture_list as $post2) { ?>

                                    <option value="<?php echo $post2['id'] ?>" <?php if ($manufacture_id_selected  == $post2['id']) { ?> selected <?php } ?>><?php echo $post2['name'] ?> </option>
                                <?php } ?>
                            </select>
                            <p>Ngày thêm</p>
                            <input type="date" name="date" id="datePicker"  value="<?php echo $post['date'] ?>" readonly>
                            <p>Mô tả</p>
                            <textarea name="description" id="" cols="170" rows="10"> <?php echo $post['description'] ?></textarea>
                          
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
                        <?php } ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>