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
$query_img = "SELECT img FROM product_img WHERE product_id = '$id'";
$product_img = get_list($query_img);
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
    <style>
        td {
            text-align: left
        }
    </style>
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
                <div class="featured">

                    <div class="row">

                        <div class="image-container">

                            <div class="small-image">
                                <?php foreach ($product_img as $img) { ?>
                                    <img src="../photos/<?= $img['img'] ?>" alt="" class="featured-image-1">
                                <?php } ?>
                            </div>
                            <div class="big-image">
                                <img src="../photos/<?= $img['img'] ?>" alt="" class="big-image-1">

                            </div>
                            <?php foreach ($product_info as $product) { ?>
                                <div class="content">
                                    <h3><?php echo $product['name']; ?></h3>
                                    <div class="stars">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <p>
                                        Thương hiệu: <?php echo $product['manufacture_name']; ?>
                                    </p>
                                    <p>
                                        Giá bán: <?php echo number_format($product['cost'], 0, '', ','); ?> <span class="cost">đ</span>
                                    </p>
                                    <p>
                                        Loại sản phẩm: <?php echo $product['type_name']; ?>
                                    </p>
                                </div>


                        </div>
                    </div>
                    <div class="product-detail">

                        <div class="product-content">

                            <div class="table-detail">
                                <table>

                                    <tr>
                                        <th style="background-color: white; text-align: left">Đã bán</th>
                                        <td><?php echo $product['sold']; ?> </td>
                                    </tr>

                                    <tr>
                                        <th style="background-color: white; text-align: left">Số lượng hiện có</th>
                                        <td><?php echo $product['quantity']; ?> </td>
                                    </tr>
                                    <tr>
                                        <th style="background-color: white; text-align: left">Xuất sứ</th>
                                        <td><?php echo $product['manufacture_address']; ?> </td>
                                    </tr>
                                    <tr>
                                        <th style="background-color: white; text-align: left">Ngày thêm</th>
                                        <td><?php echo $product['date']; ?> </td>
                                    </tr>
                                    <tr>
                                        <th style="background-color: white; text-align: left">Mô tả</th>
                                        <td><textarea rows="8" readonly><?php echo $product['description']; ?></textarea></td>
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
                        $this_month = date('m');
                        // echo $this_month;
                        $query_data = "SELECT orders_detail.quantity AS orders_detail_Quantity, DAY(time_accept) AS each_day 
                    FROM orders INNER JOIN orders_detail ON orders_detail.orders_id = orders.id
                    WHERE orders_detail.product_id = '$id' AND MONTH(time_accept) = '$this_month'";
                        $connect = connect();
                        $result_data = mysqli_query($connect, $query_data);
                        $arr = [];
                        $current_total_day = date("t");
                        for ($i = 1; $i <= $current_total_day; $i++) {
                            $arr[$i] = 0;
                        }
                        $max_product = 0;
                        foreach ($result_data as $each) {
                            $arr[$each['each_day']] = $each['orders_detail_Quantity'];
                            if ($each['orders_detail_Quantity'] > $max_product) {
                                $max_product = $each['orders_detail_Quantity'];
                            }
                        }
                        $max_product_data = (int)($max_product);

                        $arr_data = array_values($arr);

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
<script src="../js/selectimg.js"> </script>

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
            data: <?php echo json_encode($arr_data) ?>,
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
                    duration: 300,
                    easing: 'linear',
                    from: 1,
                    to: 0,
                }
            },
            scales: {
                y: {
                    min: 0,
                    max: <?php echo $max_product_data + 1 ?>
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