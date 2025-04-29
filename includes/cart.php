<?php
require_once 'header.php';
require_once 'config_session.inc.php';

$total = 0;
if(!isset ($_SESSION['cart'])) {
    echo '<p>there is nothing in your cart</p>';
}

else{

    foreach ($_SESSION['cart'] as $key => $value) { ?>

        <p><?= $value['name']?></p>
        <p><?= $value['price']?></p>
        <p><?= $value['quantity']?></p>

        <?php

        $total += $value['price'] * $value['quantity'];

        ?>

        <form method="post" action="cart_update.inc.php">
            <input type="hidden" name="item_name" value="<?=$value['name']?>">
            <button type="submit" name="action" value="decrease">-</button>
            <button type="submit" name="action" value="increase">+</button>
        </form>

    <?php   }    
    
    if (isset($_POST['empty_cart'])) {
        unset($_SESSION['cart']);
        header("Location: cart.php");
    }

    echo $total;

    ?>

    <form method="post" action="purchase.inc.php">
        <input type="hidden" name="totalPrice" value="<?=$total?>">
        <button>Buy</button>
    </form>

    <form method="post" action="cart.php">
        <input type="hidden" name="empty_cart">
        <button>Empty Cart</button>
</form>

<?php } ?>
