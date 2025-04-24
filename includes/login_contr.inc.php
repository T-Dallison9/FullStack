<?php

declare(strict_types=1);

//Check if input fields (Username and password) are empty
function is_input_empty(string $username, string $pwd): bool {
    return empty($username) || empty($pwd);  //Returns true if any input is empty
}

//Check if the username exists in the database
function is_username_wrong($result): bool {
    return !$result;  // Returns true if the result is invalid (i.e., username not found)
}

//Check if the provided password matches the hashed password from the database
function is_password_wrong(string $pwd, string $hashedpwd): bool {
    return !password_verify($pwd, $hashedpwd);  //Returns true if the passwords don't match
}
