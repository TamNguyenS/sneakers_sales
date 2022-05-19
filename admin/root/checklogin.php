<?php
require_once '../process_root/check_session.php'; 
?>
<?php

if ( !isset($_SESSION['id'])  && !isset($_SESSION['possiton'] ))
    // && !isset($_SESSION['name'])
    // && !isset( $_SESSION['username'])
    // && !isset( $_SESSION['position'])

 {
   
    header('Location: ../root/404page.php');
    exit;
}
?>