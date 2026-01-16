<?php
session_start();
require 'db_connection.php';

//delete User
$deleteUser = $conn->prepare("DELETE FROM users WHERE user_id = ?");
$deleteUser->bind_param("i", $_POST['user_id']);

//if successful back to profile page
if ($deleteUser->execute()) {
    $_SESSION['user_deleted_message'] = "User deleted successfully!";
    $deleteUser->close();
    $conn->close();
    header("Location: profile.php");
    exit();
} else {
    echo "Error: " . $deleteUser->error;
}
