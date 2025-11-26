<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <?php include "head_links.php" ?>
</head>

<body style="background-color:#FFF2EF">
    <?php
    include 'nav.php';
    //the following is only displayed when a user is redirected
    //from the registration page to login page
    //after successfully registering
    if (isset($_SESSION['success_message'])) {
        echo '<p class="alert alert-success">' . $_SESSION['success_message'] . '</p>';
        unset($_SESSION['success_message']);
    }
    ?>



    <div class="container d-flex justify-content-center align-items-center text-center" style="min-height: 100vh;">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="card shadow-lg rounded-lg p-5">
                <!-- this if clause checks if the user is already logged in when being redirected to the login page
                    if user is logged in, he will only be shown a message with a link back to dashboard -->
                <?php if (!isset($_SESSION['user_id'])): ?>
                    <h2 class="text-center mb-4">Login</h2>
                    <form action="login.php" method="POST">
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Login</button>
                    </form>
                    <div>
                        <p>
                            Don't have an account?
                            <a href="register_page.php" class="text-decoration-none">Sign up here</a>
                        </p>
                    </div>
            </div>
        <?php else: ?>
            <p class="text-center">You are already logged in. Go to <a href="profile.php">Dashboard</a></p>
        <?php endif; ?>
        </div>
    </div>

</body>

</html>