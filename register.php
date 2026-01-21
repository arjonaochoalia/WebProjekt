<?php
// =================================================================
// PHP LOGIC
// =================================================================
session_start();

$error_message = [];

// Only run this logic if the form was submitted
if (isset($_POST['submit'])) {
    require 'db_connection.php'; // connect to database
    mysqli_report(MYSQLI_REPORT_OFF); // disable exceptions

    $username   = trim($_POST['username']);
    $email      = trim($_POST['email']);
    $password   = $_POST['password'];
    $first_name = trim($_POST['first_name']);
    $last_name  = trim($_POST['last_name']);
    $role       = 'user';

    // Validation
    if (empty($username)) $error_message[] = "Please enter a username.";
    if (empty($email)) $error_message[] = "Please enter an email.";
    if (empty($password)) $error_message[] = "Please enter a password.";
    if (empty($first_name)) $error_message[] = "Please enter a firstname.";
    if (empty($last_name)) $error_message[] = "Please enter a lastname.";

    //if no errors create user in database
    if (empty($error_message)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Save data in database
        $sql = "INSERT INTO users (username, first_name, last_name, email, user_password, user_role) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $username, $first_name, $last_name, $email, $hashed_password, $role);

        if ($stmt->execute()) {
            // Set success message in session
            $_SESSION['register_message'] = "Registration successful! Please log in.";
            header("Location: login.php");
            exit();
        } else {
            // Error code 1062 if Username or Email is already taken
            if ($conn->errno === 1062) {
                $error_message[] = "This Username or Email is already taken.";
            } else {
                $error_message[] = "Registration failed. Please try again.";
            }
        }
        $stmt->close();
    }
    $conn->close();
}
?>

<!-- =================================================================
// HTML STRUCTURE
// ================================================================= -->
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register</title>
    <?php include "head_links.php" ?>
</head>

<body>
    <?php include 'nav.php' ?>

    <!-- Register form -->
    <div class="container d-flex justify-content-center align-items-center text-center" style="min-height: 100vh;">
        <div class="col-12 col-md-8 col-lg-6">

            <form action="" method="POST" class="border p-4 mt-4 bg-white shadow-sm rounded">
                <h2 class="mb-4">Sign Up</h2>

                <!-- Any error alert message-->
                <?php if (!empty($error_message)): ?>
                    <div class="alert alert-danger text-left mt-4" role="alert">
                        <?php foreach ($error_message as $msg): ?>
                            <li><?= $msg ?></li>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <div class="form-group text-start">
                    <label for="user-name">Username</label>
                    <input type="text" class="form-control" id="user-name" name="username" value="<?php echo htmlspecialchars($username ?? ''); ?>"
                        placeholder="Enter your username">
                </div>
                <div class="form-group text-start">
                    <label for="user-email">Email address</label>
                    <input type="email" class="form-control" id="user-email" name="email" value="<?php echo htmlspecialchars($email ?? ''); ?>" placeholder="Enter your Email">
                </div>
                <div class="form-group text-start">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="Enter your password">
                </div>
                <div class="form-group text-start">
                    <label for="first-name">First Name</label>
                    <input type="text" class="form-control" id="first-name" name="first_name" value="<?php echo htmlspecialchars($first_name ?? ''); ?>"
                        placeholder="Enter your first name">
                </div>
                <div class="form-group text-start">
                    <label for="last-name">Last Name</label>
                    <input type="text" class="form-control" id="last-name" name="last_name" value="<?php echo htmlspecialchars($last_name ?? ''); ?>"
                        placeholder="Enter your last name">
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