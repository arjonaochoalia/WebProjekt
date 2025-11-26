<!DOCTYPE html>
<html lang="en">

<head>
    <title>Profile</title>
    <?php include "head_links.php" ?>
</head>

<body>
    <?php include 'nav.php' ?>
    <div class="container mt-4">

        <div class="row">

            <div class="col-md-4">
                <div class="card text-center shadow-sm p-3 mb-4 bg-white rounded">
                    <div class="card-body">
                        <?php include 'load_pp.php'; ?>
                        <!-- form to let user change his profile picture-->
                        <form action="upload_pp.php" method="POST" enctype="multipart/form-data" class="mt-3">
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input" id="image_path" name="image_path" required>
                                <label class="custom-file-label" for="image_path">Choose file</label>
                            </div>
                            <button type="submit" name="submit" class="btn btn-success w-100">Upload</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Display user info-->
            <div class="col-md-8">
                <div class="card shadow-sm p-3 mb-4 bg-white rounded">
                    <div class="card-body">
                        <h3 class="mb-4 text-center">Profile Information</h3>
                        <div class="mb-2"><strong>First Name:</strong> <span><?php echo $_SESSION['first_name']; ?></span></div>
                        <div class="mb-2"><strong>Last Name:</strong> <span><?php echo $_SESSION['last_name']; ?></span></div>
                        <div class="mb-2"><strong>Email:</strong> <span><?php echo $_SESSION['email']; ?></span></div>
                        <div class="mb-2"><strong>Username:</strong> <span><?php echo $_SESSION['username']; ?></span></div>
                        <div class="mb-2"><strong>Role:</strong> <span><?php echo $_SESSION['user_role']; ?></span></div>
                    </div>
                </div>
            </div>

        </div>
        <?php
        if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') { ?>
            <div class="container px-0 mt-5 border">
                <?php include 'load_user_list.php'; ?>
            </div>
        <?php } ?>






        <!-- Section to load and display events that current user has as favorite-->
        <div class="container px-0 mt-5 border">
            <h2 class="p-4 mb-4 bg-warning text-dark rounded">My Favourite Events</h2>
            <div class="d-flex flex-wrap justify-content-between mb-5 ml-4">
                <?php include 'load_favorite_events.php'; ?>
            </div>
        </div>

        <div class="container px-0 mt-5 border">
            <h2 class="p-4 mb-4 bg-success text-white rounded">My Booked Events</h2>
            <div class="d-flex flex-wrap justify-content-between mb-5 ml-4">
                <?php include 'load_part_events.php'; ?>
            </div>
        </div>


        <script>
            document.querySelector('.custom-file-input').addEventListener('change', function(e) {
                var fileName = document.getElementById("image_path").files[0].name;
                var nextSibling = e.target.nextElementSibling
                nextSibling.innerText = fileName
            })
        </script>

        <?php include "footer.php" ?>
</body>

</html>