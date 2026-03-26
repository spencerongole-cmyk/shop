<?php
// InfinityFree-Compatible DB Configuration
$host = "sqlXXX.epizy.com";   // Change to your InfinityFree Host Name
$user = "epiz_XXXXXXX";       // Your DB Username
$pass = "YourPassword";       // Your DB Password
$db   = "epiz_XXXXXXX_attendance"; // Your DB Name

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

session_start();
?>
