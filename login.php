<?php
// =================================================================
// PHP LOGIC
// =================================================================
session_start();

// Initialize variables to hold messages
$error_message = [];

// handle form submission
if (isset($_POST['submit'])) {
    require 'db_connection.php';

    $email    = trim($_POST['email']);
    $password = $_POST['password'];
    $stored_hash = "";

    // Validation
    if (empty($email)) $error_message[] = "Please enter an email.";
    if (empty($password)) $error_message[] = "Please enter a password.";

    if (empty($error_message)) {
        // fetch data from database
        $sql = "SELECT user_id, username, first_name, last_name, user_role, user_password 
            FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();

        // bind results
        $stmt->bind_result($user_id, $username, $first_name, $last_name, $user_role, $stored_hash);
        $fetch_success = $stmt->fetch();
        $stmt->close();
        $conn->close();

        if (!$fetch_success) {
            // User not found
            $error_message[] = "Incorrect email or password.";
        } else {
            // User found, verify password
            if (password_verify($password, $stored_hash)) {

                // Login Success
                $_SESSION['user_id']    = $user_id;
                $_SESSION['username']   = $username;
                $_SESSION['first_name'] = $first_name;
                $_SESSION['last_name']  = $last_name;
                $_SESSION['user_role']  = $user_role;
                $_SESSION['email']      = $email;

                // Redirect to dashboard/profile
                header("Location: /WebProjekt/profile.php");
                exit;
            } else {
                // Wrong password
                $error_message[] = "Incorrect email or password.";
            }
        }
    }
}
?>

<!-- =================================================================
// HTML STRUCTURE
// ================================================================= -->
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <?php include "head_links.php" ?>
</head>

<body>
    <?php include 'nav.php'; ?>

    <div class="container d-flex justify-content-center align-items-center text-center" style="min-height: 100vh;">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="card shadow-lg rounded-lg p-5">

                <?php if (!isset($_SESSION['user_id'])): ?>

                    <h2 class="text-center mb-4">Login</h2>
                    <!-- "Registration successful" alert message-->
                    <?php if (isset($_SESSION['register_message'])): ?>
                        <div class="alert alert-success">
                            <?= $_SESSION['register_message'] ?>
                        </div>
                        <?php unset($_SESSION['register_message']); ?>
                    <?php endif; ?>

                    <!-- Any error alert message-->
                    <?php if (!empty($error_message)): ?>
                        <div class="alert alert-danger text-left mt-4" role="alert">
                            <?php foreach ($error_message as $msg): ?>
                                <li><?= $msg ?></li>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <!-- Login form -->
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" value="<?php echo htmlspecialchars($email ?? ''); ?>" id="email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Login</button>
                    </form>

                    <!-- redirect to registration if no account yet -->
                    <div class="mt-3">
                        <p>
                            Don't have an account?
                            <a href="register.php" class="text-decoration-none">Sign up here</a>
                        </p>
                    </div>

                    <!-- display redirect if user is already logged in -->
                <?php else: ?>
                    <p class="text-center">You are already logged in. Go to your <a href="profile.php">Profile</a></p>
                <?php endif; ?>

            </div>
        </div>
    </div>

</body>

</html>