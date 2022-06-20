<?php
require_once '../admin/db.php';
// require_once '../admin/func.php';
require_once './validate.php';
$name = isset($_POST['name']) ? $_POST['name'] : false;
$email = isset($_POST['email']) ? $_POST['email'] : false;
$phone  = isset($_POST['phone']) ? $_POST['phone'] : false;
$age = isset($_POST['date']) ? $_POST['date'] : false;
$address = isset($_POST['address']) ? $_POST['address'] : false;
$password = isset($_POST['password']) ? $_POST['password'] : false;

$isSubmit = false; //submit
$error = ''; //loi
$isError = false; //loi




if (
    $name !== false
    && $email !== false
    && $phone !== false
    && $address !== false
    && $age !== false
    && $password !== false
) {
    $isSubmit = true;

    if (!isPassword($password)) {
        $error .= '[Error] Mật khẩu phải từ 6 tới 30 ký tự, bao gồm chữ hoa, chữ thường, số và kí tự đặc biệt<br>';
        $isError = true;
    }

    if (!isEmailVlr($email)) {
        $error .= '[Error] Email không hợp lệ!<br>';
        $isError = true;
    }
    if (checkEmail($email)) {
        $error .= '[Error] Email đã được đăng kí!<br>';
        $isError = true;
    }
    if(!isPhone1($phone)) {
        $error .= '[Error] Số điện thoại không hợp lệ!<br>';
        $isError = true;
    }
    if (!isNameNE($name)) {
        $error .= '[Error] Họ và tên không hợp lệ!<br>';
        $isError = true;
    }
    // if (!isName($address)) {
    //     $error .= '[Error] Dia chi khong hop le!<br>';
    //     $isError = true;
    // }
    if (!$isError) {
        $result = insert('customer', array(
            'name' => $name,
            'dob' => $age,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            'password' => $password
        ));

        if ($result) {
            echo 1;
            return;
        } 
    }
    else {
        echo $error;
        return;
    }
}

function checkEmail($email) {
    $conn = connect();
    $sql = "SELECT * FROM customer WHERE email = '$email'";
    // echo $sql;
    $result = mysqli_query($conn,  $sql);
    $number_rows = mysqli_num_rows($result);
    if ($number_rows >=1) {
        return true;
        
    }
    return false;
}
