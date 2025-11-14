<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Events</title>
</head>

<body>
    <?php include 'nav.php' ?>

</body>

</html>



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