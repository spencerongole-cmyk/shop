<?php
include 'config.php';
if(!isset($_SESSION['user'])) header("Location: login.php");
$result = $conn->query("
SELECT e.name, e.salary,
SUM(a.status='Holiday') as holidays
FROM employees e
LEFT JOIN attendance a ON e.id=a.emp_id
GROUP BY e.id
");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Salary Sheet</title>
<link rel="stylesheet" href="assets/style.css">
</head>
<body>
<h2>Salary Sheet (Including Holidays)</h2>
<table>
<tr><th>Name</th><th>Base Salary</th><th>Holiday Days</th><th>Total Salary</th></tr>
<?php
while($r=$result->fetch_assoc()){
  $total = $r['salary'] + ($r['holidays'] * ($r['salary']/30));
  echo "<tr><td>{$r['name']}</td><td>{$r['salary']}</td><td>{$r['holidays']}</td><td>$total</td></tr>";
}
?>
</table>
</body>
</html>
