<?php
require 'db_connection.php'; // your DB connection

// Make sure user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "User not logged in.";
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch image path from database
$sql = "SELECT image_path FROM users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($image_path);
$stmt->fetch();
$stmt->close();
$conn->close();

// Check if user has an uploaded image
if (!empty($image_path) && file_exists($image_path)) {
    echo '<img src="' . htmlspecialchars($image_path) . '" alt="Profile Picture" class="img-fluid">';
} else {
    echo '<img src="profile_pictures/placeholder.jpg" alt="Default Profile Picture" class="img-fluid">';
}
