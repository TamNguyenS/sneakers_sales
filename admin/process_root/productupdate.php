
<?php
require_once '../db.php';
require_once '../func.php';
?>

<?php
try{

        $id = $_POST['id'];
        $query = "SELECT product.* , 
        manufacture.name AS manufacture_name,
        type.name AS type_name FROM product 
        INNER JOIN manufacture ON product.manufacture_id = manufacture.id
        INNER JOIN type ON product.type_id = type.id
        WHERE product.id = '$id'";
        $product_info = get_list($query);
        // print_r($product_info); 


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
        if (isset($_FILES["image-new"])) {
            $product_image = $_FILES["image-new"];
            // print_r($product_image);
            // die();
            if (strlen($product_image['tmp_name']) != 0) {
                $folder = '../photos/';
                $file_extension = explode('.', $product_image['name'])[1];
                $file_name =  time() . '.' . $file_extension;
                $path_file = $folder . $file_name;
                move_uploaded_file($product_image['tmp_name'], $path_file);
            } else {
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
                    'image' => $file_name,
                    'quantity' => $quantity,
                    'description' => $description,
                    'cost' => $cost,
                    'manufacture_id' => $manufacture_id,
                    'type_id'  => $type_id,

                ), "id =$id");
                if ($result) {

                } else {
                }
            }
        }
        echo 1;
    }
    catch(throwable $e) {
        echo $e->getMessage();
    }
?>