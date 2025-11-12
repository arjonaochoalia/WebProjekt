<?php
session_start(); 

require 'db_connection.php'; // database connection

if (isset($_POST['submit'])) {
    $email    = $_POST['email'];
    $password = $_POST['password'];

    // fetch data from database
    $sql = "SELECT user_id, first_name, last_name, user_role, user_password 
            FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    // bind results
    $stmt->bind_result($user_id, $first_name, $last_name, $user_role, $stored_hash);
    $fetch_success = $stmt->fetch();
    $stmt->close();
    $conn->close();

    if (!$fetch_success) {
        echo "Email or password incorrect!";
    } else {
        if (password_verify($password, $stored_hash)) {

            $_SESSION['user_id']    = $user_id;
            $_SESSION['first_name'] = $first_name;
            $_SESSION['last_name']  = $last_name;
            $_SESSION['user_role']  = $user_role;
            $_SESSION['email']      = $email;

            // Redirect to home page
            header("Location: /Webprojekt/index.php");
            exit;
        } else {
            echo "Invalid password.";
        }
    }
}
?>
