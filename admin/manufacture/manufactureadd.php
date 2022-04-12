<?php
$name = isset($_POST['name']) ? $_POST['name'] : false;
//fix sửa địa chỉ thành danh mục nhỏ//
$address = isset($_POST['address']) ? $_POST['name'] : false;
$phone = isset($_POST['phone']) ? $_POST['phone'] : false;
$email = isset($_POST['email']) ? $_POST['email'] : false;
$date = isset($_POST['datee']) ? $_POST['datee'] : false;
$note = isset($_POST['note']) ? $_POST['note'] : false;

$isSubmit = false; //submit
$error = ''; //loi
$msg = ''; //thong bao
$isError = false; //loi
require_once '../db.php';
require_once '../func.php';
if (
    $name !== false
    && $address !== false
    && $phone !== false
    && $email !== false
    && $date !== false
    && $note !== false

) {

    $isSubmit = true;

    // fix validate
    // if (!isName($name)) {
    //     $error .= 'Tên không hợp lệ<br>';
    //     $isError = true;
    // }
    // if (!isPhone($phone)) {
    //     $error .= 'Số điện thoại không hợp lệ<br>';
    //     $isError = true;
    // }
    // if (!isEmail($email)) {
    //     $error .= 'Email không hợp lệ<br>';
    //     $isError = true;
    // }
    // if (isName($address)) {
    //     $error .= 'Địa chỉ không hợp lệ<br>';
    //     $isError = true;
    // }
    if (!$isError) {
        $result = insert('manufacture', array(
            'name' => $name,
            'address' => $address,
            'phone' => $phone,
            'email' => $email,
            'datee' => $date,
            'note' => $note
        ));

        if ($result) {
            $msg = 'Chúc mừng bạn đã thêm thành công !<br>';
        } else {
            $error = 'Có lỗi xảy ra, vui lòng thử lại sau!<br>';
        }
    }
}

?>
<?php

// require_once '../db.php';
// require_once '../func.php';

$search = empty($_GET['search']) ? '' : $_GET['search'];
$search = validate($search);

//page 
$page = empty($_GET['page']) ? 1 : $_GET['page'];
if (!is_numeric($page)) die();

$page_limit = 6;
$page_total_length = get_count('SELECT count(*) FROM manufacture WHERE NAME LIKE \'%' . $search . '%\'');
$page_length = ceil($page_total_length / $page_limit);
$page_skip =  $page_limit * ($page - 1);

$query = "SELECT * FROM manufacture WHERE NAME LIKE '%$search%' LIMIT  $page_limit OFFSET $page_skip";
$records = get_list($query);

?>

<!DOCTYPE html>
<html>
<div class="row2">

    <?php include '../root/fromadd.php'; ?>
</div>

</div>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Dashboard </title> -->
    <link rel="stylesheet" href="../css/cssdb.css">
    <link rel="stylesheet" href="../css/cssmf.css">
    <script src="../js/mf.js"></script>
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

        </div>
    </div>



</body>

</html>