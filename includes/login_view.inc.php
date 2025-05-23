<?php

declare(strict_types=1);

//Check and display any login errors stored in the session
function check_login_errors(): void {
    if (isset($_SESSION['errors_login'])) {
        $errors = $_SESSION['errors_login'];

        echo '<br>';
        foreach ($errors as $error) {
            echo '<p>' . $error . '</p>';
        }
        unset($_SESSION['errors_login']);
    } else if (isset($_GET['login']) && $_GET['login'] === 'success') {
        echo '<p>Login Success!</p>';
    }
}

//Output the username of the logged-in user
function output_username(): void {
    if (isset($_SESSION['user_id'])) {
        echo 'You are logged in as ' . $_SESSION['username'];
    } else {
        echo 'You are not logged in.';
    }
}
