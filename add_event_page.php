<?php
require 'db_connection.php';

// 1. Initialize variables
$event_title = $_POST['title'] ?? "";
$description = $_POST['description'] ?? "";
$location = $_POST['location'] ?? "";
$event_date = $_POST['event_date'] ?? "";
$event_time = $_POST['event_time'] ?? "";
$errorMessages = [];

// 2. Logic to handle the Form Submission
if (isset($_POST['submit'])) {
    $admin_id = $_POST['admin_id'];

    // VALIDATION
    if (empty($event_title)) {
        $errorMessages[] = "Please enter an event title.";
    }
    if (empty($description)) {
        $errorMessages[] = "Please provide a description.";
    }
    if (empty($location)) {
        $errorMessages[] = "Please enter a location.";
    }
    if (empty($event_date)) {
        $errorMessages[] = "Please select an event date.";
    }
    if (empty($event_time)) {
        $errorMessages[] = "Please select an event time.";
    }

    // 3. If there are NO errors, save to Database
    if (empty($errorMessages)) {
        $image_path = null;
        if (!empty($_FILES["image_path"]["name"])) {
            $image_path = "Bilder/" . uniqid() . "_" . $_FILES["image_path"]["name"];
            move_uploaded_file($_FILES["image_path"]["tmp_name"], $image_path);
        }

        $sql = "INSERT INTO events (admin_id, title, description, location, event_date, event_time, image_path, created_at)
                VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issssss", $admin_id, $event_title, $description, $location, $event_date, $event_time, $image_path);

        if ($stmt->execute()) {
            header("Location: events.php"); // Redirect when successfull
            exit();
        } else {
            $errorMessages[] = "Database error: " . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add new</title>
    <?php include "head_links.php" ?>
    <style>
        .error-text {
            color: red;
            font-size: 0.9em;
        }
    </style>
</head>

<body>
    <?php include 'nav.php'; ?>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-7">
                <?php if (isset($_SESSION['user_id']) && $_SESSION['user_role'] == 'admin'): ?>

                    <?php if (!empty($errorMessages)): ?>
                        <div class="alert alert-danger">
                            <?php foreach ($errorMessages as $msg) echo "<li>$msg</li>"; ?>
                        </div>
                    <?php endif; ?>

                    <form action="add_event_page.php" method="POST" enctype="multipart/form-data">

                        <div class="mb-3">
                            <label class="form-label">Event Title</label>
                            <input type="text" name="title" value="<?php echo htmlspecialchars($event_title); ?>" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="4"><?php echo htmlspecialchars($description); ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Location</label>
                            <input type="text" name="location" value="<?php echo htmlspecialchars($location); ?>" class="form-control">
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Event Date</label>
                                <input type="date" name="event_date" value="<?php echo htmlspecialchars($event_date); ?>" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Event Time</label>
                                <input type="time" name="event_time" value="<?php echo htmlspecialchars($event_time); ?>" class="form-control">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Event Image</label>
                            <input type="file" name="image_path" class="form-control">
                        </div>

                        <input type="hidden" name="admin_id" value="<?php echo $_SESSION['user_id'] ?>">
                        <button type="submit" name="submit" class="btn btn-success w-100">Save Event</button>
                    </form>
                <?php else: ?>
                    <p class="text-center">Please <a href="login_page.php">login</a> with an admin account.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php include "footer.php" ?>
</body>

</html>