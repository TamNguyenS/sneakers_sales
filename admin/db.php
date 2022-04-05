<? 
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'nguyenchitam123');
define('DB_NAME', 'hikkyshop');
function connect(){
    $connect = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    mysqli_set_charset($connect, 'utf8');
    if(mysqli_connect_errno()){
        die('Failed to connect to MySQL: '.mysqli_connect_error());
    }
    return $connect;
}
function disconnect ($connect) {
    mysqli_close($connect);
}

function getInfo($sql){
    $connect = connect();
    $result = mysqli_query($connect, $sql);
    if (!$result) die('[Database class - getInfo] Wrong SQL: '.$sql);
    $return = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $return[] = $row;
    }
    
    mysqli_free_result($result);
    disconnect($connect);
    return $return;

}

// function insert($table, $data){
//     $connect = connect();
//     $data


// }