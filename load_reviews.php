<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

?>
<!DOCTYPE html>
<html lang="en">

<body>
    <div class="row">
        <?php
        require 'db_connection.php';

        // Fetch reviews with user info
        $sql = "SELECT r.review_id, r.user_id, r.content, r.rating, r.created_at, u.first_name, u.last_name, u.user_role 
                    FROM reviews r
                    JOIN users u ON r.user_id = u.user_id
                    ORDER BY r.created_at DESC";

        $result = $conn->query($sql);

        if ($result->num_rows > 0):
            while ($row = $result->fetch_assoc()):
        ?>
                <div class="col-12 col-md-8 col-lg-6 mb-4">
                    <div class="card review-card">
                        <div class="card-header text-white d-flex">
                            <h5 class="card-title">
                                <?= htmlspecialchars($row['first_name'] . " " . $row['last_name']); ?>
                            </h5>
                            <p class="text-muted ml-auto" style="font-size:0.9em;">
                                <?= date('d.m.Y', strtotime($row['created_at'])); ?>
                            </p>
                        </div>
                        <div class="card-body">
                            <!-- display the text from database for review -->
                            <p class="card-text">
                                <?= nl2br(htmlspecialchars($row['content'])); ?>
                            </p>

                            <!-- display stars rating -->
                            <p>
                                <?php
                                $rating = (int)$row['rating'];
                                for ($i = 0; $i < $rating; $i++) echo '<span class="star gold">★</span>';
                                for ($i = $rating; $i < 5; $i++) echo '<span class="star gray">★</span>';
                                ?>
                            </p>
                        </div>

                        <?php
                        // Delete button only for admins
                        if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'):
                        ?>
                            <div class="card-footer">
                                <form action="delete_review.php" method="POST">
                                    <input type="hidden" name="review_id" value="<?= $row['review_id']; ?>">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
        <?php
            endwhile;
        else:
            echo "<p>No reviews found.</p>";
        endif;

        $conn->close();
        ?>
    </div>
</body>

</html>