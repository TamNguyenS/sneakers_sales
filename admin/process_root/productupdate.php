
<?php
require_once '../db.php';
require_once '../func.php';
?>

<?php
try {

    $id = $_POST['id'];
    $query = "SELECT product.* , 
        manufacture.name AS manufacture_name,
        type.name AS type_name FROM product 
        INNER JOIN manufacture ON product.manufacture_id = manufacture.id
        INNER JOIN type ON product.type_id = type.id
        WHERE product.id = '$id'";
    $product_info = get_list($query);
    foreach ($product_info as $value) {
        $manufacture_id_selected = $value['manufacture_id'];
        $type_id_selected = $value['type_id'];
    }
    $name = isset($_POST['name']) ? $_POST['name'] : false;
    $description = isset($_POST['description']) ? $_POST['description'] : false;
    $cost = isset($_POST['cost']) ? $_POST['cost'] : false;
    $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : false;
    $manufacture_id = isset($_POST['manufacture']) ? $_POST['manufacture'] : false;
    $type_id = isset($_POST['type']) ? $_POST['type'] : false;
    $upload = false;
    $isSumit = false;
    $isError = false;

    $fileNames = array_filter($_FILES['files']['name']);
    if (
        $name !== false
        && $description !== false
        && $cost !== false
        && $quantity !== false
        && $manufacture_id  !== false
        && $type_id  !== false
    ) {
        $isSubmit = true;
        //have img file
        if (count($fileNames) > 0) {
            $remove_chill = remove1('product_img', $id);

            for ($i = 0; count($fileNames) > $i; $i++) {

                $file_extension = pathinfo($fileNames[$i], PATHINFO_EXTENSION);

                $folder = '../photos/';
                if ($file_extension != 'jpg' && $file_extension != 'png' && $file_extension != 'jpeg' && $file_extension != 'gif') {
                    echo 1;
                    echo 'Bạn bỏ cái file gì lên đây vậy :V';
                    die();
                }

                $file_name = random_int(0, 100) . floor(microtime(true) * 1000) . $i;
                $file_name_extension = $file_name . '.' . $file_extension;
                $path_file =  $folder . $file_name_extension;
                move_uploaded_file($_FILES["files"]["tmp_name"][$i], $path_file);

                $result_img = insert('product_img', array(
                    'product_id' =>   $id,
                    'img' =>  $file_name_extension
                ));
                $result = update('product', array(
                    'name' => $name,
                    'quantity' => $quantity,
                    'description' => $description,
                    'cost' => $cost,
                    'manufacture_id' => $manufacture_id,
                    'type_id'  => $type_id,
                ), "id =$id");
            }
        } else {
            $result = update('product', array(
                'name' => $name,
                'quantity' => $quantity,
                'description' => $description,
                'cost' => $cost,
                'manufacture_id' => $manufacture_id,
                'type_id'  => $type_id,
            ), "id =$id");
        }
    }
    echo 1;
} catch (throwable $e) {
    echo $e->getMessage();
}
?>