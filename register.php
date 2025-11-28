<?php
session_start();
require 'db_connection.php'; // connect to database
mysqli_report(MYSQLI_REPORT_OFF); // disable exceptions

if (isset($_POST['submit'])) {
    $username   = $_POST['username'];
    $email      = $_POST['email'];
    $password   = $_POST['password'];
    $first_name = $_POST['first_name'];
    $last_name  = $_POST['last_name'];
    $role       = 'user';

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Save data in database
    $sql = "INSERT INTO users (username, first_name, last_name, email, user_password, user_role) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $username, $first_name, $last_name, $email, $hashed_password, $role);

    if ($stmt->execute()) {
        // successfull registration --> redirect login page with success message
        $_SESSION['register_message'] = "Registration successful! Please log in.";
        header("Location: login_page.php");
        exit();
    } else {
        echo "error";
    }

    $stmt->close();
    $conn->close();
}
