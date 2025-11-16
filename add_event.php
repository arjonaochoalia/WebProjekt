<?php
require 'db_connection.php';

if (isset($_POST['submit'])) {

    echo "debug: first if clause";
    $event_title = $_POST['title'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $event_date = $_POST['event_date'];
    $event_time = $_POST['event_time'];
    $admin_id = $_POST['admin_id'];

    // image upload
    $image_path = null;
    if (!empty($_FILES["image_path"]["name"])) {
        $image_path = "Bilder/" . uniqid() . "_" . $_FILES["image_path"]["name"];
        move_uploaded_file($_FILES["image_path"]["tmp_name"], $image_path);
    }

    // database entry
    $sql = "INSERT INTO events (admin_id, title, description, location, event_date, event_time, image_path, created_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issssss", $admin_id, $event_title, $description, $location, $event_date, $event_time, $image_path);

    echo "debug: after stmt";
    if ($stmt->execute()) {
        echo "Event added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
