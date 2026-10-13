<?php
session_start();
require '../db.php';
header('Content-Type: application/json');

$userId = $_SESSION['user_id'] ?? null;
if (!$userId) { http_response_code(401); echo json_encode(['ok'=>false,'error'=>'Not logged in']); exit; }

$input = json_decode(file_get_contents('php://input'), true);
$name = trim($input['name'] ?? '');
$quantity = floatval($input['quantity'] ?? 0);
$cal = intval($input['calories'] ?? 0);
$prot = floatval($input['protein'] ?? 0);
$carb = floatval($input['carbs'] ?? 0);
$fat = floatval($input['fat'] ?? 0);

if ($name === '') { http_response_code(422); echo json_encode(['ok'=>false,'error'=>'Name required']); exit; }

$stmt = $conn->prepare("INSERT INTO food_log (user_id, name, quantity, calories, protein, carbs, fat) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("isidddd", $userId, $name, $quantity, $cal, $prot, $carb, $fat);
$stmt->execute();
$insertId = $stmt->insert_id;
$stmt->close();

$tot = $conn->prepare("SELECT COALESCE(SUM(calories),0) c, COALESCE(SUM(protein),0) p, COALESCE(SUM(carbs),0) cb, COALESCE(SUM(fat),0) f
                       FROM food_log WHERE user_id=? AND DATE(logged_at)=CURDATE()");
$tot->bind_param("i", $userId);
$tot->execute();
$totals = $tot->get_result()->fetch_assoc();
$tot->close();

echo json_encode([
  'ok'=>true,
  'entry'=>['id'=>$insertId,'name'=>$name,'quantity'=>$quantity,'calories'=>$cal,'protein'=>$prot,'carbs'=>$carb,'fat'=>$fat],
  'totals'=>['calories'=>(int)$totals['c'],'protein'=>round((float)$totals['p'],2),'carbs'=>round((float)$totals['cb'],2),'fat'=>round((float)$totals['f'],2)]
]);