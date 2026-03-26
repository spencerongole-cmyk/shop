<?php
include 'config.php';
if(!isset($_SESSION['user'])) header("Location: login.php");

if(isset($_POST['add'])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $salary=$_POST['salary'];
    $join=$_POST['join_date'];
    $conn->query("INSERT INTO employees(name,email,salary,join_date) VALUES('$name','$email','$salary','$join')");
    echo "<p style='color:green'>Employee added successfully!</p>";
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Add Employee</title>
<link rel="stylesheet" href="assets/style.css">
</head>
<body>
<h2>Add Employee</h2>
<form method="post">
  <input type="text" name="name" placeholder="Name" required><br>
  <input type="email" name="email" placeholder="Email" required><br>
  <input type="number" step="0.01" name="salary" placeholder="Salary" required><br>
  <input type="date" name="join_date" required><br>
  <button type="submit" name="add">Add Employee</button>
</form>
</body>
</html>
