<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username_or_email = $_POST['username_or_email'];  //Adjusted variable name
    $pwd = $_POST['pwd'];

    try {

        require_once 'dbh.inc.php';
        require_once 'login_model.inc.php';
        require_once 'login_contr.inc.php';

        $errors = [];
        //If any functions return true (input is empty), add a message to the errors array
        if (is_input_empty($username_or_email, $pwd)) {
            $errors['empty_input'] = "Fill in all fields!";
        }

        $result = get_user($pdo, $username_or_email);

        if (is_username_wrong($result)) {
            $errors['login_incorrect'] = "Incorrect username or email";
        }

        if (!is_username_wrong($result) && is_password_wrong($pwd, $result['pwd'])) {
            $errors['login_incorrect'] = "Password is incorrect";
        }

        require_once 'config_session.inc.php';

        //If any errors were found, store them in the session and redirect
        if ($errors) {
            $_SESSION['errors_login'] = $errors;
            header("Location: ../index.php");
            die();
        }

        //Generate a new session ID based on the user’s unique ID from the database
        $newSessionId = session_create_id();
        $sessionId = $newSessionId . "_" . $result['id'];
        session_id($sessionId);

        //Store the user's ID in the session
        $_SESSION['user_id'] = $result['id'];

        //Store the user's username in the session
        $_SESSION['username'] = htmlspecialchars($result['Username']);

        //Store the time of the session regeneration
        $_SESSION['last_regeneration'] = time();

        //Redirect the user to the homepage with a success message
        header("Location: ../index.php?login=success");
        $pdo = null;
        $stmt = null;

        die();

    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }

} else {
    header("Location: ../index.php");
    die();
}
