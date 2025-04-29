<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'dbh.inc.php';

    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $date = $_POST['booking_date'];
    $time = $_POST['booking_time'];
    $guests = (int) $_POST['guests'];
    $notes = htmlspecialchars(trim($_POST['notes']));

    if (!$name || !$email || !$date || !$time || !$guests) {
        die("Missing required fields.");
    }

    try {
        $sql = "INSERT INTO bookings (name, email, booking_date, booking_time, guests, notes)
                VALUES (:name, :email, :booking_date, :booking_time, :guests, :notes)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':booking_date' => $date,
            ':booking_time' => $time,
            ':guests' => $guests,
            ':notes' => $notes
        ]);

        echo "Booking successful. We look forward to seeing you.";
    } catch (PDOException $e) {
        die("Booking failed: " . $e->getMessage());
    }
} else {
    header("Location: services.php");
    exit;
}
