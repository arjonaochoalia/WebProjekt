<?php
session_start();

$error_message = "";

// Only run this logic if the form was submitted
if (isset($_POST['submit'])) {
    require 'db_connection.php'; // connect to database
    mysqli_report(MYSQLI_REPORT_OFF); // disable exceptions

    $username   = $_POST['username'];
    $email      = $_POST['email'];
    $password   = $_POST['password'];
    $first_name = $_POST['first_name'];
    $last_name  = $_POST['last_name'];
    $role       = 'user';

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Save data in database
    $sql = "INSERT INTO users (username, first_name, last_name, email, user_password, user_role) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("ssssss", $username, $first_name, $last_name, $email, $hashed_password, $role);

        if ($stmt->execute()) {
            // successful registration --> redirect login page with success message
            $_SESSION['register_message'] = "Registration successful! Please log in.";
            
            // Redirect to our NEW merged login page
            header("Location: login.php");
            exit();
        } else {
            // Check if it's a duplicate entry error (Error code 1062)
            if ($conn->errno === 1062) {
                $error_message = "This Username or Email is already taken.";
            } else {
                $error_message = "Registration failed. Please try again.";
            }
        }
        $stmt->close();
    } else {
        $error_message = "Database error: Unable to prepare statement.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register</title>
    <?php include "head_links.php" ?>
</head>

<body>
    <?php include 'nav.php' ?>

    <div class="container d-flex justify-content-center align-items-center text-center" style="min-height: 100vh;">
        <div class="col-12 col-md-8 col-lg-6">
            
            <?php if (!empty($error_message)): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>

            <form action="" method="POST" class="border p-4 mt-4 bg-white shadow-sm rounded">
                <h2 class="mb-4">Sign Up</h2>

                <div class="form-group text-start">
                    <label for="user-name">Username</label>
                    <input type="text" class="form-control" id="user-name" name="username"
                        placeholder="Enter your username" required>
                </div>
                <div class="form-group text-start">
                    <label for="user-email">Email address</label>
                    <input type="email" class="form-control" id="user-email" name="email" placeholder="Enter your Email"
                        required>
                </div>
                <div class="form-group text-start">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="Enter your password" required>
                </div>
                <div class="form-group text-start">
                    <label for="first-name">First Name</label>
                    <input type="text" class="form-control" id="first-name" name="first_name"
                        placeholder="Enter your first name" required>
                </div>
                <div class="form-group text-start">
                    <label for="last-name">Last Name</label>
                    <input type="text" class="form-control" id="last-name" name="last_name"
                        placeholder="Enter your last name" required>
                </div>

                <button type="submit" name="submit" class="btn btn-primary w-25 mt-3">Sign up</button>
            </form>

            <div class="mt-3">
                <p>
                    Already have an account?
                    <a href="login.php" class="text-decoration-none">Login here</a>
                </p>
            </div>
        </div>
    </div>

</body>
</html>