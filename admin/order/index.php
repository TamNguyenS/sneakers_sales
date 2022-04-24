<!DOCTYPE html>
<html>
</div>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Order</title>
    <link rel="stylesheet" href="../css/cssdb.css?v=2">
    <link rel="stylesheet" href="../css/cssmf.css?v=2">
    <script src="../js/mf.js"></script>
    <!-- icon -->
    <script src="https://kit.fontawesome.com/945e1fd97f.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/font-awesome-line-awesome/css/all.min.css">
</head>

<body>

    <div class="grid-container">
        <div class="container-header">
            <!-- <php include '../root/header.php' ?> -->
        </div>
        <div class="container-siderbar">
            <?php include '../root/sidebar.php' ?>

        </div>

        <div class="container-main">
            <div class="container">
                <div class="tag-name">
                    <h1> Đơn hàng hiện tại </h1>
                </div>

            </div>
            <div class="table-content">
                    <!-- <php echo $msg ?> -->
                    <div class="table-button">
                        <div class="btn-add">

                            <a href="./manufactureadd.php" ><button class="btn btn1" id="button"><span class="fas fa-plus-circle"></span> Thêm nhà cung cấp</button> </a>
                        </div>
                        <div class="btn-out">

                            <button> <span class="fa-solid fa-file-excel"></span> &nbsp; Xuất file Excel</button>
                        </div>

                    </div>

                    <table border="1px">
                        <thead>
                            <tr>
                                <th>
                                    <h3>ID</h3>
                                </th>
                                <th>
                                    <h3>Tên đơn hàng</h3>
                                </th>
                                <th>
                                    <h3>Xuất xứ</h3>
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
                     
                                <tr>
                                    <td>
                                        <p></p>
                                    </td>
                                    <td>
                                        <p></p>
                                    </td>
                                    <td>
                                        <p></p>
                                    </td>
                                    <td>
                                        <p></p>
                                    </td>
                                    <td>
                                        <p></p>
                                    </td>
                                    <td>
                                        <p></p>
                                    </td>
                                    <td>
                                        <p></p>
                                    </td>
                                    <td>
                                        <div class="table-button2">
                                           
                                            <div class="btn-delete">
                                                <button class="btn-delete-real" data-name=" <?= $post['name'] ?>" data-id="<?= $post['id'] ?>" >  <span class="fa-solid fa-eraser"  ></span> Xóa</button> </a> 
                                            </div>
                                      
                                            <div class="btn-update">

                                               <a  href="./manufactureupdate.php?id=<?= $post['id'] ?>" ><button> <span class="fa-regular fa-pen-to-square"></span> &nbsp; Sửa</button>  </a> 
                                            </div>
                            
                                        </div>
                                    </td>
                                </tr>
                            
                        </thead>
                    </table>
                    <br>
                    <div class="page">
                        <nav class="pagination-outer" aria-label="Page navigation">
                            <ul class="pagination">
                                
                                        <li class="page-item active"><a class="page-link" href="#"></a></li>
                                  
                                        <li class="page-item"><a class="page-link" href="./?&search="> </a></li>
                                
                            </ul>
                        </nav>
                    </div>
                    <br>
            </main>

        </div>
        </div>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.btn-delete-real').click(function() {
            let btn = $(this);
            let id = $(this).data('id');
            let name = $(this).data('name');
            let result = confirm('Bạn có chắc muốn xóa?: ' + name);
            if (result == true) {
                $.ajax({
                    type: "GET",
                    url: "./?delete=" + id,
                    success: function(response) {
                        btn.parents('tr').remove();
                    }
                });
            }
        })
    });
</script>

</html>