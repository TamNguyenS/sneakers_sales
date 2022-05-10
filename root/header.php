<div class="header-wrapper" id="header-wrapper"><span class="mb-menu-toggle mb-menu-close" id="mb-menu-close"><i class='bx bx-x'></i></span>

    <div class="bg-main">
        <div class="mid-header container"><img style="width:180px" src="https://file.hstatic.net/200000346037/file/toptokago_b47efd92e9634fac8ed8e2583d341e60.png">
            <div class="search"><input type="text" placeholder="Search"><i class='bx bx-search-alt'></i></div>
            <ul class="user-menu">
                <li><a href="#"><i class='bx bx-bell'></i></a></li>

                <li class="click-user"><a href="#"><i class='bx bx-user-circle'></i></a></li>
                <li class="click-cart"><a href="#"><i class='bx bx-cart'></i></a></li>
                <span class="count">0</span>
            </ul>
        </div>
    </div>

    <div class="bg-second">
        <div class="bottom-header container">
            <ul class="main-menu">
                <div class="logo-bottom"><img style="width:180px;" src="https://file.hstatic.net/200000346037/file/toptokago_b47efd92e9634fac8ed8e2583d341e60.png"></div>
                <li><a href="#">home</a></li>

                <li class="mega-dropdown"><a href="./products.html">Sản phẩm<i class='bx bxs-chevron-down'></i></a>
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
                <li class="mega-dropdown"><a href="./products.html">Thương hiệu<i class='bx bxs-chevron-down'></i></a>
                    <div class="mega-content">
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
                    <span class="count2">0</span>
                </ul>
            </div>

        </div>
    </div>

</div>