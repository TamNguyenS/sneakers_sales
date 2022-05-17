<div class="row products-d" id="products">

<?php foreach ($records as $record) {

    $id = $record['id'];
    $query_img = "SELECT img FROM product_img WHERE product_id =  $id ";
    $get_list_img = get_list($query_img);
?>
    <div class="col-4 showimg">
        <div class="product-card">
            <?php
            $this_day = date('d');
            $this_month = date('m');
            $product_day = (int)$record['day'];
            $product_month = (int)$record['month'];
            if ((int)$this_month == $product_month) {
                echo '
                <div class="discount">
                 <p>New</p>
                </div>
            ';
            }
            if ($record['sale'] != null) {
                echo '
            <div class="discount blue">
             <p>Sale</p>
            </div>
        ';
            }
            ?>
            <!-- <div class="discount">
                <p>New</p>
            </div> -->
            <div class="sale">
                <p>- <?php
                        if ($record['sale'] == null) echo 0;
                        echo $record['sale'];

                        ?>%</p>
            </div>
            <div class="product-card-img">
                <picture>
                    <img src="../admin/photos/<?= $get_list_img[0]['img'] ?>" alt="">
                </picture>
                <picture>
                    <img src="../admin/photos/<?= $get_list_img[1]['img'] ?>" alt="">
                </picture>


            </div>
            <div class="product-card-info">
                <div class="product-btn">
                    <a href="../productdetail/?id=<?= $record['id'] ?>" class="btn-flat btn-hover btn-shop-now">Chi tiết </a>

                    <button class="btn-flat btn-hover btn-cart-add btn-cart-add-to" id="cart-add-id" value="<?= $record['id'] ?>">
                        <i class='bx bxs-cart-add'></i>
                    </button>


                    <button class="btn-flat btn-hover btn-cart-add">
                        <i class='bx bxs-heart'></i>
                    </button>
                </div>
                <div class="product-card-name">
                    <?= $record['name'] ?>
                </div>
                <div class="product-card-price">
                    <span><del><?php echo number_format($record['cost'], 0, '', ','); ?></del></span>
                    <br>
                    <span class="curr-price"><?php
                                                $discount = (int)$record['sale'];
                                                $cost = (float) $record['cost'] * (1 - $discount / 100);

                                                echo number_format($cost, 0, '', ','); ?> <span class="cost">đ</span></span>

                </div>
            </div>
        </div>
    </div>
<?php } ?>
</div>