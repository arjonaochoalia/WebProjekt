<?php
session_start();

// Initialize variables to hold messages
$error_message = "";
$success_message = "";

// Check for registration success message (from register.php)
if (isset($_SESSION['register_message'])) {
    $success_message = $_SESSION['register_message'];
    unset($_SESSION['register_message']);
}

// Check for session error messages
if (isset($_SESSION['login_error_message'])) {
    $error_message = $_SESSION['login_error_message'];
    unset($_SESSION['login_error_message']);
}

// --- LOGIC: HANDLE FORM SUBMISSION ---
if (isset($_POST['submit'])) {
    require 'db_connection.php';

    $email    = $_POST['email'];
    $password = $_POST['password'];

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
        $error_message = "Incorrect email or password.";
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
            $error_message = "Incorrect email or password.";
        }
    }
}
?>

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

                    <?php if (!empty($success_message)): ?>
                        <p class="alert alert-success"><?php echo $success_message; ?></p>
                    <?php endif; ?>

                    <?php if (!empty($error_message)): ?>
                        <p class="alert alert-danger"><?php echo $error_message; ?></p>
                    <?php endif; ?>

                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Login</button>
                    </form>

                    <div class="mt-3">
                        <p>
                            Don't have an account?
                            <a href="register.php" class="text-decoration-none">Sign up here</a>
                        </p>
                    </div>

                <?php else: ?>
                    <p class="text-center">You are already logged in. Go to <a href="profile.php">Dashboard</a></p>
                <?php endif; ?>

            </div>
        </div>
    </div>

</body>

</html>