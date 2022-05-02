<?php
require '../root/checklogin.php';
?>
<?php
require_once '../db.php';
require_once '../func.php';
?>
<?php

$id = $_GET['id'];

$query = "SELECT product.* , manufacture.name AS manufacture_name, manufacture.address AS manufacture_address,
type.name AS type_name FROM product 
INNER JOIN manufacture ON product.manufacture_id = manufacture.id
INNER JOIN type ON product.type_id = type.id
WHERE product.id = '$id'";
$product_info = get_list($query);
// SELECT orders_detail.quantity AS orders_detail_Quantity, day(time_accept) AS each_Day 
// FROM orders INNER JOIN orders_detail ON orders_detail.orders_id = orders.id
// WHERE orders_detail.product_id = '1' group by day(time_accept)

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add</title>
    <link rel="stylesheet" href="../css/detail.css">
    <link rel="stylesheet" href="../css/cssdb.css">
    <link rel="stylesheet" href="../css/cssmf.css">


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
                    <a href="./index.php">
                        <h2> <span class="fa fa-arrow-circle-left"></span> Xem chi tiết sản phẩm</h2><br>
                    </a>
                </div>
            </div>

            <div class="container-content">


                <!-- containner connetent -->
                <?php foreach ($product_info as $product) { ?>
                    <div class="table-button-detail">
                        <div class="btn-out">
                            <a> <button> <span class="fa-solid fa-file-excel"></span> &nbsp; Excel</button> </a>
                        </div>
                        <div class="btn-addd">
                            <a href="./productadd.php"><button><span class="fa-regular fa-pen-to-square"></span> Sửa</button> </a>
                        </div>
                        <div class="btn-delete">
                            <a href="./productadd.php"><button><span class="fa-solid fa-eraser"></span> Xóa</button> </a>
                        </div>
                    </div>
                    <div class="product-detail">
                        <div class="product-title">
                            <h1><?php echo $product['name']; ?><h1>
                                    <div class="detail-img">
                                        <img src="../photos/<?php echo $product['image']; ?>" alt="">
                                    </div>


                        </div>
                        <div class="product-content">

                            <div class="table-detail">
                                <table>

                                    <tr>
                                        <th>Tên sản phẩm</th>
                                        <td><?php echo $product['name']; ?></td>
                                    </tr>

                                    <tr>
                                        <th>Đã bán</th>
                                        <td><?php echo $product['sold']; ?> </td>
                                    </tr>

                                    <tr>
                                        <th>Số lượng hiện có</th>
                                        <td><?php echo $product['quantity']; ?> </td>
                                    </tr>
                                    <tr>
                                        <th>Nhà sản xuất</th>
                                        <td><?php echo $product['manufacture_name']; ?> </td>
                                    </tr>
                                    <tr>
                                        <th>Loại sản phẩm</th>
                                        <td><?php echo $product['type_name']; ?> </td>
                                    </tr>
                                    <tr>
                                        <th>Xuất sứ</th>
                                        <td><?php echo $product['manufacture_address']; ?> </td>
                                    </tr>
                                    <tr>
                                        <th>Ngày thêm</th>
                                        <td><?php echo $product['date']; ?> </td>
                                    </tr>
                                    <tr>
                                        <th>Mô tả</th>
                                        <td><textarea rows="5" readonly><?php echo $product['description']; ?></textarea></td>
                                    </tr>
                                <?php } ?>
                                </table>
                            </div>

                        </div>


                    </div>

            </div>

            <div class="chart-detail-product">
                <br>
                <h1>Biểu đồ sản phẩm bán được: </h1>
                <div class="table-button">
                    <form action=" " name="test">
                        <div class="fillter">
                            <i class="fa-solid fa-arrow-down-short-wide"></i>&nbsp;

                            <select class="fillter-orders" name="statusorder" id="statusorder">

                                <option value="">Tuần này </option>
                                <option selected value="2">Tháng này</option>
                                <option value="1">Năm này</option>

                            </select>

                            <!-- <input type="submit" class=""></input> -->
                        </div>
                    </form>
                </div>
                <div class="chart-data">
                    <?php
                        $query_data = "SELECT orders_detail.quantity AS orders_detail_Quantity, day(time_accept) AS each_day 
                        FROM orders INNER JOIN orders_detail ON orders_detail.orders_id = orders.id
                        WHERE orders_detail.product_id = '$id' group by day(time_accept)";
                        $chart_data = get_list($query_data);
                        // print_r($chart_data);

                    ?>
                </div>
                <div class="chart-detail-product-content" id="chart-detail-product-content">
                    <canvas id="myChart" style="height:100%;max-height:400px;"></canvas>
                </div>
            </div>
        </div>

    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"> </script>

<script>
    const get_day_of_month = (year, month) => {
        return new Date(year, month, 0).getDate();
    };
</script>
<script>
    const d = new Date();
    const month = d.getMonth() + 1;
    const year = d.getFullYear();
    let get_day_of_month_now = get_day_of_month(year, month);
    console.log(get_day_of_month_now);
    const data_date_of_month_all = [];
    for (let i = 1; i < 32; i++) {
        data_date_of_month_all[i - 1] = i;
    }
    switch (get_day_of_month_now) {
        case 31:

            break;
        case 30:
            const removed = data_date_of_month_all.splice(30, 1)
            break;
        case 28:
            const removed1 = data_date_of_month_all.splice(28, 3)

            break;
        case 29:
            const removed2 = data_date_of_month_all.splice(29, 2)
            break;

    }


    const data = {
        labels: data_date_of_month_all,
        datasets: [{
            label: 'Số sản phẩm bán được',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: [1, 10, 3, 4, 5, 6, 7, 8, 9, 10],
        }]
    };

    const config = {
        type: 'line',
        data: data,
        options: {
            animation: {
                delay: 1500, // change delay to suit your needs.
            },
            animations: {
                tension: {
                    duration: 1000,
                    easing: 'linear',
                    from: 1,
                    to: 0,
                }
            },
            scales: {
                y: {
                    min: 0,
                    max: 100
                }
            }
        }
    };
</script>
<script>
    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
</script>


</html>