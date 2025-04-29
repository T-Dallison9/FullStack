<?php

require_once 'header.php';
require_once 'footer.php';

if(!isset($_SESSION['user_id'])) {
    header("Location: index.php");
}

    $userId = $_SESSION['user_id'];

    try{

        require_once 'dbh.inc.php';
        require_once 'order_model.inc.php';

        $results = search_orders($pdo, $userId);

        $pdo = null;
        $stmt = null;

    } catch (PDOException $e){
        die("Query Failed: " . $e->getMessage());
    }

?>

<head>
    <title><?= $_SESSION['user_username'] ?> Orders</title>
</head>

<h1>Orders</h1>

<?php

if(empty($results)){
    echo 'You have no orders';
} else {
    foreach ($results as $result){

        $timeAsNotString = strtotime($result['order_date']);
        $formatteddate = date("l j F Y", $timeAsNotString);
        $formattedtime = date("h:i A", $timeAsNotString); ?>

        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Total price</th>
                    <th>Date</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= htmlspecialchars($result['id']);?></td>
                    <td><?= htmlspecialchars($result['total']);?></td>
                    <td><?= $formatteddate ." ". $formattedtime?></td>
                    <td><form action="order_details.php" method="post">
                        <input type="hidden" name="orderId" value=<?= $result['id']?>>
                        <button>View Order Details</button>
    </form>
    </td>
    </tr>
    </body>

    </table>

    <form action="order_delete.inc.php" method="post">
        <input type="hidden" name="orderId" value=<?= $result['id']?>>
        <button>Cancel Order</button>
    </form>
    <br>
    <?php
    }
}