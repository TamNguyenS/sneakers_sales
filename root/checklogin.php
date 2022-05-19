<?php
require_once '../admin/process_root/check_session.php';
require_once '../admin/db.php';
require_once '../admin/func.php';
    if(isset($_SESSION['loginsucces']) && isset($_SESSION['id_user']) ){
       return true;
    }else{
        echo '
        <script>
        alert("Vui lòng đăng nhập");
        window.location = "../account/login.php";
        </script>
        ';
       
    }
    
?>