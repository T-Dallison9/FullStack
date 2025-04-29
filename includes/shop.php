<?php

require_once 'header.php';
require_once 'footer.php';

try {
    require_once 'dbh.inc.php';

    $query = "SELECT * FROM products";

    $stmt = $pdo->prepare($query);

    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $pdo = null;
    $stmt = null;

} catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
}

foreach($results as $row) { ?>
    <form action="/cart.inc.php" method="post">
        <label><?= htmlspecialchars($row['name']) ?></label><br>

        <!-- Hidden input for product name -->
        <input type="hidden" name="name" value="<?= htmlspecialchars($row['name']) ?>">

        <!-- Hidden input for product price -->
        <input type="hidden" name="price" value="<?= htmlspecialchars($row['price']) ?>">

        <!-- Input for quantity -->
        <input type="number" name="quantity" value="1" min="1" required>

        <button type="submit">Add to cart</button>
    </form>
<?php } ?>
