<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "head_links.php" ?>
</head>

<body>
    <div class="row">
        <?php
        require 'db_connection.php';

        // Fetch all events
        $sql = "SELECT event_id, admin_id, title, description, location, event_date, event_time, image_path FROM events";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                //if event entry in database has NULL in image_path we give it a default path
                $image = !empty($row['image_path']) ? $row['image_path'] : "Bilder/Placeholder.jpg";
        ?>

                <div class="col-12 col-sm-6 col-md-4 mb-4">
                    <div class="card h-100">
                        <img class="card-img-top" src="<?php echo $image; ?>" alt="Event Image">

                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($row["title"]); ?></h5>
                            <p class="card-text"><?php echo nl2br(htmlspecialchars($row["description"])); ?></p>
                            <p class="card-text">
                                <strong>Date:</strong> <?php echo $row["event_date"]; ?><br>
                                <strong>Time:</strong> <?php echo $row["event_time"]; ?><br>
                                <strong>Location:</strong> <?php echo $row["location"]; ?>
                                <strong>Members:</strong>
                                <?php
                                // Fetch number of participating users
                                $sql = "SELECT COUNT(*) AS total 
                                        FROM user_events 
                                        WHERE event_id = ? 
                                        AND is_participating = 1";

                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("i", $row["event_id"]);
                                $stmt->execute();

                                $stmt->bind_result($count);
                                $stmt->fetch();

                                //set count 0 if we didnt fetch anything from database
                                echo $count > 0 ? $count : "0";

                                $stmt->close();
                                ?>
                            </p>
                        </div>

                        <?php


                        //when we create the cards that should be displayed on the event page
                        //we have to check in the db for the user for each card if he is_participating and is_favorite
                        //and style the two buttons accordingly
                        if (isset($_SESSION['user_role'])) {
                            $user_id = $_SESSION['user_id'];
                            $event_id = $row['event_id'];

                            // Check participation & favorite status
                            $stmt = $conn->prepare("SELECT is_participating, is_favorite FROM user_events WHERE user_id = ? AND event_id = ?");
                            $stmt->bind_param("ii", $user_id, $event_id);
                            $stmt->execute();
                            $status_result = $stmt->get_result();
                            $isParticipating = 0;
                            $isFavorite = 0;

                            if ($status_result->num_rows > 0) {
                                $status_row = $status_result->fetch_assoc();
                                $isParticipating = $status_row['is_participating'];
                                $isFavorite = $status_row['is_favorite'];
                            }
                        ?>

                            <div class="card-footer d-flex justify-content-between align-items-center">
                                <div class="d-flex justify-content-start">
                                    <!-- Favorite button -->
                                    <form method="POST" action="toggle_favorite.php" class="d-inline">
                                        <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
                                        <button type="submit" class="btn <?php echo $isFavorite ? 'btn-warning' : 'btn-outline-warning'; ?>" title="Add to favorites">
                                            <i class="<?php echo $isFavorite ? 'fa-solid fa-star' : 'fa-regular fa-star'; ?> fa-fw"></i>
                                        </button>
                                    </form>

                                    <!-- Participate button -->
                                    <form method="POST" action="toggle_participate.php" class="d-inline ms-2">
                                        <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
                                        <button type="submit" class="btn <?php echo $isParticipating ? 'btn-success' : 'btn-outline-success'; ?>" title="Participate">
                                            <i class="fa-solid fa-calendar-check fa-fw"></i>
                                        </button>
                                    </form>
                                </div>

                                <?php if ($_SESSION['user_id'] == $row["admin_id"]) { ?>
                                    <form action="delete_event.php" method="POST" class="d-inline">
                                        <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
                                        <button type="submit" class="btn btn-danger">Delete event</button>
                                    </form>
                                <?php } ?>
                            </div>
                        <?php
                        } else { ?>
                            <!-- If not logged in -->
                            <div class="card-footer">
                                <a href="login_page.php" class="btn btn-primary w-100">Want to participate?</a>
                            </div>
                        <?php } ?>
                    </div>
                </div>

        <?php
            }
        } else {
            echo "<p class='text-center'>Keine Events gefunden.</p>";
        }

        $conn->close();
        ?>
    </div>
</body>

</html>