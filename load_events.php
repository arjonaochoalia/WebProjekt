<?php
require 'db_connection.php';

//sql query fetches all results from event table
//for each row we create a card on events page and fill it with data from the database
//if user is logged in we display two buttons for favorite and participate
//if user id matches the admin id from the card (meaning this user created the event initially) we display a delete button
//TODO: add the logic for deleting in db, fix layout/design, add a button that lets admins create new events

$sql = "SELECT event_id, admin_id, title, description, location, event_date, event_time, image_path FROM events";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        $image = !empty($row['image_path']) ? $row['image_path'] : "Bilder/Placeholder.jpg";
?>

        <div class="card" style="width: 18rem; margin-bottom: 20px;">
            <img class="card-img-top" src="<?php echo $image; ?>" alt="Event Image">

            <div class="card-body">
                <h5 class="card-title">
                    <?php echo htmlspecialchars($row["title"]); ?>
                </h5>

                <p class="card-text">
                    <?php echo nl2br(htmlspecialchars($row["description"])); ?>
                </p>

                <p class="card-text">
                    <strong>Datum:</strong> <?php echo $row["event_date"]; ?><br>
                    <strong>Uhrzeit:</strong> <?php echo $row["event_time"]; ?>
                </p>
            </div>

            <?php
            // Buttons for logged-in users
            if (isset($_SESSION['user_role'])) {
            ?>
                <div class="card-footer d-flex justify-content-between">
                    <button class="btn btn-outline-warning">
                        <i class="fa fa-star"></i> Favorisieren
                    </button>
                    <button class="btn btn-outline-success">
                        <i class="fa fa-check"></i> Teilnehmen
                    </button>
                </div>
                <?php
                // Delete button for admins (or event owner)
                if ($_SESSION['user_id'] == $row["admin_id"]) {
                ?>
                    <div class="card-footer">
                        <form action="delete_event.php" method="POST">
                            <input type="hidden" name="event_id" value="<?php echo $row['event_id']; ?>">
                            <button type="submit" class="btn btn-danger w-100">
                                Event löschen
                            </button>
                        </form>
                    </div>
            <?php
                }
            }
            ?>

        </div>

<?php
    }
} else {
    echo "Keine Events gefunden.";
}

$conn->close();
?>