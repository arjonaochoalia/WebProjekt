//TODO write code for deleting event


<?php
require 'db_connection.php';

$sql = "DELETE FROM events WHERE event_id = ?";
$stmt = $conn->prepare($sql);

$stmt->bind_param("i", $_POST['event_id']);

if ($stmt->execute()) {
    echo "Event deleted successfully!";
} else {
    echo "Error: " . $stmt->error;
}


$stmt->close();
$conn->close();
header("Location: events.php");

?>