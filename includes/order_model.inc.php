<?php

function search_order(object $pdo, int $userId){
    $query = "SELECT * FROM orders WHERE users_id = :aUser_Id;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':aUser_Id', $userId);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}
function search_orders_details(object $pdo, int $orderId){
    $query = "SELECT * FROM purchases WHERE order_id = :order_id;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':order_id', $orderId);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}
function delete_order(object $pdo, int $orderId){
    $query = "DELETE * FROM orders WHERE id = :orderId;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':orderId', $orderId);
    $stmt->execute();

}