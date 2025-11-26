<?php
require 'db_connection.php';

$sql = "DELETE FROM reviews WHERE review_id = ?";
$stmt = $conn->prepare($sql);

$stmt->bind_param("i", $_POST['review_id']);

if ($stmt->execute()) {
    echo "Review deleted successfully!";
} else {
    echo "Error: " . $stmt->error;
}


$stmt->close();
$conn->close();
header("Location: feedback.php");

?>