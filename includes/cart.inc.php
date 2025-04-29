<?php

require_once 'config_session.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['name'], $_POST['price'], $_POST['quantity'])) {

        $product_name = $_POST['name'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

        $session_array_id = array_column($_SESSION['cart'], "name");

        if (in_array($product_name, $session_array_id)) {
            foreach ($_SESSION['cart'] as $key => $value) {
                if ($value['name'] == $product_name) {
                    $_SESSION['cart'][$key]['quantity'] += $quantity;
                }
            }
        } else {
            $session_array = array(
                'name' => $product_name,
                'price' => $price,
                'quantity' => $quantity
            );
            $_SESSION['cart'][] = $session_array;
        }

        header("Location: ../shop.php");
        exit();
    } else {
        echo "Missing product data!";
    }
}
