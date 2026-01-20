<?php
// =================================================================
// PHP LOGIC (SECURITY, UPLOADS, FETCH USER)
// =================================================================

session_start();

// Security Check
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require 'db_connection.php';
$user_id = $_SESSION['user_id'];
$message = "";

// -----------------------------------------------------------------
//  HANDLE IMAGE UPLOAD
// -----------------------------------------------------------------
if (isset($_POST['submit_image'])) {

    //create target path for image
    if (!empty($_FILES["image_path"]["name"])) {
        $original_filename = basename($_FILES["image_path"]["name"]);
        $target_dir = "profile_pictures/";
        $target_file = $target_dir . $user_id . "_profile_picture_" . $original_filename;

        //move file to target folder and upload it to the database
        if (move_uploaded_file($_FILES["image_path"]["tmp_name"], $target_file)) {
            $sql = "UPDATE users SET image_path = ? WHERE user_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $target_file, $user_id);

            if ($stmt->execute()) {
                $message = '<p class="alert alert-success">Profile picture updated!</p>';
            } else {
                $message = '<p class="alert alert-danger">Database error.</p>';
            }
            $stmt->close();
        } else {
            $message = '<p class="alert alert-danger">Error moving uploaded file.</p>';
        }
    }
}

// -----------------------------------------------------------------
// FETCH CURRENT IMAGE
// -----------------------------------------------------------------
$sql_fetch = "SELECT image_path FROM users WHERE user_id = ?";
$stmt_fetch = $conn->prepare($sql_fetch);
$stmt_fetch->bind_param("i", $user_id);
$stmt_fetch->execute();
$stmt_fetch->bind_result($db_image_path);
$stmt_fetch->fetch();
$stmt_fetch->close();

$display_image = "profile_pictures/placeholder.jpg";
if (!empty($db_image_path) && file_exists($db_image_path)) {
    $display_image = $db_image_path;
}
?>

<!-- =================================================================
// HTML STRUCTURE
// ================================================================= -->

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Profile</title>
    <?php include "head_links.php" ?>
</head>

<body>
    <?php include 'nav.php'; ?>

    <div class="container mt-4">

        <!-- "User deleted" alert message-->
        <?php
        if (isset($_SESSION['user_deleted_message'])) {
            echo '<p class="alert alert-success">' . $_SESSION['user_deleted_message'] . '</p>';
            unset($_SESSION['user_deleted_message']);
        }
        echo $message;
        ?>

        <!-- profile picture and personal information -->
        <div class="row">
            <!-- profile picture and file upload -->
            <div class="col-md-4">
                <div class="card text-center shadow-sm p-3 mb-4 bg-white rounded">
                    <div class="card-body">
                        <img src="<?php echo htmlspecialchars($display_image); ?>" alt="Profile Picture" class="img-fluid mb-3">
                        <form action="" method="POST" enctype="multipart/form-data" class="mt-3">
                            <div class="custom-file mb-3">
                                <input type="file" accept=".jpg, .jpeg, image/jpeg" class="custom-file-input" id="image_path" name="image_path" required>
                                <label class="custom-file-label" for="image_path">Choose file</label>
                            </div>
                            <button type="submit" name="submit_image" class="btn btn-success w-100">Upload</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- personal information -->
            <div class="col-md-8">
                <div class="card shadow-sm p-3 mb-4 bg-white rounded">
                    <div class="card-body">
                        <h3 class="mb-4 text-center">Profile Information</h3>
                        <div class="mb-2"><strong>First Name:</strong> <span><?php echo $_SESSION['first_name']; ?></span></div>
                        <div class="mb-2"><strong>Last Name:</strong> <span><?php echo $_SESSION['last_name']; ?></span></div>
                        <div class="mb-2"><strong>Email:</strong> <span><?php echo $_SESSION['email']; ?></span></div>
                        <div class="mb-2"><strong>Username:</strong> <span><?php echo $_SESSION['username']; ?></span></div>
                        <div class="mb-2"><strong>Role:</strong> <span><?php echo $_SESSION['user_role']; ?></span></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Management (only visible for admins)-->
        <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') { ?>
            <div class="container px-0 mt-5 border p-3 bg-white">
                <h3 class="mb-3">User Management</h3>
                <?php
                $sql = "SELECT user_id, username, first_name, last_name, email, user_role FROM users";
                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                ?>
                    <!-- User table -->
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">First Name</th>
                                    <th scope="col">Last Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $result->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row["user_id"]); ?></td>
                                        <td><?php echo htmlspecialchars($row["username"]); ?></td>
                                        <td><?php echo htmlspecialchars($row["first_name"]); ?></td>
                                        <td><?php echo htmlspecialchars($row["last_name"]); ?></td>
                                        <td><?php echo htmlspecialchars($row["email"]); ?></td>
                                        <td><?php echo htmlspecialchars($row["user_role"]); ?></td>
                                        <td>
                                            <?php if ($row["user_role"] != "admin") { ?>
                                                <form action="delete_user.php" method="POST" class="d-inline">
                                                    <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($row["user_id"]); ?>">
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this user?');">Delete</button>
                                                </form>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                <?php } else {
                    echo "<p>No users found.</p>";
                } ?>
            </div>
        <?php } ?>

        <!-- Saved favorite events -->
        <div class="container px-0 mt-5 border p-4 bg-light">
            <h2 class="mb-4 text-warning"><i class="fa-solid fa-star"></i> My Favourite Events</h2>
            <div class="row">
                <?php
                $stmt = $conn->prepare("SELECT e.* FROM events e JOIN user_events ue ON e.event_id = ue.event_id WHERE ue.user_id = ? AND ue.is_favorite = 1");
                $stmt->bind_param("i", $user_id);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $image = !empty($row['image_path']) ? $row['image_path'] : "Bilder/Placeholder.jpg";
                        $event_id = $row['event_id'];
                ?>
                        <div class="col-12 col-sm-6 col-md-4 mb-4">
                            <div class="card h-100 shadow-sm">
                                <img class="card-img-top" src="<?php echo $image; ?>" alt="Event Image" style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($row["title"]); ?></h5>
                                    <p class="card-text text-muted small"><?php echo nl2br(htmlspecialchars(substr($row["description"], 0, 100))) . '...'; ?></p>
                                    <p class="card-text small">
                                        <strong>Date:</strong> <?php echo $row["event_date"]; ?><br>
                                        <strong>Time:</strong> <?php echo $row["event_time"]; ?><br>
                                        <strong>Location:</strong> <?php echo $row["location"]; ?>
                                    </p>
                                </div>
                                <div class="card-footer d-flex justify-content-between">
                                    <form method="POST" action="toggle_favorite.php" class="d-inline">
                                        <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
                                        <button type="submit" class="btn btn-warning btn-sm" title="Remove Favorite"><i class="fa-solid fa-star"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo "<div class='col-12'><p class='text-muted'>You haven't added any events to your favorites yet.</p></div>";
                }
                $stmt->close();
                ?>
            </div>
        </div>

        <!-- Saved booked events -->
        <div class="container px-0 mt-5 border p-4 bg-light mb-5">
            <h2 class="mb-4 text-success"><i class="fa-solid fa-calendar-check"></i> My Booked Events</h2>
            <div class="row">
                <?php
                $stmt = $conn->prepare("SELECT e.* FROM events e JOIN user_events ue ON e.event_id = ue.event_id WHERE ue.user_id = ? AND ue.is_participating = 1");
                $stmt->bind_param("i", $user_id);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $image = !empty($row['image_path']) ? $row['image_path'] : "Bilder/Placeholder.jpg";
                        $event_id = $row['event_id'];
                ?>
                        <div class="col-12 col-sm-6 col-md-4 mb-4">
                            <div class="card h-100 shadow-sm">
                                <img class="card-img-top" src="<?php echo $image; ?>" alt="Event Image" style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($row["title"]); ?></h5>
                                    <p class="card-text text-muted small"><?php echo nl2br(htmlspecialchars(substr($row["description"], 0, 100))) . '...'; ?></p>
                                    <p class="card-text small">
                                        <strong>Date:</strong> <?php echo $row["event_date"]; ?><br>
                                        <strong>Time:</strong> <?php echo $row["event_time"]; ?><br>
                                        <strong>Location:</strong> <?php echo $row["location"]; ?>
                                    </p>
                                </div>
                                <div class="card-footer d-flex justify-content-between">
                                    <form method="POST" action="toggle_participate.php" class="d-inline">
                                        <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
                                        <button type="submit" class="btn btn-success btn-sm" title="Cancel Participation"><i class="fa-solid fa-check"></i> Going</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo "<div class='col-12'><p class='text-muted'>You haven't joined any events yet.</p></div>";
                }
                $stmt->close();
                ?>
            </div>
        </div>


        <script>
            document.querySelector('.custom-file-input').addEventListener('change', function(e) {
                var fileName = document.getElementById("image_path").files[0].name;
                var nextSibling = e.target.nextElementSibling
                nextSibling.innerText = fileName
            })
        </script>
    </div>

    <?php
    // Close the connection at the very end
    $conn->close();
    include "footer.php"
    ?>
</body>

</html>