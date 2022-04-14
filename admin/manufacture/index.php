<?php
// $name = isset($_POST['name']) ? $_POST['name'] : false;
// //fix sửa địa chỉ thành danh mục nhỏ//
// $address = isset($_POST['address']) ? $_POST['name'] : false;
// $phone = isset($_POST['phone']) ? $_POST['phone'] : false;
// $email = isset($_POST['email']) ? $_POST['email'] : false;
// $date = isset($_POST['datee']) ? $_POST['datee'] : false;
// $note = isset($_POST['note']) ? $_POST['note'] : false;

$isSubmit = false; //submit
$error = ''; //loi
$msg = ''; //thong bao
$isError = false; //loi
require_once '../db.php';
require_once '../func.php';
?>
<?php

// require_once '../db.php';
// require_once '../func.php';

$search = empty($_GET['search']) ? '' : $_GET['search'];
$search = validate($search);

//page 
$page = empty($_GET['page']) ? 1 : $_GET['page'];
if (!is_numeric($page)) die();

$page_limit = 6;
$page_total_length = get_count('SELECT count(*) FROM manufacture WHERE NAME LIKE \'%' . $search . '%\'');
$page_length = ceil($page_total_length / $page_limit);
$page_skip =  $page_limit * ($page - 1);

$query = "SELECT * FROM manufacture WHERE NAME LIKE '%$search%' LIMIT  $page_limit OFFSET $page_skip";
$records = get_list($query);

?> 
<?php 
    $delete = empty($_GET['delete']) ? 'false' : $_GET['delete'];
    if($delete !== false){
        // $id = $_GET['delete'];
        $result = remove('manufacture', $delete);
        
        if($result){
            $msg = 'Xóa thành công';
            // header('Location: ./index.php');
            // die();
        }
        else{
            $msg = 'Xóa Không thành công ';
        }
    }
?>

<!DOCTYPE html>
<html>
<!-- <div class="row2">

    <?php include '../root/fromadd.php'; ?>
</div> -->

</div>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - manufacture</title>
    <link rel="stylesheet" href="../css/cssdb.css">
    <link rel="stylesheet" href="../css/cssmf.css">
    <script src="../js/mf.js"></script>
    <!-- icon -->
    <script src="https://kit.fontawesome.com/945e1fd97f.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/font-awesome-line-awesome/css/all.min.css">
</head>

<body>

    <div class="grid-container">
        <div class="container-header">
            <?php include '../root/header.php' ?>
        </div>
        <div class="container-siderbar">
           <?php include '../root/sidebar.php' ?>

        </div>
     
        <div class="container-main">
            <div class="container">
                <div class="tag-name">
                    <h2> Nhà cung cấp</h2>
                </div>

            </div>

            <main>
                <div class="cards" style="margin-top:-5px; margin-bottom: 10px; ">

                    <div class="card-single">
                        <div>
                            <h1> 15</h1>
                            <span>Nhà sản xuất hiện tại</span>
                        </div>
                        <div>
                            <span class="fa fa-industry"> </span>
                        </div>
                    </div>

                    <div class="card-single">
                        <div>
                            <h1> 13</h1>
                            <span>Nhà sản xuất trong tháng này</span>
                        </div>
                        <div>
                            <span class="fa fa-line-chart"> </span>
                        </div>
                    </div>
                    <div class="card-single">
                        <div>
                            <h1> 13</h1>
                            <span>Nhà sản xuất trong tháng này</span>
                        </div>
                        <div>
                            <span class="fa fa-area-chart"> </span>
                        </div>
                    </div>

                </div>
                <div class="table-content">
                    <?php echo $msg ?>
                    <div class="table-button">
                        <div class="btn-add">

                            <a href="./manufactureadd.php" ><button class="btn btn1" id="button"><span class="fas fa-plus-circle" style="color: rgb(237, 205, 24); "></span> Thêm nhà sản xuất</button> </a>
                        </div>
                        <div class="btn-out">

                            <button> <span class="fa-solid fa-file-excel" style="color: rgb(14, 172, 40); height: 20px; width: 20px;"></span> &nbsp; Xuất file Excel</button>
                        </div>

                    </div>

                    <table border="1px">
                        <thead>
                            <tr>
                                <th>
                                    <h3>ID</h3>
                                </th>
                                <th>
                                    <h3>Tên nhà sản xuất</h3>
                                </th>
                                <th>
                                    <h3>Địa chỉ</h3>
                                </th>
                                <th>
                                    <h3>Email</h3>
                                </th>
                                <th>
                                    <h3>Điện thoại</h3>
                                </th>
                                <th>
                                    <h3>Ngày thêm</h3>
                                </th>
                                <th>
                                    <h3>Ghi chú</h3>
                                </th>
                                <th>
                                    <h3>Quản lí</h3>
                                </th>

                            </tr>
                            <?php foreach ($records as $post) { ?>

                                <tr>
                                    <td>
                                        <p><?php echo $post['id'] ?></p>
                                    </td>
                                    <td>
                                        <p><?php echo $post['name'] ?></p>
                                    </td>
                                    <td>
                                        <p><?php echo $post['address'] ?></p>
                                    </td>
                                    <td>
                                        <p><?php echo $post['email'] ?></p>
                                    </td>
                                    <td>
                                        <p><?php echo $post['phone'] ?></p>
                                    </td>
                                    <td>
                                        <p><?php echo $post['datee'] ?></p>
                                    </td>
                                    <td>
                                        <p><?php echo $post['note'] ?></p>
                                    </td>
                                    <td>
                                        <div class="table-button2">
                                           
                                            <div class="btn-delete">
                                               <a onclick="return confirm('Bạn có chắc muốn xóa?')"  href="./?delete=<?= $post['id'] ?>" > <button >  <span class="fa-solid fa-trash"  ></span> Xóa</button> </a> 
                                            </div>
                                      
                                            <div class="btn-update">

                                               <a  href="./manufactureupdate.php?id=<?= $post['id'] ?>" ><button> <span class="fa-solid fa-pen"></span> &nbsp; Sửa</button>  </a> 
                                            </div>
                            
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </thead>
                    </table>
                    <br>
                    <div class="page">
                        <nav class="pagination-outer" aria-label="Page navigation">
                            <ul class="pagination">
                                <?php for ($i = 1; $i <= $page_length; $i++) {
                                    if ($i == $page) { ?>
                                        <li class="page-item active"><a class="page-link" href="#"><?php echo $i; ?></a></li>
                                    <?php } else { ?>
                                        <li class="page-item"><a class="page-link" href="./?&search=<?php echo $search ?>&page=<?php echo $i ?>"><?php echo $i; ?></a></li>
                                <?php
                                    }
                                } ?>
                            </ul>
                        </nav>
                    </div>
                    <br>
            </main>

        </div>
    </div>
    </div>



</body>

</html>