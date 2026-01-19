<?php
session_start();
require 'db_connection.php';

//delete review
$deleteReview = $conn->prepare("DELETE FROM reviews WHERE review_id = ?");
$deleteReview->bind_param("i", $_POST['review_id']);

// if successful back to review page
if ($deleteReview->execute()) {
    // Set success message in session
    $_SESSION['review_deleted_message'] = "Review deleted successfully!";
    $deleteReview->close();
    $conn->close();
    header("Location: feedback.php");
    exit();
} else {
    echo "Error: " . $deleteReview->error;
    $deleteReview->close();
    $conn->close();
}
