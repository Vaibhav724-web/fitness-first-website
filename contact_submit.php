<?php
require 'db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name    = trim($_POST['name'] ?? '');
  $email   = trim($_POST['email'] ?? '');
  $address = trim($_POST['address'] ?? '');
  $message = trim($_POST['message'] ?? '');
  if ($name && filter_var($email, FILTER_VALIDATE_EMAIL) && $message) {
    $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, address, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $address, $message);
    $stmt->execute();
    $stmt->close();
    header("Location: index.php?contact=1#contact");
  } else {
    header("Location: index.php?contact=0#contact");
  }
  exit;
}
header("Location: index.php");
exit;