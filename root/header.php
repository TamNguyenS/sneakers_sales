<div class="header-wrapper" id="header-wrapper"><span class="mb-menu-toggle mb-menu-close" id="mb-menu-close"><i class='bx bx-x'></i></span>

    <div class="bg-main">

        <div class="mid-header container"> <a href="../product/"><img style="width:180px" src="https://file.hstatic.net/200000346037/file/toptokago_b47efd92e9634fac8ed8e2583d341e60.png"></a>


            <?php $search = empty($_GET['search']) ? '' : $_GET['search'];
            $search = validate($search); ?>

            <form method="get" action="">

                <div class="search">



                    <input placeholder="search" name="search" type="search" value="<?php echo  $search ?>">




                </div>
            </form>



            <ul class="user-menu">
                <li><a href="#"><i class='bx bx-bell'></i></a></li>

                <li class="click-user"><a href="#"><i class='bx bx-user-circle'></i></a></li>

                <li class="click-cart"><a href="#"><i class='bx bx-cart'></i></a></li>
                <span class="count"><?php
                                    $total = 0;
                                    if (isset($_SESSION['cart'])) {
                                        $cart = $_SESSION['cart'];
                                        foreach ($cart as $value) {
                                            $total += $value['quantity'];
                                        }
                                    }
                                    echo $total;
                                    ?></span>
            </ul>
        </div>

    </div>

    <div class="bg-second">
        <div class="bottom-header container">

            <div class="logo-bottom"><img style="width:180px;" src="https://file.hstatic.net/200000346037/file/toptokago_b47efd92e9634fac8ed8e2583d341e60.png"></div>
            <div class="mobi-nav">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </div>
            <ul class="main-menu ">

                <li><a href="#">home</a></li>

                <li class="mega-dropdown"><a href="./products.html">Sản phẩm<i class='bx bxs-chevron-down'></i></a>
                    <span class="bar"></span>
                    <div class="mega-content">
                        <div class="row">
                            <div class="cmd-12">
                                <div class="box">
                                    <h3>Danh mục sản phẩm</h3><span></span>
                                    <div class="animation">
                                        <ul class="">
                                            <li><a href="#">Tất cả sản phẩm</a>
                                            </li>
                                            <?php $query_type = "SELECT name FROM type";
                                            foreach (get_list($query_type) as $type) {
                                            ?><li><a href="#"><?= $type['name'] ?></a></li><?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>

                <li><a href="#">Hướng dẫn</a></li>
                <li class="mega-dropdown active-menu"><a href="./products.html">Thương hiệu<i class='bx bxs-chevron-down'></i></a>
                    <div class="mega-content active-menu">
                        <div class="row">
                            <div class="cmd-12">
                                <div class="box">
                                    <h3>Danh mục sản phẩm</h3><span></span>
                                    <div class="animation">
                                        <ul class=""><?php $query_type = "SELECT name FROM manufacture";
                                                        foreach (get_list($query_type) as $type) {
                                                        ?><li><a href="#"><?= $type['name'] ?></a></li><?php } ?></ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li><a href="#">Về Hikky</a></li>
            </ul>
            <div class="cart-second">
                <ul class="user-menu">
                    <li><a href=""><i class='bx bx-bell'></i></a></li>
                    <li class="click-user"><i class='bx bx-user-circle'> </i></li>
                    <li class="click-cart"><i class='bx bx-cart'></i></li>
                    <span class="count2"><?php echo $total; ?></span>
                </ul>



            </div>


        </div>

    </div>

</div>
<div class="main-menu-mobile active-menu">
    <div class="close-moblie">
        <i class="fa-solid fa-xmark"></i>
    </div>
    <br>
    <ul class="nav1">
        <li rel-script="mega-menu" class="nav__item"><a href="./" style="color: rgb(255, 49, 2);">
                HOME
            </a></li>

        <li class="nav__item nav__item--has-child" id="navv"><a class="">
                SẢN PHẨM
                <i class="fa-solid fa-angle-right" id ="_btn" style="margin-left: 170px"></i>
            </a>

            <ul class="nav-child-menu" style="display: none;  transition: all 0.5s ease-in-out;">

                <li><a href="#">Tất cả sản phẩm</a>
                </li>
                <?php $query_type = "SELECT name FROM type";
                foreach (get_list($query_type) as $type) {
                ?><li><a href="#"><?= $type['name'] ?></a></li><?php } ?>

            </ul>
        <li rel-script="mega-menu" class="nav__item"><a href="./">
                HƯỚNG DẪN
            </a></li>
        <li rel-script="mega-menu" class="nav__item"><a href="./">
                VỀ HIKKY
            </a></li>
        </li>
    </ul>

</div>
<!-- <script>
    let menu = document.getElementById('navv');
    memu.addEventListener("click", function() {
        document.getElementById("_btn").classList.toggle("rotation");
        document.querySelector('.nav-child-menu').style.display = "block";
    });
</script> -->