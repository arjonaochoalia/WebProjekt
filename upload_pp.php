<?php
require 'db_connection.php';
session_start(); // make sure session is started

if (isset($_POST['submit'])) {

    // image upload
    $image_path = null;

    if (!empty($_FILES["image_path"]["name"])) {
        $user_id = $_SESSION['user_id'];
        $original_filename = basename($_FILES["image_path"]["name"]);
        $image_path = "profile_pictures/" . $user_id . "_profile_picture_" . $original_filename;

        move_uploaded_file($_FILES["image_path"]["tmp_name"], $image_path);
    }

    // add path to user in database
    $sql = "UPDATE users 
            SET image_path = ? 
            WHERE user_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $image_path, $_SESSION['user_id']);

    if ($stmt->execute()) {
        header("Location: profile.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
