<?php
require_once '../root/checklogin.php'
?>
<?php
require_once '../db.php';
require_once '../func.php';
?>
<?php
$query = "SELECT manufacture.name , SUM(quantity) AS total FROM product
 INNER JOIN manufacture ON manufacture.id = product.manufacture_id GROUP by manufacture_id";
$records = get_list($query);
$max = 0;
$min = 0;

$query_best_seler = "SELECT  name, sold,id
FROM product
ORDER BY sold DESC  LIMIT 4";
$bestseler = get_list($query_best_seler);

?>
<?php
$this_month = date('m');
$this_year = date('Y');
$count_product_sold_year = get_count_v2("SELECT SUM(quantity) AS TOTAL FROM orders_detail LEFT JOIN orders ON orders_detail.orders_id = orders.id WHERE YEAR(time_accept) = $this_year");
$count_product_new_month =  get_count_v2("SELECT count(id) AS TOTAL FROM orders_detail LEFT JOIN orders ON orders_detail.orders_id = orders.id WHERE MONTH(time_accept) = $this_month ");
$count_all_money = get_count_v2("SELECT sum(total_cost) AS TOTAL FROM orders   ");
$count_all_money_month = get_count_v2("SELECT sum(total_cost) AS TOTAL FROM orders  WHERE MONTH(time_accept) = $this_month");

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <title>Dashboard </title> -->
  <link rel="stylesheet" href="../css/cssdb.css?v=2">
  <link rel="stylesheet" href="../css/cssmf.css?v=2">
  <link rel="stylesheet" href="../css/productchart.css?v=2">
  <script src="../js/mf.js"></script>
  <!-- icon -->
  <script src="https://kit.fontawesome.com/945e1fd97f.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/font-awesome-line-awesome/css/all.min.css">
  <style>
    .highcharts-figure,
    .highcharts-data-table table {
      min-width: 310px;
      max-width: 800px;
      margin: 1em auto;
    }

    #container {
      height: 400px;
    }

    .highcharts-data-table table {
      font-family: Verdana, sans-serif;
      border-collapse: collapse;
      border: 1px solid #ebebeb;
      margin: 10px auto;
      text-align: center;
      width: 100%;
      max-width: 500px;
    }

    .highcharts-data-table caption {
      padding: 1em 0;
      font-size: 1.2em;
      color: #555;
    }

    .highcharts-data-table th {
      font-weight: 600;
      padding: 0.5em;
    }

    .highcharts-data-table td,
    .highcharts-data-table th,
    .highcharts-data-table caption {
      padding: 0.5em;
    }

    .highcharts-data-table thead tr,
    .highcharts-data-table tr:nth-child(even) {
      background: #f8f8f8;
    }

    .highcharts-data-table tr:hover {
      background: #f1f7ff;
    }
  </style>
</head>

<body>

  <?php
  require_once '../db.php';
  require_once '../func.php';
  ?>
  <div class="grid-container">
    <div class="container-header">
      <?php include '../root/header.php' ?>

    </div>
    <div class="container-siderbar">
      <?php include '../root/sidebar.php' ?>

    </div>
    <div class="container-main">

      <main>
        <div class="cards" style="margin-top:-5px; margin-bottom: 10px;  margin-left: 100px;  grid-template-columns: repeat(5, 1fr);">

          <div class="card-single">
            <div>
              <h1><?= number_format($count_all_money, 0, '', ','); ?> VNĐ</h1>
              <span>Tổng doanh thu </span>
            </div>
            <div class="card-icon" style="background-color: rgb(252, 242, 210);">
              <span class="fa-solid fa-store" style="color: rgb(248, 225, 52)"></span>
            </div>
          </div>

          <div class="card-single">
            <div>
              <h1> <?= number_format($count_all_money_month, 0, '', ','); ?> VNĐ</h1>
              <span>Doanh thu tháng này</span>
            </div>
            <div class="card-icon" style="  background-color: rgb(221, 230, 254);">
              <span class="fa-solid fa-file-invoice-dollar" style=" color: rgb(30, 90, 255);"></span>

            </div>
          </div>
          <div class="card-single">
            <div>
              <h1><?= $count_product_sold_year ?></h1>
              <span>Tổng số sản phẩm bán được</span>
            </div>
            <div class="card-icon" style="background-color: rgb(249, 219, 237);">
              <span class="fa-solid fa-shoe-prints" style="color: rgb(252, 64, 176);"></span>
            </div>
          </div>
          <div class="card-single">
            <div>
              <h1><?= $count_product_new_month ?></h1>
              <span>Tổng số sản phẩm mới</span>
            </div>
            <div class="card-icon" style="background-color: #ffe9ed;">

              <span class="fa-brands fa-shopify" style="color: #f3272a;"></span>

            </div>
          </div>

        </div>



        <div class="container-row2">
          <h1><i class="fa-solid fa-chart-area"></i>&nbsp; Biểu đồ doanh thu </h1>
          <?php
                    $this_month = date('m');
                    // echo $this_month;
                    $query_data = "SELECT orders_detail.quantity AS orders_detail_Quantity, DAY(time_accept) AS each_day 
                    FROM orders INNER JOIN orders_detail ON orders_detail.orders_id = orders.id
                     AND MONTH(time_accept) = '$this_month'";
                    $connect = connect();
                    $result_data = mysqli_query($connect, $query_data);
                    $arr = [];
                    $current_total_day = date("t");
                    for($i = 1; $i <= $current_total_day; $i++){
                        $arr[$i] = 0;
                    }
                    $max_product = 0;
                    foreach ($result_data as $each) {
                        $arr[$each['each_day']] = $each['orders_detail_Quantity'];
                        if($each['orders_detail_Quantity'] > $max_product){
                            $max_product = $each['orders_detail_Quantity'];
                        }
                    }
                    $max_product_data = (int)($max_product);
                
                    $arr_data = array_values($arr);

                    ?>

            <div id="container-chart">



            </div>
    
        </div>
        <div class="container-row2">
          <h1><i class="fa-solid fa-chart-area"></i>&nbsp; Khách hàng tiềm năng </h1>
        </div>
        <div class="container-row2">
          <h1><i class="fa-solid fa-chart-area"></i>&nbsp; Doanh thu chi tiết</h1>
          comming soon
        </div>
      </main>


    </div>
  </div>

</body>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script>
    const get_day_of_month = (year, month) => {
        return new Date(year, month, 0).getDate();
    };
</script>
<script type="text/javascript">

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


Highcharts.chart('container-chart', {
    chart: {
      type: 'column'
    },
    title: {
      align: 'center',
      text: 'Biểu đồ doanh thu sản phẩm trong năm '
    },
    accessibility: {
      announceNewData: {
        enabled: true
      }
    },
    xAxis: {
      type: 'category'
    },

    legend: {
      enabled: false
    },
    plotOptions: {
      series: {
        borderWidth: 0,
        dataLabels: {
          enabled: true,
          format: '{point.y:.1f}'
        }
      }
    },
  
    tooltip: {
      headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
      pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b> trong tất cả<br/>'
    },
  
    series: [
      {
        name: "Tổng sản phẩm",
        colorByPoint: true,
        data: [
          {
            name: "Minimus TR BOA",
            y: 11,
            drilldown: "Minimus TR BOA"
          },
          {
            name: "Tông Lào Chính hảng",
            y: 11,
            drilldown: "Chrome"
          },
          {
            name: "MADE in USA 990v3 Core",
            y: 7,
            drilldown: "Chrome"
          },
          {
            name: "MEDUSA BIGGIE LOAFERS",
            y: 6,
            drilldown: "Chrome"
          },
      
          {
            name: "Unisex 250",
            y: 5,
            drilldown: "Chrome"
          },
          {
            name: "BLUNDSTONE CLASSICS Women",
            y: 4,
            drilldown: "Chrome"
          },
          {
            name: "Minimus TR BOA86",
            y: 5,
            drilldown: "Chrome"
          },
        ]
      }
    ],


    drilldown: {
      breadcrumbs: {
        position: {
          align: 'right'
        }
      },
      series: [
        {
          name: "Minimus TR BOA",
          id: "Chrome",
          data: [
            [
              "v65.0",
              0.1
            ],
            [
              "v64.0",
              1.3
            ],
            [
              "v63.0",
              53.02
            ],
            [
              "v62.0",
              1.4
            ],
            [
              "v61.0",
              0.88
            ],
            [
              "v60.0",
              0.56
            ],
            [
              "v59.0",
              0.45
            ],
            [
              "v58.0",
              0.49
            ],
            [
              "v57.0",
              0.32
            ],
            [
              "v56.0",
              0.29
            ],
            [
              "v55.0",
              0.79
            ],
            [
              "v54.0",
              0.18
            ],
            [
              "v51.0",
              0.13
            ],
            [
              "v49.0",
              2.16
            ],
            [
              "v48.0",
              0.13
            ],
            [
              "v47.0",
              0.11
            ],
            [
              "v43.0",
              0.17
            ],
            [
              "v29.0",
              0.26
            ]
          ]
        },
      ]
    }
  });


</script>

</html>