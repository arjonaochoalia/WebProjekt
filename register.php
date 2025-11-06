<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link" href="index.php">Home</a>
                <a class="nav-item nav-link" href="events.php">Events</a>
                <a class="nav-item nav-link" href="#">Community</a>
                <a class="nav-item nav-link" href="login.php">Login</a>
                <a class="nav-item nav-link active" href="register.php">Register <span class="sr-only">(current)</span></a>
            </div>
        </div>
    </nav>

    <div class="container d-flex justify-content-center align-items-center text-center" style="height: 100vh;">
        <div class="col-6">
            <form>
                <div class="form-group">
                    <label for="user-name">Username</label>
                    <input type="text" class="form-control" id="user-name" name="user_name" placeholder="Enter your username">
                </div>
                <div class="form-group">
                    <label for="user-email">Email address</label>
                    <input type="email" class="form-control" id="user-email" placeholder="Enter your Email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Enter your password">
                </div>
                <div class="form-group">
                    <label for="first-name">First Name</label>
                    <input type="text" class="form-control" id="first-name" name="first_name" placeholder="Enter your first name">
                </div>
                <div class="form-group">
                    <label for="last-name">Last Name</label>
                    <input type="text" class="form-control" id="last-name" name="last_name" placeholder="Enter your last name">
                </div>

                <button type="submit" class="btn btn-primary">Sign up</button>
            </form>
            <div>
                <p>
                    Already have an account?
                    <a href="login.php" class="text-decoration-none">Login here</a>
                </p>
            </div>
        </div>
    </div>

</body>

</html>


<?php





?>