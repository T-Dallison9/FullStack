<?php

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $orderId = $_POST['orderId'];

    try{

        require_once 'dbh.inc.php';
        require_once 'order_model.inc.php';

        delete_order($pdo, $orderId);

        $pdo = null;
        $stmt = null;

        header("Location: ../order.php?order=delete");

        die();
    } catch (PDOException $e){
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location: ../order.php");
    die();
}