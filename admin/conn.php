<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'nguyenchitam123');
define('DB_NAME', 'hikkyshop');
function connect()
{
    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME) or die('could not connect to database');
    header("Content-type: text/html; charset=utf-8");
    mysqli_set_charset($conn, 'UTF8');
    return $conn;
}
function disconnect($conn)
{
    mysqli_close($conn);
} 
