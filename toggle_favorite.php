<?php
session_start();
require 'db_connection.php';

//exit if user not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$event_id = $_POST['event_id'];

// we check if the user already exists in the database
//by searching the user_events table for the user_id and event_id
//user_id we get from the session
//event_id we get from the form (the favorite button is in a form)

$stmt = $conn->prepare("SELECT * FROM user_events WHERE user_id = ? AND event_id = ?");
$stmt->bind_param("ii", $user_id, $event_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // if the results is bigger than 0, the user is already in the table
    $row = $result->fetch_assoc();

    if ($row['is_favorite'] == 1) {
        $new_status = 0;
    } else {
        $new_status = 1;
    }

    $update = $conn->prepare("UPDATE user_events SET is_favorite = ? WHERE user_id = ? AND event_id = ?");
    $update->bind_param("iii", $new_status, $user_id, $event_id);
    $update->execute();
} else {
    // User has no row, so add it with is_favorite = 1
    $insert = $conn->prepare("INSERT INTO user_events (user_id, event_id, is_favorite) VALUES (?, ?, 1)");
    $insert->bind_param("ii", $user_id, $event_id);
    $insert->execute();
}

header('Location: events.php');
exit;
