<!DOCTYPE html>
<html lang="en">

<head>
    <title>Events</title>
    <?php include 'head_links.php'; ?>
</head>

<body style="background-color:#FFF2EF">
    <?php include 'nav.php' ?>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="m-0">Events</h2>

            <?php if (isset($_SESSION['user_role'])) { ?>

                <?php if ($_SESSION['user_role'] == 'admin') {

                ?>
                    <a href="add_event_page.php" class="btn btn-warning">
                        Add New
                    </a>
            <?php }
            } ?>

        </div>
        <?php include 'load_events.php' ?>


    </div>
    <?php include "footer.php" ?>
</body>

</html>