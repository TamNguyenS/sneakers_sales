<?php

require_once '../admin/process_root/check_session.php';
// if(!(isset($_SESSION['loggedsucces']) && $_SESSION['loggedsucces'] == true)){
//    return true;
// }
function check_login(){
    if(!(isset($_SESSION['loginsucces']) && $_SESSION['loginsucces'] == true)){
        return true;
    }
    return false;
}
$result = check_login();
// echo $result;
// die();
if ($result!=1) {
  $name = $_SESSION['name'];
    echo "
    <nav class='drop-user'>
    <div class='content-user'>
          <p>TÀI KHOẢN</p>
          <div class=' bottomm 1'>
          </div>
          <h4>$name</h4>
          <ul>
              <li ><a  style='color:white' href='#'>Thông tin </a></li>
              <li><a style='color:white' href='../root/signout.php'>Đăng xuất</a></li>
          </ul>
  
      </div>
  </nav>
    ";  
}else if ($result == 1) {
        echo '
    <nav class="drop-user">
      <div class="content-user">
      <p> Xin chào </p>
      <ul>
      <li><a style="color:white" href="../account/login.php">Đăng nhập </a></li>
      <li><a style="color:white" href="../account/regis.php">Đăng ký</a></li>
    </ul>
    
        </div>
    </nav>
    

';}



