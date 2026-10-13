<?php
session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = trim($_POST['email'] ?? '');
  $password = $_POST['password'] ?? '';

  $sql = "SELECT id, name, email, password FROM users WHERE email=? LIMIT 1";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $res = $stmt->get_result();

  if ($res->num_rows > 0) {
    $user = $res->fetch_assoc();
    if (password_verify($password, $user['password'])) {
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['user'] = $user['email'];
      $_SESSION['user_name'] = $user['name'];
      header("Location: index.php");
      exit();
    } else {
      $error = "Invalid password!";
    }
  } else {
    $error = "No account found!";
  }
  $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login -Fitness First</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
<style>
*{margin:0;padding:0;box-sizing:border-box}
body{font-family:'Poppins',sans-serif;height:100vh;display:flex;justify-content:center;align-items:center;background:url("images/gym.jpg") no-repeat center center fixed;background-size:cover;overflow:hidden}
.container{position:relative;z-index:2;width:100%;max-width:420px;padding:40px 35px;border-radius:20px;background:rgba(255,255,255,0.12);backdrop-filter:blur(15px);box-shadow:0 15px 40px rgba(0,0,0,0.5);text-align:center}
.container h2{font-size:2.2rem;margin-bottom:20px;color:#fff;font-weight:700}
.container input{width:100%;padding:14px 16px;margin:12px 0;border-radius:30px;border:none;background:rgba(255,255,255,0.15);color:#fff;font-size:1rem}
.container button{width:100%;padding:14px;margin-top:10px;border-radius:30px;border:none;background:linear-gradient(90deg,#ff914d,#ff6a3d);color:#fff;font-size:1rem;font-weight:bold;cursor:pointer}
.error{color:#ff4d4d;margin:10px 0;font-weight:bold}
.footer{margin-top:15px;font-size:.95rem;color:#fff}
.footer a{color:#ff914d;text-decoration:none;font-weight:bold}
</style>
</head>
<body>
  <div class="container">
    <h2>Login</h2>
    <form method="POST">
      <input type="email" name="email" placeholder="Enter your email" required>
      <input type="password" name="password" placeholder="Enter your password" required>
      <button type="submit">Login</button>
    </form>
    <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>
    <div class="footer">
      New user? <a href="signup.php">Signup here</a>
    </div>
  </div>
</body>
</html>