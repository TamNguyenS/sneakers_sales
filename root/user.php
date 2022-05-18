<?php
require_once '../root/checklogin.php';
require_once '../admin/process_root/check_session.php';
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
              <li><a href='#'>Thông tin </a></li>
              <li><a href='../root/signout.php'>Đăng xuất</a></li>
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
      <li><a href="../account/login.php">Đăng nhập </a></li>
      <li><a href="../account/regis.php">Đăng ký</a></li>
    </ul>
    
        </div>
    </nav>
    

';}



