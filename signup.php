<?php
session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name  = trim($_POST['name'] ?? '');
  $email = trim($_POST['email'] ?? '');
  $pass  = $_POST['password'] ?? '';

  if (!$name || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($pass) < 6) {
    $error = "Please enter valid details (password 6+ chars).";
  } else {
    $hash = password_hash($pass, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $email, $hash);
    if ($stmt->execute()) {
      $_SESSION['user_id'] = $stmt->insert_id;
      $_SESSION['user'] = $email;
      $_SESSION['user_name'] = $name;
      header("Location: index.php");
      exit();
    } else {
      $error = "Email already exists!";
    }
    $stmt->close();
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Signup - Fitness First</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<style>
body{margin:0;height:100vh;display:flex;align-items:center;justify-content:center;background:#0b0f14 url('images/gym.jpg') center/cover no-repeat;font-family:Poppins,sans-serif}
.container{background:rgba(255,255,255,.1);backdrop-filter:blur(15px);border:1px solid rgba(255,255,255,.2);border-radius:16px;padding:32px;width:95%;max-width:420px;color:#fff}
h2{margin:0 0 16px}
input,button{width:100%;padding:12px;border-radius:10px;border:none;margin:8px 0}
input{background:rgba(255,255,255,.15);color:#fff}
button{background:linear-gradient(90deg,#ff914d,#ff6a3d);color:#fff;font-weight:600;cursor:pointer}
.error{color:#ff6b6b;margin:6px 0}
a{color:#ffd56b}
</style>
</head>
<body>
<div class="container">
  <h2>Create your account</h2>
  <?php if(isset($error)) echo "<div class='error'>$error</div>"; ?>
  <form method="POST">
    <input type="text" name="name" placeholder="Full Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password (min 6 chars)" required>
    <button type="submit">Signup</button>
  </form>
  <p>Already have an account? <a href="login.php">Login</a></p>
</div>
</body>
</html>