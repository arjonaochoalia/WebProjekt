<?php
session_start();
$currentPage = basename($_SERVER['PHP_SELF']); //current page
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link <?= $currentPage === 'index.php' ? 'active' : '' ?>" href="index.php">Home</a>
            <a class="nav-item nav-link <?= $currentPage === 'events.php' ? 'active' : '' ?>" href="events.php">Events</a>
            <a class="nav-item nav-link <?= $currentPage === 'community.php' ? 'active' : '' ?>" href="community.php">Community</a>
        </div>

        <!-- Second navbar-nav with ml-auto to push to the right -->
        <div class="navbar-nav ml-auto">
            <!-- if user is logged in his name will be shown, otherwise login will be shown -->
            <?php if (isset($_SESSION['first_name'])): ?>
                <a class="nav-item nav-link <?= $currentPage === 'profile.php' ? 'active' : '' ?>" href="profile.php">
                    <?= htmlspecialchars($_SESSION['first_name']) ?>
                </a>
            <?php else: ?>
                <a class="nav-item nav-link <?= $currentPage === 'login_page.php' ? 'active' : '' ?>" href="login_page.php">
                    Login <span class="sr-only">(current)</span>
                </a>
            <?php endif; ?>
        </div>
    </div>
</nav>