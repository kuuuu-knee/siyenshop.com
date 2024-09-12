<?php
session_start(); // Start session

// Destroy session data
session_destroy();

// Redirect to login page
header("Location: index.php");
exit;
?>
