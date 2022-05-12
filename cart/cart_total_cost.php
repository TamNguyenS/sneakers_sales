<span style="color:red">
    <?php
    require_once'../admin/process_root/check_session.php';

    $total = 0;
    if (isset($_SESSION['cart'])) {
        $cart = $_SESSION['cart'];

        foreach ($cart as $value) {
            $total += $value['cost'] * $value['quantity']*(1-(int)$value['sale']/100);
        }
    }
    echo number_format($total, 0, '', ',');
   
    ?>

    ₫ </span>