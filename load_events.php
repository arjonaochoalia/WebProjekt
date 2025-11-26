<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "head_links.php" ?>
</head>

<body>
    <div class="row">
        <?php
        require 'db_connection.php';

        //sql query fetches all results from event table
        //for each row we create a card on events page and fill it with data from the database
        //if user is logged in we display two buttons for favorite and participate
        //if user id matches the admin id from the card (meaning this user created the event initially) we display a delete button
        //TODO: add the logic for deleting in db

        $sql = "SELECT event_id, admin_id, title, description, location, event_date, event_time, image_path FROM events";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {

                $image = !empty($row['image_path']) ? $row['image_path'] : "Bilder/Placeholder.jpg";
        ?>

                <div class="col-12 col-sm-6 col-md-4 mb-4">
                    <div class="card h-100">
                        <img class="card-img-top" src="<?php echo $image; ?>" alt="Event Image">

                        <div class="card-body">
                            <h5 class="card-title">
                                <?php echo htmlspecialchars($row["title"]); ?>
                            </h5>

                            <p class="card-text">
                                <?php echo nl2br(htmlspecialchars($row["description"])); ?>
                            </p>

                            <p class="card-text">
                                <strong>Date:</strong> <?php echo $row["event_date"]; ?><br>
                                <strong>Time:</strong> <?php echo $row["event_time"]; ?><br>
                                <strong>Location:</strong> <?php echo $row["location"]; ?>
                            </p>
                        </div>

                        <?php
                        // Buttons only for logged-in users
                        if (isset($_SESSION['user_role'])) {
                        ?>
                            <div class="card-footer d-flex justify-content-between align-items-center">
                                <div class="d-flex justify-content-start">
                                    <!-- Favorite button -->
                                    <form method="POST" action="toggle_favorite.php" class="d-inline">
                                        <input type="hidden" name="event_id" value="<?php echo $row['event_id']; ?>">
                                        <button type="submit" class="btn btn-outline-warning " title="Add to favorites">
                                            <i class="fa-regular fa-star fa-fw"></i>
                                        </button>
                                    </form>

                                    <!-- Participate button -->
                                    <form method="POST" action="toggle_participate.php" class="d-inline">
                                        <input type="hidden" name="event_id" value="<?php echo $row['event_id']; ?>">
                                        <button type="submit" class="btn btn-outline-success " title="Participate">
                                            <i class="fa-solid fa-calendar-check fa-fw"></i>
                                        </button>
                                    </form>
                                </div>

                                <?php
                                // Delete button only for the admin that created the event
                                if ($_SESSION['user_id'] == $row["admin_id"]) {
                                ?>
                                    <form action="delete_event.php" method="POST" class="d-inline">
                                        <input type="hidden" name="event_id" value="<?php echo $row['event_id']; ?>">
                                        <button type="submit" class="btn btn-danger">
                                            Delete event
                                        </button>
                                    </form>
                                <?php
                                }
                                ?>
                            </div>
                        <?php
                        } else { ?>
                            <!-- If not logged in -->
                            <div class="card-footer">
                                <a href="login_page.php" class="btn btn-primary w-100">
                                    Want to participate?
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
        <?php
            }
        } else {
            echo "Keine Events gefunden.";
        }

        $conn->close();
        ?>
    </div>
</body>

</html>