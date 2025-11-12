<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
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