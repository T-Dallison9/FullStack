<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $_POST['username'];
    $pwd = $_POST['pwd'];

    try {

        // Include necessary files
        require_once 'includes/dbh.inc.php';    // Database connection
        require_once 'includes/login_model.inc.php';  // Model functions
        require_once 'includes/login_contr.inc.php';  // Controller functions
        require_once 'includes/config_session.inc.php'; // Session handling

        // Initialize error array
        $errors = [];

        // Check for empty inputs (username and password)
        if (is_input_empty($username, $pwd)) {
            $errors['empty_input'] = "Fill in all fields!";
        }

        // Get user by username or email (PDO query)
        $stmt = $pdo->prepare("SELECT id, username, pwd FROM users WHERE username = :username OR email = :email");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':email', $username, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if username exists
        if (is_username_wrong($result)) {
            $errors['login_incorrect'] = "Incorrect username";
        }

        // Check if password matches
        if (!is_username_wrong($result) && is_password_wrong($pwd, $result['pwd'])) {
            $errors['login_incorrect'] = "Password is wrong";
        }

        // If errors are present, store in session and redirect to the homepage
        if ($errors) {
            $_SESSION['errors_login'] = $errors;
            header("Location: ../index.php");
            exit();  // Always use exit after header redirect
        }

        // Session management - create new session ID and store user details
        $newSessionId = session_create_id();
        $sessionId = $newSessionId . "_" . $result['id'];
        session_id($sessionId); // Update the session ID

        $_SESSION['user_id'] = $result['id'];  // Store user ID
        $_SESSION['user_username'] = htmlspecialchars($result['username']);  // Store username

        // Store time of last session regeneration
        $_SESSION['last_regeneration'] = time();

        // Redirect with success message in URL
        header("Location: ../index.php?login=success");
        exit();  // Always use exit after header redirect

    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }

} else {
    // Redirect if the form is not submitted correctly
    header("Location: ../index.php");
    exit();
}

?>
