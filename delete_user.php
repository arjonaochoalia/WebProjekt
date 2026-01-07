<?php
session_start();
require 'db_connection.php';

$sql = "DELETE FROM users WHERE user_id = ?";
$stmt = $conn->prepare($sql);

$stmt->bind_param("i", $_POST['user_id']);

if ($stmt->execute()) {
    $_SESSION['user_deleted_message'] = "User deleted successfully!";
    header("Location: profile.php");
    exit();
} else {
    echo "Error: " . $stmt->error;
}


$stmt->close();
$conn->close();
