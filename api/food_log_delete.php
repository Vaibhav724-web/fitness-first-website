<?php
session_start();
require '../db.php';
header('Content-Type: application/json');

$userId = $_SESSION['user_id'] ?? null;
if (!$userId) { http_response_code(401); echo json_encode(['ok'=>false,'error'=>'Not logged in']); exit; }

$all = isset($_GET['all']) ? (int)$_GET['all'] : 0;
if ($all === 1) {
  $stmt = $conn->prepare("DELETE FROM food_log WHERE user_id=? AND DATE(logged_at)=CURDATE()");
  $stmt->bind_param("i", $userId);
  $stmt->execute();
  $stmt->close();
  echo json_encode(['ok'=>true,'cleared'=>true]); exit;
}

$input = json_decode(file_get_contents('php://input'), true);
$id = isset($input['id']) ? (int)$input['id'] : 0;
if ($id<=0) { http_response_code(422); echo json_encode(['ok'=>false,'error'=>'Invalid id']); exit; }

$chk = $conn->prepare("SELECT id FROM food_log WHERE id=? AND user_id=?");
$chk->bind_param("ii", $id, $userId);
$chk->execute();
$r=$chk->get_result();
if (!$r->fetch_assoc()) { http_response_code(403); echo json_encode(['ok'=>false,'error'=>'Not allowed']); exit; }
$chk->close();

$del = $conn->prepare("DELETE FROM food_log WHERE id=? LIMIT 1");
$del->bind_param("i", $id);
$del->execute();
$del->close();

echo json_encode(['ok'=>true,'deleted'=>true]);