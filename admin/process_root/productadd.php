<?php
require_once '../db.php';
require_once '../func.php';
?>
<?php
try {
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
            echo 'Khum phải ảnh';
            $upload = true;
            $isError = true;
        }
        if (!$upload) {
            $file_extension = time() . '.' . $imageFileType;
            $path_file = $folder . $file_extension;
            move_uploaded_file($image['tmp_name'], $path_file);
        }
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
        }
    } else {
        echo 'Khum có gì ở đây cả';
    }
    echo 1;
} catch (Throwable $e) {
    echo 0;
}
?>