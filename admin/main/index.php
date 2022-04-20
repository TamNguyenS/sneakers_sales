<?php
require_once '../root/checklogin.php' 
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
    <script src="../js/mf.js"></script>
    <!-- icon -->
    <script src="https://kit.fontawesome.com/945e1fd97f.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/font-awesome-line-awesome/css/all.min.css">
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
      Comming soon...
    </div>
  </div>

</body>

</html>