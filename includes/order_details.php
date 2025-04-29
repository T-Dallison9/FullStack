<?php
require_once 'header.php'

if(!isset($_SESSION['user_id'])){
    header("Location: index.php");
}
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $orderId = $_POST['orderId'];

    try{

        require_once 'includes/dbh.inc.php';
        require_once 'includes/order_model.inc.php';

        $results = search_orders_details($pdo, $orderId);

        $pdo = null;
        $stmt = null;
    } catch (PDOException $e){
        die("Query failed: " . $e->getMessage());
    }
}
?>
<head>
    <title><?= $_SESSION['user_username'] ?> Orders Details</title>
</head>

<h1>Order Details</h1>

<?php

if(empty($results)){
    echo 'You have no orders';
} else { ?>
    <table>
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Item</th>
            <th>Price</th>
            <th>Quantity</th>
        </tr>
    </thead>
    <tbody>

    <?php foreach($results as $result){
        ?>
        <tr>
                <td><?= htmlspecialchars($result['order_id']);?></td>
                <td><?= htmlspecialchars($result['item']);?></td>
                <td><?= htmlspecialchars($result['price']);?></td>
                <td><?= htmlspecialchars($result['quantity']);?></td>
        </tr>
    <?php } ?>
    </tbody>

    </table>
    <a href="order.php"><button>Back to Orders</button></a>

<?php }