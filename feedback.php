<!DOCTYPE html>
<html lang="en">

<head>
    <title>Feedback</title>
    <?php include "head_links.php" ?>
</head>

<body style="background-color:#FFF2EF">
    <?php include 'nav.php' ?>
    <div class="container mt-4">

        <div class="feedback-header d-flex justify-content-between align-items-center mb-4">
            <h2 class="m-0">Reviews</h2>

            <?php if (isset($_SESSION['user_role'])) { ?>

                <a href="add_review_page.php" class="btn">
                    Add New
                </a>
            <?php } ?>

        </div>
        <?php include 'load_reviews.php' ?>


    </div>
    <?php include "footer.php" ?>
</body>

</html>