<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add new</title>
    <?php include "head_links.php" ?>
</head>

<body>
    <?php include 'nav.php' ?>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-7">
                <?php if (isset($_SESSION['user_id']) && $_SESSION['user_role'] == 'admin'): ?>
                    <form action="add_event.php" method="POST" enctype="multipart/form-data">

                        <div class="mb-3">
                            <label class="form-label">Event Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="4"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Location</label>
                            <input type="text" name="location" class="form-control">
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Event Date</label>
                                <input type="date" name="event_date" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Event Time</label>
                                <input type="time" name="event_time" class="form-control">
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
                    <p class="text-center">Please <a href="login_page.php">login</a> with an admin account to post a review.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php include "footer.php" ?>
</body>
</html>



?>