<?php
require 'db_connection.php';

if (isset($_POST['submit_review']) && isset($_SESSION['user_id'])) {

    $user_id = $_SESSION['user_id'];
    $content = trim($_POST['review_content']);
    $rating = (int)$_POST['rating']; // cast to integer

    if (!empty($content) && $rating >= 1 && $rating <= 5) {
        $sql = "INSERT INTO reviews (user_id, content, rating, created_at) VALUES (?, ?, ?, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isi", $user_id, $content, $rating);

        if ($stmt->execute()) {
            header("Location: feedback.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Please enter a review and select a valid rating (1-5).";
    }
}


$conn->close();
