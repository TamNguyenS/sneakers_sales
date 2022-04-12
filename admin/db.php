<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'nguyenchitam123');
define('DB_NAME', 'hikkyshop');
//connect to the database
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

function insert($table, $data)
{
    $conn = connect();
    $field_list = ''; //ten truong
    $value_list = ''; //data cua moi truong
    foreach ($data as $key => $value) {
        $field_list .= ",$key";
        $value_list .= ",'" . $conn->real_escape_string($value) . "'"; //real_escape_string: chống sql injection loai bo cac ky tu dac biet
    }
    $query = 'INSERT INTO ' . $table . '(' . trim($field_list, ',') . ') VALUES (' . trim($value_list, ',') . ')';
    $result = $conn->query($query);
    // echo $result;
    if(!$result) die('[Database class - insert] Truy vấn sai');
    disconnect($conn);
    return $result;
}
//get all data from database
function get_data($table){
    $conn = connect();
    $query = 'SELECT * FROM ' . $table;
    $result = $conn->query($query);
    if(!$result) die('[Database class - get_data] Truy vấn sai');
    $return = array();
    while($row = mysqli_fetch_assoc($result)){
        $return[] = $row;
    }
    mysqli_free_result($result);
    disconnect($conn);  
    return $return;
}

function get_list($sql){
    $conn = connect();
    $result = $conn->query($sql);
    if(!$result) die('[Database class - get_list] Truy vấn sai');
    $return = array();
    while($row = mysqli_fetch_assoc($result)){
        $return[] = $row;
    }
    mysqli_free_result($result);
    disconnect($conn);  
    return $return;
}
// function count_records($table){
//     $conn = connect();
//     $query = 'SELECT count(id) AS total FROM ' . $table;
//     $result = $conn->query($query);
//     if(!$result) die('[Database class - count_records] Truy vấn sai');
//     $row = mysqli_fetch_assoc($result);
//     $total_records = $row['total'];
//     disconnect($conn);
//     return $total_records;
// }

function get_count ($sql) {
    $conn = connect();

    $result = mysqli_query($conn, $sql);
    if (!$result) die('[Database class - get_count] Truy vấn sai');

    $result = mysqli_fetch_array($result)['count(*)'];
    return $result;
}

function remove ($table, $where) {
    $conn = connect();
    
    $sql = "DELETE FROM $table WHERE id = '$where'";
    $result = mysqli_query($conn, $sql);

    disconnect($conn);
    return $result;
}