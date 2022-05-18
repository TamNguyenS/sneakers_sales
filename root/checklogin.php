<?php
require_once '../admin/process_root/check_session.php';
require_once '../admin/db.php';
require_once '../admin/func.php';
// if(!(isset($_SESSION['loggedsucces']) && $_SESSION['loggedsucces'] == true)){
//    return true;
// }
function check_login(){
    if(!(isset($_SESSION['loginsucces']) && $_SESSION['loginsucces'] == true)){
        return true;
    }
    return false;
}

?>