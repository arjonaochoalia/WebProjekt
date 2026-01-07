<?php
require 'db_connection.php';

$content = $_POST['review_content'] ?? "";
$rating = $_POST['rating'] ?? "";
$errorMessages = [];

//Handle the Form Submission
if (isset($_POST['submit_review'])) {
    $content = trim($content);
    $user_id = $_SESSION['user_id'] ?? null;

    //VALIDATION
    if (empty($content)) {
        $errorMessages[] = "Please enter your review.";
    }
    if (empty($rating)) {
        $errorMessages[] = "Please select a rating.";
    }

    //Database Entry
    if ($user_id && empty($errorMessages)) {
        $sql = "INSERT INTO reviews (user_id, content, rating, created_at) VALUES (?, ?, ?, NOW())";
        $stmt = $conn->prepare($sql);
        $rating_int = (int)$rating;
        $stmt->bind_param("isi", $user_id, $content, $rating_int);

        if ($stmt->execute()) {
            // Redirect on success
            header("Location: feedback.php");
            exit();
        } else {
            $errorMessages[] = "Database error: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Post a Review</title>
    <?php include 'head_links.php'; ?>
</head>
<body>
    <?php include 'nav.php'; ?>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <h2 class="text-center mb-4">Post a Review</h2>

                <?php if (isset($_SESSION['user_id'])): ?>
                    
                    <?php if (!empty($errorMessages)): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php foreach($errorMessages as $msg) echo "<li>$msg</li>"; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form action="add_review_page.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Your Review</label>
                            <textarea name="review_content" class="form-control" rows="4" placeholder="Write your review here..."><?php echo htmlspecialchars($content); ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Rating</label>
                            <select name="rating" class="form-control">
                                <option value="">Select rating</option>
                                <option value="1" <?php if($rating == "1") echo "selected"; ?>>1 ★</option>
                                <option value="2" <?php if($rating == "2") echo "selected"; ?>>2 ★★</option>
                                <option value="3" <?php if($rating == "3") echo "selected"; ?>>3 ★★★</option>
                                <option value="4" <?php if($rating == "4") echo "selected"; ?>>4 ★★★★</option>
                                <option value="5" <?php if($rating == "5") echo "selected"; ?>>5 ★★★★★</option>
                            </select>
                        </div>

                        <button type="submit" name="submit_review" class="btn btn-success w-100">Post Review</button>
                    </form>

                <?php else: ?>
                    <div class="text-center">
                        <p>Please <a href="login_page.php">login</a> to post a review.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php include "footer.php" ?>
</body>
</html>