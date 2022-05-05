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
    .fillter-orders {
      margin-top: 10px;
    }
  </style>
  <style>
    @import "https://code.highcharts.com/css/highcharts.css";

    .highcharts-pie-series .highcharts-point {
      stroke: #ede;
      stroke-width: 2px;
    }

    .highcharts-pie-series .highcharts-data-label-connector {
      stroke: silver;
      stroke-dasharray: 2, 2;
      stroke-width: 2px;
    }

    .highcharts-figure,
    .highcharts-data-table table {
      min-width: 320px;
      max-width: 600px;
      margin: 1em auto;
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
     .small{
      height:40px;
      width: 40px;
    }
   td:first-child {
       width: 40px;

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
      <div class="container">
        <div class="tag-name">
          <a href="./index.php">
            <h2> <span class="fa fa-arrow-circle-left"></span> Thống kê</h2>
            <br>

          </a>
        </div>
      </div>
      <main>
        <div class="cards" style="margin-top:-5px; margin-bottom: 10px;  margin-left: 100px;  grid-template-columns: repeat(5, 1fr);">

          <div class="card-single">
            <div>
              <h1> 15</h1>
              <span>Tổng số sản phẩm </span>
            </div>
            <div class="card-icon" style="background-color: rgb(252, 242, 210);">
              <span class="fa-solid fa-store" style="color: rgb(248, 225, 52)"></span>
            </div>
          </div>

          <div class="card-single">
            <div>
              <h1> 13</h1>
              <span>Sản phẩm mới trong tháng</span>
            </div>
            <div class="card-icon" style="  background-color: rgb(221, 230, 254);">
              <span class="fa-solid fa-file-invoice-dollar" style=" color: rgb(30, 90, 255);"></span>

            </div>
          </div>
          <div class="card-single">
            <div>
              <h1> 13</h1>
              <span>Số lượng sản phẩm hiện có</span>
            </div>
            <div class="card-icon" style="background-color: rgb(249, 219, 237);">
              <span class="fa-solid fa-shoe-prints" style="color: rgb(252, 64, 176);"></span>
            </div>
          </div>
          <div class="card-single">
            <div>
              <h1> 13</h1>
              <span>Số sản phẩm đã bán đi</span>
            </div>
            <div class="card-icon" style="background-color: #ffe9ed;">

              <span class="fa-brands fa-shopify" style="color: #f3272a;"></span>

            </div>
          </div>

        </div>
        <div class="container-row1">
          <div class="chart-product-detail">
            <h1><i class="fa-solid fa-chart-area"></i>&nbsp;&nbsp;Biểu đồ số lượng sản phẩm theo nhà cung cấp</h1>
            <div class="chart-product">

              <!-- <figure class="highcharts-figure"> -->
              <div id="container"></div>

              <!-- </figure> -->
            </div>

          </div>
          <div class="product-bestseler">
            <h1><i class="fa-brands fa-sellsy"></i>&nbsp;&nbsp;Top sản phẩm bán chạy</h1>
            <div class="fillter">

              <i class="fa-solid fa-sort"></i>&nbsp;

              <select class="fillter-orders" name="statusorder" id="statusorder">

                <option disabled selected value="">Tháng này </option>
                <option value="2">Năm này</option>
                <option value="1">Ngày này</option>
              </select>
            </div>
            <div class="content-bestseler">
              <table>

                <tr>
                  <td>
                    <div class="card-icon small" style="background-color: #ffe9ed;"><span style="color: #f3272a;">1</span>
                    </div>
                  </td>
                  <td>Best</td>
                  <td>Best</td>
                </tr>
                <tr>
                  <td>
                    <div class="card-icon small" style="background-color: #ffe9ed;"><span style="color: #f3272a;">1</span>
                    </div>
                  </td>
                  <td>Best</td>
                  <td>Best</td>
                </tr>
              </table>
            </div>
          </div>
        </div>
        <div class="container-row2">
          <h1><i class="fa-solid fa-receipt"></i>&nbsp; Thông tin kho hàng </h1>
        </div>

      </main>
    </div>
  </div>

</body>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script>
  Highcharts.chart('container', {

    chart: {
      styledMode: true
    },
    credits: {
      enabled: false
    },
    title: {
      text: ''
    },

    xAxis: {
      categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
    },

    series: [{
      type: 'pie',
      allowPointSelect: true,
      keys: ['name', 'y', 'selected', 'sliced'],
      data: [

        <?php
        $max = 0;
        $min = 0;
        foreach ($records as $record) {
          if ((float)$record['total'] > $max) {
            $max = $record['total'];
            echo "['" . $record['name'] . "', " . $record['total'] . ", true,true],";
          } else {
            echo "['" . $record['name'] . "', " . $record['total'] . ", false],";
          }
        }
        ?>
      ],
      showInLegend: true
    }]
  });
</script>

</html>