<?php
session_start();
session_unset(); //clear variables
session_destroy();

// Redirect to login
header("Location: login_page.php");
exit;
