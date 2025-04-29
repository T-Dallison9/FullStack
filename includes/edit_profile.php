<?php
session_start();
require_once 'dbh.inc.php';

//Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

//Update logic
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_username = trim($_POST['username']);
    $new_email = trim($_POST['email']);
    $new_password = $_POST['password'];

    if (!empty($new_password)) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $query = "UPDATE users SET Username = ?, email = ?, pwd = ? WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$new_username, $new_email, $hashed_password, $user_id]);
    } else {
        $query = "UPDATE users SET Username = ?, email = ? WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$new_username, $new_email, $user_id]);
    }

    $success = "Account updated successfully!";
}

// Fetch current user data
$query = "SELECT Username, email FROM users WHERE id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Account</title>
    <link rel="stylesheet" href="Styles.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Your Account</h2>
        <?php if (isset($success)): ?>
            <div class="alert alert-success"><?= $success ?></div>
        <?php endif; ?>
        <form method="POST" class="form-box">
            <div class="mb-3">
                <label>Username:</label>
                <input type="text" name="username" class="form-input" value="<?= htmlspecialchars($user['Username']) ?>" required>
            </div>
            <div class="mb-3">
                <label>Email:</label>
                <input type="email" name="email" class="form-input" value="<?= htmlspecialchars($user['email']) ?>" required>
            </div>
            <div class="mb-3">
                <label>New Password (leave blank to keep current):</label>
                <input type="password" name="password" class="form-input">
            </div>
            <button type="submit" class="form-btn">Update</button>
        </form>
    </div>
</body>
</html>
