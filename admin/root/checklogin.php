<?php

if(!isset($_SESSION)) 
{ 
    session_start(); 
}
if (
    !isset($_SESSION['id'])
    && !isset($_SESSION['name'])
) {
    // echo "Luu sesson thanh cong";
    // echo $_SESSION['id'];
    // echo $_SESSION['username'];
    // echo $_SESSION['position'];
    // echo $_SESSION['photo'];
    header('Location: ../root/404page.php');
    exit;
}
