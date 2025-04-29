<?php
require_once 'config_session.inc.php':

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $item_name = $_POST['item_name'];
    $action = $_POST['action'];

        foreach ($_SESSION['cart'] as $key => $item){
            if($item['product_name'] == $item_name){
                if ($action == "increase") {
                    $_SESSION['cart'][$key]['quantity'] += 1;
                } elseif ($action == "decrease" && $_SESSION['cart'][$key]['quantity'] > 1) {
                    $_SESSION['cart'][$key]['quantity'] -= 1;
                } elseif ($action == "decrease" && $_SESSION['cart'][$key]['quantity'] > 1) {
                    unset($_SESSION['cart'][$key]);
            }
            break;
        }
    }
}

header("Location: ../cart.php");
exit();
?>