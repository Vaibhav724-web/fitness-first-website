<?php
session_start();
require '../db.php';
header('Content-Type: application/json');

$userId = $_SESSION['user_id'] ?? null;
if (!$userId) { http_response_code(401); echo json_encode(['ok'=>false,'error'=>'Not logged in']); exit; }

$stmt = $conn->prepare("SELECT id, name, quantity, calories, protein, carbs, fat, logged_at
                        FROM food_log WHERE user_id=? AND DATE(logged_at)=CURDATE()
                        ORDER BY logged_at DESC");
$stmt->bind_param("i", $userId);
$stmt->execute();
$res = $stmt->get_result();

$items=[]; $totals=['calories'=>0,'protein'=>0,'carbs'=>0,'fat'=>0];
while($row=$res->fetch_assoc()){
  $items[]=$row;
  $totals['calories'] += (int)$row['calories'];
  $totals['protein']  += (float)$row['protein'];
  $totals['carbs']    += (float)$row['carbs'];
  $totals['fat']      += (float)$row['fat'];
}
$stmt->close();

echo json_encode(['ok'=>true,'items'=>$items,'totals'=>[
  'calories'=>$totals['calories'],
  'protein'=>round($totals['protein'],2),
  'carbs'=>round($totals['carbs'],2),
  'fat'=>round($totals['fat'],2)
]]);