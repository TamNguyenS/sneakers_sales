<ul class="pagination">
    <li><a href="#"><i class='bx bxs-chevron-left'></i></a></li>
    <?php for ($i = 1; $i <= $page_length; $i++) {
        if ($i == $page) { ?>
            <li><a class="active" href="#"><?php echo $i; ?></a></li>
        <?php } else { ?>
            <li><a href="./?&search=<?= $search ?>&page=<?=$i?>&type=<?=$type_id?>"        
            
            ><?= $i; ?></a></li>
    <?php
        }
    } ?>

    <li><a href="#"><i class='bx bxs-chevron-right'></i></a></li>
</ul>