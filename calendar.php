<?php
include 'config.php';
if(!isset($_SESSION['user'])) header("Location: login.php");

if(isset($_POST['add'])){
  $d=$_POST['date']; $n=$_POST['name'];
  $conn->query("INSERT INTO holidays(holiday_date,holiday_name) VALUES('$d','$n')");
  echo "<p style='color:green;'>Holiday added successfully!</p>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Holiday Calendar</title>
<link rel="stylesheet" href="assets/style.css">
</head>
<body>
<h2>Holiday Calendar</h2>
<table>
<tr><th>Date</th><th>Holiday Name</th></tr>
<?php
$res=$conn->query("SELECT * FROM holidays ORDER BY holiday_date ASC");
while($r=$res->fetch_assoc()){
  echo "<tr><td>{$r['holiday_date']}</td><td>{$r['holiday_name']}</td></tr>";
}
?>
</table>
<form method="post">
<h3>Add Holiday</h3>
<input type="date" name="date" required>
<input type="text" name="name" placeholder="Holiday Name" required>
<button type="submit" name="add">Add Holiday</button>
</form>
</body>
</html>
