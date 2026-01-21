<!--top navigation bar-->
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$currentPage = basename($_SERVER['PHP_SELF']); //current page
?>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark modern-navbar">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">

        <!-- active page -->
        <div class="navbar-nav mr-auto">
            <a class="nav-item nav-link <?= $currentPage === 'index.php' ? 'active' : '' ?>" href="index.php">Home</a>
            <a class="nav-item nav-link <?= $currentPage === 'events.php' ? 'active' : '' ?>" href="events.php">Events</a>
            <a class="nav-item nav-link <?= $currentPage === 'feedback.php' ? 'active' : '' ?>" href="feedback.php">Feedback</a>
        </div>

        <!-- Login or Name + Logout -->
        <div class="navbar-nav ml-auto">
            <?php if (isset($_SESSION['first_name'])): ?>
                <a class="nav-item nav-link <?= $currentPage === 'profile.php' ? 'active' : '' ?>" href="profile.php">
                    <?= htmlspecialchars($_SESSION['first_name']) ?>
                </a>
                <a class="nav-item nav-link logout-btn<?= $currentPage === 'logout.php' ? 'active' : '' ?>" href="logout.php">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            <?php else: ?>
                <a class="nav-item nav-link login-btn <?= $currentPage === 'login.php' ? 'active' : '' ?>" href="login.php">
                    <i class="fas fa-sign-in-alt"></i> Login <span class="sr-only">(current)</span>
                </a>
            <?php endif; ?>
        </div>
    </div>
</nav>