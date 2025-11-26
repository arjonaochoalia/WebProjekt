<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Profile</title>
</head>

<body>
    <?php include 'nav.php' ?>
    <div class="container mt-4">

        <!-- Top section -->
        <div class="row">

            <!-- Display image -->
            <div class="col-md-4">
                <div class="card text-center shadow-sm p-3 mb-4 bg-white rounded">
                    <!-- Profile Picture -->
                    <div class="card-body">
                        <?php include 'load_pp.php'; ?>

                        <!-- Upload Form -->
                        <form action="upload_pp.php" method="POST" enctype="multipart/form-data" class="mt-3">
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input" id="image_path" name="image_path" required>
                                <label class="custom-file-label" for="image_path">Choose file</label>
                            </div>
                            <button type="submit" name="submit" class="btn btn-success btn-block">Upload</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- script -->
            <script>
                document.querySelector('.custom-file-input').addEventListener('change', function(e) {
                    var fileName = document.getElementById("image_path").files[0].name;
                    var nextSibling = e.target.nextElementSibling
                    nextSibling.innerText = fileName
                })
            </script>


            <!-- Right column: Information about user -->
            <div class="col-md-8">

                <div class="mb-2">
                    <strong>First Name:</strong> <span><?php echo $_SESSION['first_name']; ?></span>
                </div>

                <div class="mb-2">
                    <strong>Last Name:</strong> <span><?php echo $_SESSION['last_name']; ?></span>
                </div>

                <div class="mb-2">
                    <strong>Email:</strong> <span><?php echo $_SESSION['email']; ?></span>
                </div>
                <div class="mb-2">
                    <strong>Username:</strong> <span><?php echo $_SESSION['username']; ?></span>
                </div>
                <div class="mb-2">
                    <strong>Role:</strong> <span><?php echo $_SESSION['user_role']; ?></span>
                </div>


            </div>
        </div>

        <!-- Bottom Section -->
        <div class="mt-4 p-3 border rounded">
            <h5>Additional Information</h5>
            <p>TODO: Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto
                beatae vitae dicta sunt explicabo</p>
        </div>

    </div>


</body>

</html>