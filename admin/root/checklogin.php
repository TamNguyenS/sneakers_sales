<?php

if(!isset($_SESSION)) 
{ 
    session_start(); 
}
if (
    !isset($_SESSION['id'])
    // && !isset($_SESSION['name'])
    // && !isset( $_SESSION['username'])
    // && !isset( $_SESSION['position'])

) {
   
    header('Location: ../root/404page.php');
    exit;
}
?>