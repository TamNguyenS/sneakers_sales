<?php
sleep(1);
?>

<?php
require_once '../db.php';
require_once '../func.php';
?>

<?php
$search = empty($_GET['search']) ? '' : $_GET['search'];
$search = validate($search);
$statusorder = isset($_POST['status']) ? $_POST['status'] : '';
$statusorder = validate($statusorder);
$search = validate($search);
$status_order_query = '';
$date =isset($_POST['date']) ? $_POST['date'] : ''; 
//page 
$page = empty($_GET['page']) ? 1 : $_GET['page'];
if (!is_numeric($page)) die();
$status = isset($_POST['status ']) ? $_POST['status '] : ''; 
$page_limit = 6;
$page_total_length = get_count("SELECT count(*) FROM orders WHERE recipent_name LIKE '%$search%' AND status ='$statusorder'  ");
$page_length = ceil($page_total_length / $page_limit);
$page_skip =  $page_limit * ($page - 1);

$query = "SELECT orders.* , customer.name as customer_name, 
customer.phone as customer_phone, customer.address as customer_address 
FROM orders LEFT JOIN customer ON orders.recipient_id = customer.id
WHERE (status = '$statusorder') OR (time_order = '$date') AND (recipent_name LIKE '%$search%')  ORDER BY id DESC LIMIT  $page_limit OFFSET $page_skip";
// echo $query;
// die();
$records = get_list($query);
// echo count($records);

?>

                    <table border="1px">
                        <thead>
                            <tr>
                                <th>
                                    <h3>ID </h3>
                                </th>
                                <th>
                                    <h3>Thời gian đặt &nbsp;<i class="fa-solid fa-caret-down"></i></h3>
                                </th>
                                <th>
                                    <h3>Thông tin người nhận</h3>
                                </th>
                                <th>
                                    <h3>Thông tin người đặt</h3>
                                </th>
                                <th>
                                    <h3>Trạng thái &nbsp;<i class="fa-solid fa-caret-down"></i></h3>
                                </th>
                                <th>
                                    <h3>Tổng tiền &nbsp;<i class="fa-solid fa-caret-down"></i></h3>
                                </th>
                                <th>
                                    <h3>Ghi chú</h3>
                                </th>
                                <th>
                                    <h3>Quản lí</h3>
                                </th>

                            </tr>
                            <tr class="loader-add" >

                                </tr>
                            <tr class="remove">
                                    <?php 
                                    if(count($records)==0){
                                        echo '<td colspan="8" style="text-align: center;">Không có dữ liệu nào cả</td>';
                                    }
                                    ?>
                                </tr>
                            <?php foreach ($records as $record) { ?>


                                <tr class="remove">
                                    <td>
                                        <p><span style="color: rgb(250, 35, 189); font-weight:bold">#</span><?= encodeID($record['id']) ?></p>
                                    </td>
                                    <td style="width: 150px;">
                                        <p><?= $record['time_order'] ?></p>
                                    </td>
                                    <td>
                                        <p><?= $record['recipent_name'] ?></p>

                                        <p><?= $record['recipent_address'] ?></p>

                                        <p><?= $record['recipent_phone'] ?></p>
                                    </td>
                                    <td>
                                        <p><?= $record['customer_name'] ?></p>
                                        <p><?= $record['customer_address'] ?></p>
                                        <p><?= $record['customer_phone'] ?></p>
                                    </td>
                                    <td style="width: 110px; ">
                                        <?php $satuss = $record['status'];

                                        switch ($satuss) {
                                            case 0:
                                                echo '<p class="status1">Chờ duyệt</p>';
                                                break;
                                            case 1:
                                                echo '<p class="status2">Đã duyệt</p>';
                                                break;
                                            case 2:
                                                echo '<p class="status3">Đã Hủy</p>';
                                                break;
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <p><?php echo number_format($record['total_cost'], 0, '', ','); ?> <span class="cost">đ</span></p>
                                    </td>
                                    <td>
                                        <p><?= $record['note'] ?></p>
                                    </td>
                                    <td class="table-manager" style="width: 90px; ">
                                        <div class="table-button2">
                                            <?php if ($record['status'] == 0) {
                                                require '../root/buttonD.php';
                                                require '../root/buttonU.php';
                                            } ?>

                                            <div class="btn-detail">
                                                <a href="./orderdetail.php?id=<?= $record['id'] ?>"> <i class="fa-solid fa-arrow-up-right-from-square icon-detail"></i></a>
                                                <!-- <a href="./productdetail.php?id=<?= $post['id'] ?>"><button> <i class="fa-solid fa-ellipsis"></i>&nbsp; Chi tiết</button> </a> -->
                                            </div>

                                        </div>
                                    </td>
                                </tr>
                              
                            <?php } ?>
                        </thead>
                    </table>
                    <br>
                    <div class="page remove">
                        <nav class="pagination-outer" aria-label="Page navigation">
                            <ul class="pagination">
                                <?php for ($i = 1; $i   <= $page_length; $i++) {
                                    if ($i == $page) { ?>
                                        <li class="page-item active"><a class="page-link" href="#"><?php echo $i; ?></a></li>
                                    <?php } else { ?>
                                        <li class="page-item"><a class="page-link" href="./?&search=<?php echo $search?>&status=<?=$statusorder?>&page=<?php echo $i ?>"><?php echo $i; ?></a></li>
                                <?php
                                    }
                                } ?>
                            </ul>
                        </nav>
                    </div>
                    <br>


                </div>