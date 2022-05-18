<div class="col-3 filter-col" id="filter-col">

<div class="box" style="border-bottom: 1px solid rgb(207, 206, 206) ">
    <span class="filter-header filter-1" data-id="filter-1">
        <i class="fa-solid fa-angle-right"></i>&emsp; Danh mục sản phẩm
    </span>
    <ul class="filter-list" id="filter-1">
        <?php $query_type = "SELECT * FROM type";
        foreach (get_list($query_type) as $type) {
        ?>
            <li class="filter-product-type" data-name="<?= $type['name'] ?>" data-id="<?= $type['id'] ?>"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a><?= $type['name'] ?></a></li>
        <?php } ?>
    </ul>

</div>

<div class="box" style="border-bottom: 1px solid rgb(207, 206, 206) ">
    <span class="filter-header filter-2" data-id="filter-2">
        <i class="fa-solid fa-angle-right"></i>&emsp; Giá tiền
    </span>
    <ul class="filter-list" id="filter-2">
        <li>
            <div class="group-checkbox">
                <input type="checkbox" id="status1">
                <label for="status1">
                    <span style=" font: weight 300px;">Dưới 1,000,000₫</span>
                    <i class='bx bx-check'></i>
                </label>
            </div>
        </li>
        <li>
            <div class="group-checkbox">
                <input type="checkbox" id="status2">
                <label for="status2">
                    <span style=" font: weight 300px;">1tr -5,000,000₫</span>
                    <i class='bx bx-check'></i>
                </label>
            </div>
        </li>
        <li>
            <div class="group-checkbox">
                <input type="checkbox" id="status3">
                <label for="status3">
                    <span style=" font: weight 300px;">Dưới 10,000,000₫</span>
                    <i class='bx bx-check'></i>
                </label>
            </div>
        </li>
        <li>
            <div class="group-checkbox">
                <input type="checkbox" id="status4">
                <label for="status4">
                    <span style=" font: weight 300px;">Trên 10,000,000₫</span>
                    <i class='bx bx-check'></i>
                </label>
            </div>
        </li>
    </ul>

</div>

<div class="box" style="border-bottom: 1px solid rgb(207, 206, 206) ">
    <span class="filter-header filter-3" data-id="filter-3"> 
        <i class="fa-solid fa-angle-right"></i> &emsp;Thương hiệu
    </span>
    <ul class="filter-list" id="filter-3">
        <?php $query_type = "SELECT name FROM manufacture";
        foreach (get_list($query_type) as $type) {
        ?>
            <li class="filter-product-brand"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a ><?= $type['name'] ?></a></li>
        <?php } ?>


    </ul>

</div>

</div>


