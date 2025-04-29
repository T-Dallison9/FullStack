<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    require_once 'dbh.inc.php';

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    if (!empty($name) && !empty($message)) {
        $stmt = $pdo->prepare("INSERT INTO reviews (name, email, message) VALUES (?, ?, ?)");
        $stmt->execute([$name, $email, $message]);
    }

    header("Location: ../Contact.php");
    exit;
}
?>
