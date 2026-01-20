<?php
// =================================================================
// PHP LOGIC
// =================================================================

// Start session safely
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require 'db_connection.php';

// Initialize variables used for events
$event_title = "";
$description = "";
$location = "";
$event_date = "";
$event_time = "";
$errorMessages = [];
$successMessage = "";

// Handle Form Submission
if (isset($_POST['submit_event'])) {

    // Security: Only admins can post
    if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'admin') {
        header("Location: login.php");
        exit();
    }

    $admin_id = $_SESSION['user_id'];
    $event_title = trim($_POST['title'] ?? "");
    $description = trim($_POST['description'] ?? "");
    $location = trim($_POST['location'] ?? "");
    $event_date = $_POST['event_date'] ?? "";
    $event_time = $_POST['event_time'] ?? "";

    // Validation
    if (empty($event_title)) $errorMessages[] = "Please enter an event title.";
    if (empty($description)) $errorMessages[] = "Please provide a description.";
    if (empty($location))    $errorMessages[] = "Please enter a location.";
    if (empty($event_date))  $errorMessages[] = "Please select an event date.";
    if (empty($event_time))  $errorMessages[] = "Please select an event time.";

    // Add event in database if no errors
    if (empty($errorMessages)) {
        $image_path = null;
        if (!empty($_FILES["image_path"]["name"])) {
            $image_path = "Bilder/" . uniqid() . "_" . basename($_FILES["image_path"]["name"]);
            move_uploaded_file($_FILES["image_path"]["tmp_name"], $image_path);
        }

        $add_event = $conn->prepare("INSERT INTO events (admin_id, title, description, location, event_date, event_time, image_path, created_at)
                VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");
        $add_event->bind_param("issssss", $admin_id, $event_title, $description, $location, $event_date, $event_time, $image_path);

        if ($add_event->execute()) {
            // Set success message in session
            $_SESSION['success_event_message'] = "Event created successfully!";
            $add_event->close();
            header("Location: events.php");
            exit();
        } else {
            $errorMessages[] = "Database error: " . $add_event->error;
        }
    }
} // Handle Form Submission End
?>

<!-- =================================================================
// HTML STRUCTURE
// ================================================================= -->

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Events</title>
    <?php include 'head_links.php'; ?>
</head>

<body>
    <?php include 'nav.php' ?>

    <div class="container mt-4">

        <!-- "Event deleted" alert message-->
        <?php if (isset($_SESSION['event_deleted_message'])): ?>
            <div class="alert alert-success">
                <?= $_SESSION['event_deleted_message'] ?>
            </div>
            <?php unset($_SESSION['event_deleted_message']); ?>
        <?php endif; ?>

        <!-- "Event added" alert message-->
        <?php if (isset($_SESSION['success_event_message'])): ?>
            <div class="alert alert-success">
                <?= $_SESSION['success_event_message'] ?>
            </div>
            <?php unset($_SESSION['success_event_message']); ?>
        <?php endif; ?>


        <!-- "Create New Event"-form for admins -->
        <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>

            <!-- Button to fold form in and out -->
            <div class="text-center mb-4">
                <button class="btn btn-secondary"
                    type="button"
                    data-toggle="collapse"
                    data-target="#createEventForm"
                    aria-expanded="<?= !empty($errorMessages) ? 'true' : 'false' ?>"
                    aria-controls="createEventForm">
                    <i class="fa-solid fa-plus-circle"></i> Create New Event
                </button>
            </div>

            <!-- Collapsible Form -->
            <div class="collapse mb-5 <?php if (!empty($errorMessages)) echo 'show'; ?>" id="createEventForm">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-10 col-lg-8">
                        <div class="card shadow-sm border border-2 border-secondary">
                            <div class="card-header bg-primary text-white">
                                <h4 class="m-0">Create New Event</h4>
                            </div>

                            <div class="card-body">
                                <!-- error messages incase of invalid form -->
                                <?php if (!empty($errorMessages)): ?>
                                    <div class="alert alert-danger">
                                        <ul class="mb-0 pl-3">
                                            <?php foreach ($errorMessages as $msg): ?>
                                                <li><?= $msg ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>

                                <!-- "Create Event" form information -->
                                <form action="events.php" method="POST" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label for="event_title" class="form-label fw-bold">Event Title</label>
                                        <input type="text" id="event_title" name="title" value="<?php echo htmlspecialchars($event_title); ?>" class="form-control" placeholder="e.g. Summer Festival">
                                    </div>

                                    <div class="mb-3">
                                        <label for="event_description" class="form-label fw-bold">Description</label>
                                        <textarea id="event_description" name="description" class="form-control" rows="3" placeholder="Describe the event..."><?php echo htmlspecialchars($description); ?></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="event_location" class="form-label fw-bold">Location</label>
                                        <input type="text" id="event_location" name="location" value="<?php echo htmlspecialchars($location); ?>" class="form-control" placeholder="e.g. Central Park">
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="event_date" class="form-label fw-bold">Date</label>
                                            <input type="date" id="event_date" name="event_date" value="<?php echo htmlspecialchars($event_date); ?>" class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="event_time" class="form-label fw-bold">Time</label>
                                            <input type="time" id="event_time" name="event_time" value="<?php echo htmlspecialchars($event_time); ?>" class="form-control">
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label for="event_image" class="form-label fw-bold">Event Image</label>
                                        <input type="file" id="event_image" name="image_path" class="form-control">
                                    </div>

                                    <button type="submit" name="submit_event" class="btn btn-success w-50 mx-auto d-block">
                                        <i class="fa-solid fa-check"></i> Publish Event
                                    </button>
                                </form>
                            </div> <!--card-body end-->

                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-5 hr-dark"> <!-- line for visual separation between form and posted events -->
        <?php endif; ?> <!-- "Create New Event"-form End -->


        <!-- Posted events -->
        <div class="event-header mb-4">
            <h2 class="m-0">Upcoming Events</h2>
        </div>

        <div class="row">
            <?php
            // Fetch all events
            $sql = "SELECT event_id, admin_id, title, description, location, event_date, event_time, image_path 
            FROM events 
            ORDER BY event_date ASC";

            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $image = !empty($row['image_path']) ? $row['image_path'] : "Bilder/Placeholder.jpg";
                    $event_id = $row['event_id']; //ID of the event being fetched

                    // Prepare Participation Count
                    $count_sql = "SELECT COUNT(*) AS total FROM user_events WHERE event_id = ? AND is_participating = 1";
                    $stmt = $conn->prepare($count_sql);
                    $stmt->bind_param("i", $event_id);
                    $stmt->execute();
                    $stmt->bind_result($member_count);
                    $stmt->fetch();
                    $stmt->close();

                    // Prepare User Status (if logged in)
                    $isParticipating = 0;
                    $isFavorite = 0;
                    if (isset($_SESSION['user_id'])) {

                        // Second statement for fetching participating and favorite values for current user and current event
                        $status_sql = "SELECT is_participating, is_favorite FROM user_events WHERE user_id = ? AND event_id = ?";
                        $stmt2 = $conn->prepare($status_sql);
                        $stmt2->bind_param("ii", $_SESSION['user_id'], $event_id);
                        $stmt2->execute();
                        $res2 = $stmt2->get_result();
                        if ($s_row = $res2->fetch_assoc()) {
                            $isParticipating = $s_row['is_participating'];
                            $isFavorite = $s_row['is_favorite'];
                        }
                        $stmt2->close();
                    }
            ?>

                    <!--Event card-->
                    <div class="col-12 col-sm-6 col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            <!--Event image in card-->
                            <img class="card-img-top" src="<?php echo $image; ?>" alt="Event Image" style="height: 200px; object-fit: cover;">

                            <!--Event information in card-->
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($row["title"]); ?></h5>
                                <p class="card-text text-muted small"><?php echo nl2br(htmlspecialchars(substr($row["description"], 0, 100))) . '...'; ?></p>

                                <ul class="list-unstyled small mt-3">
                                    <li><i class="fa-regular fa-calendar me-2"></i> <?php echo date('d.m.Y', strtotime($row["event_date"])); ?></li>
                                    <li><i class="fa-regular fa-clock me-2"></i> <?php echo substr($row["event_time"], 0, 5); ?></li>
                                    <li><i class="fa-solid fa-location-dot me-2"></i> <?php echo htmlspecialchars($row["location"]); ?></li>
                                    <li><i class="fa-solid fa-users me-2"></i> <strong><?php echo $member_count; ?></strong> Going</li>
                                </ul>
                            </div>

                            <!--Personal event information (participating/favorite)-->
                            <div class="card-footer bg-white border-top-0">
                                <?php if (isset($_SESSION['user_id'])): ?>
                                    <div class="d-flex justify-content-between align-items-center">

                                        <!--Favorite/Participating button-->
                                        <div>
                                            <form method="POST" action="toggle_favorite.php" class="d-inline">
                                                <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
                                                <button type="submit" class="btn <?php echo $isFavorite ? 'btn-warning' : 'btn-outline-warning'; ?> btn-sm" title="Favorite">
                                                    <i class="<?php echo $isFavorite ? 'fa-solid' : 'fa-regular'; ?> fa-star"></i>
                                                </button>
                                            </form>

                                            <form method="POST" action="toggle_participate.php" class="d-inline ms-1">
                                                <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
                                                <button type="submit" class="btn <?php echo $isParticipating ? 'btn-success' : 'btn-outline-success'; ?> btn-sm" title="Join Event">
                                                    <i class="fa-solid fa-calendar-check"></i>
                                                </button>
                                            </form>
                                        </div>

                                        <!--Delete Event button (only if creator of this event)-->
                                        <?php if ($_SESSION['user_id'] == $row["admin_id"]): ?>
                                            <form action="delete_event.php" method="POST" class="d-inline">
                                                <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
                                                <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this event?');">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                    </div>

                                <?php else: ?>
                                    <a href="login.php" class="btn btn-primary btn-sm w-100">Login to Join</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div> <!--Event card end-->

            <?php
                } //end of fetching-loop
            } else {
                echo "<div class='col-12 text-center'><p class='text-muted'>No events found.</p></div>";
            }
            $conn->close();
            ?>
        </div>
    </div>

    <?php include "footer.php" ?>
</body>

</html>