<?php

declare(strict_types=1);

//Fetch user details based on username or email
function get_user(object $pdo, string $username_or_email): ?array {
    $query = "SELECT * FROM users WHERE Username = :username_or_email OR email = :username_or_email;";


    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':username_or_email', $username_or_email);
    $stmt->execute();

    //Fetch and return the result from the query
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result ?: null;  //Return null if no user is found
}
