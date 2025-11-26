<?php
require 'db_connection.php';

$event_id = $_POST['event_id'];

// we have to delete the entries in user_events table first
// before we can delete and event from event table
$deleteUserEvents = $conn->prepare("DELETE FROM user_events WHERE event_id = ?");
$deleteUserEvents->bind_param("i", $event_id);
$deleteUserEvents->execute();
$deleteUserEvents->close();

// delete the event
$deleteEvent = $conn->prepare("DELETE FROM events WHERE event_id = ?");
$deleteEvent->bind_param("i", $event_id);

if ($deleteEvent->execute()) {
    $deleteEvent->close();
    $conn->close();
    header("Location: events.php");
    exit;
} else {
    echo "Error: " . $deleteEvent->error;
    $deleteEvent->close();
    $conn->close();
}
