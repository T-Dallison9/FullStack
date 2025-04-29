<?php

require_once 'config_session.inc.php';
require_once 'dbh.inc.php'

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $userId = $_SESSION['user_id'];
    $total = $_POST['totalPrice'];

    try{
        $pdo->beginTransaction();

        $totalOrder = "INSERT INTO order (total, users_id) VALUES (:total, :users_id);";

        $stmt = $pdo->prepare($totalOrder);

        $stmt->bindParam(":total", $total);
        $stmt->bindParam(":users_id", $userId);

        $stmt->execute();

        $orderID = $pdo->lastInsertId();

        foreach ($_SESSION['cart'] as $key => $value) {

            $product_name = $value['product_name'];
            $price = $value['price'];
            $quantity = $value['quantity'];

            $query = "INSERT INTO purchases (item, price, quantity, users_id, order_id) VALUES
            (:item, :price, :quantity, :users_id, :order_id);";

            $stmt = $pdo->prepare($query);

            $stmt->bindParam(":item", $product_name);
            $stmt->bindParam(":item", $price);
            $stmt->bindParam(":item", $quantity);
            $stmt->bindParam(":item", $userId);
            $stmt->bindParam(":order_id", $orderId);
            $stmt->execute();
        }

        $pdo->commit();
    

        $pdo = null;
        $stmt = null;

        header("Location:../shop.php?booking=success");
            unset($_SESSION['cart']);
            die();

    }

    catch (PDOException $e){
        $pdo->rollack();
        die("Order failed: " . $e->getMessage());
    }


}