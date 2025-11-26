<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register</title>
    <?php include "head_links.php" ?>
</head>

<body>
    <?php include 'nav.php' ?>

    <div class="container d-flex justify-content-center align-items-center text-center" style="height: 100vh;">
        <div class="col-6">
            <form action="register.php" method="POST">
                <div class="form-group">
                    <label for="user-name">Username</label>
                    <input type="text" class="form-control" id="user-name" name="username"
                        placeholder="Enter your username" required>
                </div>
                <div class="form-group">
                    <label for="user-email">Email address</label>
                    <input type="email" class="form-control" id="user-email" name="email" placeholder="Enter your Email"
                        required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="Enter your password" required>
                </div>
                <div class="form-group">
                    <label for="first-name">First Name</label>
                    <input type="text" class="form-control" id="first-name" name="first_name"
                        placeholder="Enter your first name" required>
                </div>
                <div class="form-group">
                    <label for="last-name">Last Name</label>
                    <input type="text" class="form-control" id="last-name" name="last_name"
                        placeholder="Enter your last name" required>
                </div>

                <button type="submit" name="submit" class="btn btn-primary">Sign up</button>
            </form>

            <div>
                <p>
                    Already have an account?
                    <a href="login_page.php" class="text-decoration-none">Login here</a>
                </p>
            </div>
        </div>
    </div>

</body>

</html>