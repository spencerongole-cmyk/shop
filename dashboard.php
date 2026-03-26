<?php
include 'config.php';
if(!isset($_SESSION['user'])) header("Location: login.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Dashboard</title>
<link rel="stylesheet" href="assets/style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<nav>
  <a href="dashboard.php">Dashboard</a>
  <a href="add_employee.php">Add Employee</a>
  <a href="calendar.php">Holidays</a>
  <a href="salary.php">Salary</a>
  <a href="logout.php">Logout</a>
</nav>
<h2>Welcome, <?php echo $_SESSION['user']; ?> 👋</h2>
<p>Manage employees, holidays & salary records easily.</p>
</body>
</html>
