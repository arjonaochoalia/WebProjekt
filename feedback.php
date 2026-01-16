<?php
session_start();
require 'db_connection.php';

// Initialize variables for the form
$content = "";
$rating = "";
$errorMessages = [];

// --- SECTION 1: HANDLE FORM SUBMISSION ---
if (isset($_POST['submit_review'])) {

    // Check if user is logged in
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }

    $content = trim($_POST['review_content'] ?? "");
    $rating = $_POST['rating'] ?? "";
    $user_id = $_SESSION['user_id'];

    // Validation
    if (empty($content)) {
        $errorMessages[] = "Please enter your review.";
    }
    if (empty($rating)) {
        $errorMessages[] = "Please select a rating.";
    }

    // Insert into Database
    if (empty($errorMessages)) {
        $sql = "INSERT INTO reviews (user_id, content, rating, created_at) VALUES (?, ?, ?, NOW())";
        $stmt = $conn->prepare($sql);
        $rating_int = (int)$rating;

        if ($stmt) {
            $stmt->bind_param("isi", $user_id, $content, $rating_int);

            if ($stmt->execute()) {
                // Set success message in session
                $_SESSION['success_review_message'] = "Thank you! Your review has been posted successfully.";
                header("Location: feedback.php");
                exit();
            } else {
                $errorMessages[] = "Database error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $errorMessages[] = "Database error: Unable to prepare statement.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Feedback</title>
    <?php include "head_links.php" ?>
    <style>
        .star {
            font-size: 1.2rem;
        }

        .gold {
            color: #ffc107;
        }

        .gray {
            color: #e4e5e9;
        }
    </style>
</head>

<body>
    <?php include 'nav.php' ?>

    <div class="container mt-4">


        <?php if (isset($_SESSION['success_review_message'])): ?>
            <p class="alert alert-success">
                <?php
                echo $_SESSION['success_review_message'];
                unset($_SESSION['success_review_message']); // Remove after showing
                ?>
            </p>
        <?php endif; ?>
        <div class="row justify-content-center mb-5">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card shadow-sm border border-2 border-secondary">
                    <div class="card-body">
                        <h4 class="card-title text-center mb-3">Leave a Review</h4>

                        <?php if (isset($_SESSION['user_id'])): ?>

                            <?php if (!empty($errorMessages)): ?>
                                <div class="alert alert-danger">
                                    <ul class="mb-0 pl-3">
                                        <?php foreach ($errorMessages as $msg) echo "<li>$msg</li>"; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>

                            <form action="feedback.php" method="POST">
                                <div class="mb-3">
                                    <textarea name="review_content" class="form-control" rows="3" placeholder="Write your experience..." required><?php echo htmlspecialchars($content); ?></textarea>
                                </div>

                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <select name="rating" class="form-control" required>
                                            <option value="">Rate...</option>
                                            <option value="5" <?php if ($rating == "5") echo "selected"; ?>>5 ★★★★★</option>
                                            <option value="4" <?php if ($rating == "4") echo "selected"; ?>>4 ★★★★</option>
                                            <option value="3" <?php if ($rating == "3") echo "selected"; ?>>3 ★★★</option>
                                            <option value="2" <?php if ($rating == "2") echo "selected"; ?>>2 ★★</option>
                                            <option value="1" <?php if ($rating == "1") echo "selected"; ?>>1 ★</option>
                                        </select>
                                    </div>
                                    <div class="col text-right">
                                        <button type="submit" name="submit_review" class="btn btn-primary w-100">Post</button>
                                    </div>
                                </div>
                            </form>

                        <?php else: ?>
                            <div class="text-center py-3">
                                <p class="text-muted">Please <a href="login.php">login</a> to share your experience.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <hr class="my-5">

        <div class="feedback-header mb-4">
            <h2>Community Reviews</h2>
        </div>

        <div class="row">
            <?php
            // Fetch reviews with user info
            $sql = "SELECT r.review_id, r.user_id, r.content, r.rating, r.created_at, u.first_name, u.last_name, u.user_role 
                    FROM reviews r
                    JOIN users u ON r.user_id = u.user_id
                    ORDER BY r.created_at DESC";

            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0):
                while ($row = $result->fetch_assoc()):
            ?>
                    <div class="col-12 col-md-6 mb-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                                <h5 class="card-title m-0">
                                    <?= htmlspecialchars($row['first_name'] . " " . $row['last_name']); ?>
                                </h5>
                                <small class="text-muted">
                                    <?= date('d.m.Y', strtotime($row['created_at'])); ?>
                                </small>
                            </div>

                            <div class="card-body">
                                <div class="mb-2">
                                    <?php
                                    $r_rating = (int)$row['rating'];
                                    for ($i = 0; $i < $r_rating; $i++) echo '<span class="star gold">★</span>';
                                    for ($i = $r_rating; $i < 5; $i++) echo '<span class="star gray">★</span>';
                                    ?>
                                </div>

                                <p class="card-text">
                                    <?= nl2br(htmlspecialchars($row['content'])); ?>
                                </p>
                            </div>

                            <?php
                            // Delete button (Admin Only)
                            if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'):
                            ?>
                                <div class="card-footer bg-light border-top-0 text-right">
                                    <form action="delete_review.php" method="POST" class="d-inline">
                                        <input type="hidden" name="review_id" value="<?= $row['review_id']; ?>">
                                        <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Delete this review?');">Delete</button>
                                    </form>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
            <?php
                endwhile;
            else:
                echo '<div class="col-12"><p class="text-muted text-center">No reviews yet. Be the first to write one!</p></div>';
            endif;

            // Close connection at the very end
            $conn->close();
            ?>
        </div>
    </div>

    <?php include "footer.php" ?>
</body>

</html>