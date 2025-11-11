<?php
require 'db_connection.php'; // connect to database

if (isset($_POST['submit'])) {
    echo "debug: if clause..";
    $email    = $_POST['email'];
    $password = $_POST['password'];

    //SQL
    $sql = "SELECT user_password FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $stmt->bind_result($stored_hash);
    $fetch_success = $stmt->fetch();
    $stmt->close();
    $conn->close();

    //check if we were able to get the password hash from the database
    if (!$fetch_success) {
        $stored_hash = null;
    }

    //check if the password matches the hashed password in the database
    if ($stored_hash == null) {
        echo "Email or password incorrect!";
    } else {
        if (password_verify($password, $stored_hash)) {
            echo "Login was successful.";
            $_SESSION["email"] = $email;

            // Redirect to home page
            header("Location: /Webprojekt/index.php");
            exit;
        } else {
            echo "Invalid password.";
        }
    }
}
