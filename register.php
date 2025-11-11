<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
</head>

<body>

</body>

</html>


<?php

require 'db_connection.php'; // connect to database


if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $password = $_POST['password'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $role = 'user';

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    //save data in database
    //schema: user_id	username	first_name	last_name	email	user_password	user_role	created_at
    $sql = "INSERT INTO users (username, first_name, last_name, email, user_password, user_role) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $username, $first_name, $last_name, $email, $hashed_password, $role);

    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}

?>