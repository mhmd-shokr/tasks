<?php
session_start(); // Start the session to access session variables
if (!isset($_SESSION['id'])) { // Check if user is logged in
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

session_unset(); // Unset all session variables
session_destroy(); // Destroy the session
header("Location: login.php"); // Redirect to login page after logging out
exit();
?>