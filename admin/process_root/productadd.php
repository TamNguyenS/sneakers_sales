<?php
require_once '../db.php';
require_once '../func.php';
?>
<?php
try {
    $name = isset($_POST['name']) ? $_POST['name'] : false;
    // $image = isset($_FILES['image-product']) ? $_FILES['image-product'] : false;
    $description = isset($_POST['description']) ? $_POST['description'] : false;
    $cost = isset($_POST['cost']) ? $_POST['cost'] : false;
    $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : false;
    $manufacture_id = isset($_POST['manufacture']) ? $_POST['manufacture'] : false;
    $type_id = isset($_POST['type']) ? $_POST['type'] : false;
    $date = isset($_POST['date']) ? $_POST['date'] : false;
    $token = isset($_POST['token']) ? $_POST['token'] : false;
    $upload = false;
    $isSumit = false;
    $isError = false;
    $error = '';
    $msg = '';
    $fileNames = array_filter($_FILES['files']['name']); 
   
   
   
    if (
        $name !== false
        && $description !== false
        && $cost !== false
        && $quantity !== false
        && $manufacture_id  !== false
        && $type_id  !== false
        && $date  !== false
    ) {
        $isSubmit = true;
        if (!$isError) {
            $result = insert('product', array(
                'name' => $name,
                'quantity' => $quantity,
                'description' => $description,
                'cost' => $cost,
                'manufacture_id' => $manufacture_id,
                'type_id'  => $type_id,
                'date' => $date,
                'token' => $token
            ));
        
            $query = "SELECT id FROM product WHERE token = '$token'";
            $result_product = get_list($query);
            //take id of product
            $product_id =  $result_product[0]['id'];
            for($i = 0 ; count($fileNames) > $i ; $i++){
               
               $file_extension = pathinfo($fileNames[$i], PATHINFO_EXTENSION);
                if($file_extension =='webp'){
                    $file_extension= 'png';
                }
               $folder = '../photos/';
              if($file_extension != 'jpg' && $file_extension != 'png' && $file_extension != 'jpeg' && $file_extension != 'gif'){
                  echo 1;
                  echo 'Bạn bỏ cái file gì lên đây vậy :V';
                  die();
              }
              
              $file_name = random_int(0,100).floor(microtime(true) * 1000).$i;
              $file_name_extension = $file_name.'.'.$file_extension;
              $path_file =  $folder.$file_name_extension;
              move_uploaded_file($_FILES["files"]["tmp_name"][$i], $path_file);

                $result_img = insert('product_img', array(
                    'product_id' =>   $product_id, 
                    'img' =>  $file_name_extension
                ));

            }
        }
    } else {
        echo 'Khum có gì ở đây cả';
    }
    echo 1;
} catch (Throwable $e) {
    echo 0;
    echo $e->getMessage();
}
?>