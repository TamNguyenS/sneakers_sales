<?php
require_once '../process_root/check_session.php';
// require_once '../process'
?>
<?php 

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>
    <?php $search = empty($_GET['search']) ? '' : $_GET['search'];
    $search = validate($search); ?>

    <div class="header">
        <div class="search-wrapper">
            <span class="fa fa-search"> </span>
            <form method="get" action="">
                <input placeholder="Search" name="search" type="search" value="<?php echo  $search ?>">


        </div>
       

            <div class="user-wrapper">
                <img src="../img/shikimori.gif" alt="anh">
                <div>
                    <input class="dropdown" type="checkbox" id="dropdown" name="dropdown" hidden />
                    <label class="for-dropdown" for="dropdown">
                        <h4> <?php echo $_SESSION['username'] ?> 
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-caret-down"></i> </h4>
                    </label>
                    <div class="section-dropdown">
                        <div class="section-dropdown-sub">
                            <a href="../process_root/signout.php">Đăng xuất </a>
                            <a href="#">Thông tin </a>
                        </div>

                    </div>
                    <?php
                    $role = '';
                    if ($_SESSION['position'] == 0) {
                        $role = 'Super Admin';
                    } else {
                        $role = 'Admin';
                    }
                    ?>
                    <small> <?php echo $role;  ?></small>

                    </form>


                </div>
            </div>
   
    </div>


</body>

</html>