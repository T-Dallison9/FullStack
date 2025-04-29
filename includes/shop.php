<?php
require_once 'header.php';

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
?>

<h2>Order Takeaway from The Skewerhouse</h2>

<section class="takeaway-section">
    <?php foreach($results as $row) { ?>
        <form action="/cart.inc.php" method="post" class="product-form">
            <label><strong><?= htmlspecialchars($row['name']) ?></strong></label><br>
            <span>£<?= htmlspecialchars($row['price']) ?></span><br>

            <input type="hidden" name="name" value="<?= htmlspecialchars($row['name']) ?>">
            <input type="hidden" name="price" value="<?= htmlspecialchars($row['price']) ?>">

            <label for="quantity">Qty:</label>
            <input type="number" name="quantity" value="1" min="1" required>

            <button type="submit">Add to Cart</button>
        </form>
    <?php } ?>
</section>

<hr>

<h2>Book a Table</h2>

<section class="booking-section">
    <form action="process-booking.php" method="post" class="booking-form">
        <label for="name">Full Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email Address:</label>
        <input type="email" id="email" name="email" required>

        <label for="booking_date">Date:</label>
        <input type="date" id="booking_date" name="booking_date" required>

        <label for="booking_time">Time:</label>
        <input type="time" id="booking_time" name="booking_time" required>

        <label for="guests">Number of Guests:</label>
        <input type="number" id="guests" name="guests" min="1" max="20" required>

        <label for="notes">Additional Notes (optional):</label>
        <textarea id="notes" name="notes" rows="4"></textarea>

        <button type="submit">Book Now</button>
    </form>
</section>

<?php require_once 'footer.php'; ?>
