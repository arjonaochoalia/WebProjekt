<?php
require 'db_connection.php';

$deleteReview = $conn->prepare("DELETE FROM reviews WHERE review_id = ?");
$deleteReview->bind_param("i", $_POST['review_id']);

// if successful back to review page
if ($deleteReview->execute()) {
    $deleteReview->close();
    $conn->close();
    header("Location: feedback.php");
} else {
    echo "Error: " . $deleteReview->error;
    $deleteReview->close();
    $conn->close();
}
