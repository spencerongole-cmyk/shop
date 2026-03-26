<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login</title>
<link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="container">
<h2>Login</h2>
<form method="post">
  <input type="text" name="username" placeholder="Username" required><br>
  <input type="password" name="password" placeholder="Password" required><br>
  <button type="submit" name="login">Login</button>
</form>

<?php
if(isset($_POST['login'])){
    $u = $_POST['username'];
    $p = $_POST['password'];
    $res = $conn->query("SELECT * FROM users WHERE username='$u' AND password='$p'");
    if($res->num_rows>0){
        $_SESSION['user']=$u;
        header('Location: dashboard.php');
        exit;
    } else {
        echo "<p style='color:red;'>Invalid username or password</p>";
    }
}
?>
</div>
</body>
</html>
