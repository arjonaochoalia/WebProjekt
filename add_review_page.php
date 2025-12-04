<!DOCTYPE html>
<html lang="en">

<head>
    <title>Post a Review</title>
    <?php include 'head_links.php'; ?>
</head>

<body>
    <?php include 'nav.php';
    if (isset($_SESSION['review_error_message'])) {
        echo '<p class="alert alert-danger">' . $_SESSION['review_error_message'] . '</p>';
        unset($_SESSION['review_error_message']);
    }
    ?>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <h2 class="text-center mb-4">Post a Review</h2>

                <?php if (isset($_SESSION['user_id'])): ?>
                    <form action="add_review.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Your Review</label>
                            <textarea name="review_content" class="form-control" rows="4" placeholder="Write your review here..."></textarea>
                        </div>

                        <input type="hidden" name="user_id" value="<?= $_SESSION['user_id']; ?>">

                        <div class="mb-3">
                            <label class="form-label">Rating</label>
                            <select name="rating" class="form-control" required>
                                <option value="">Select rating</option>
                                <option value="1">1 ★</option>
                                <option value="2">2 ★★</option>
                                <option value="3">3 ★★★</option>
                                <option value="4">4 ★★★★</option>
                                <option value="5">5 ★★★★★</option>
                            </select>
                        </div>

                        <button type="submit" name="submit_review" class="btn btn-success w-100">Post Review</button>
                    </form>
                <?php else: ?>
                    <p class="text-center">Please <a href="login_page.php">login</a> to post a review.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php include "footer.php" ?>
</body>

</html>