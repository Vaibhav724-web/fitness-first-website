<?php
require 'db.php';
$name = $age = $height = $weight = $plan = $bmi = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name   = trim($_POST['name'] ?? '');
  $age    = intval($_POST['age'] ?? 0);
  $height = floatval($_POST['height'] ?? 0);
  $weight = floatval($_POST['weight'] ?? 0);

  if ($name && $height > 0 && $weight > 0) {
    $height_m = $height / 100;
    $bmi = round($weight / ($height_m * $height_m), 2);

    if ($bmi < 18.5) $plan = "You are underweight. Add calorie-dense foods such as nuts, seeds, dairy, and whole grains.";
    elseif ($bmi < 24.9) $plan = "You are in the healthy range. Balanced meals of fruits, vegetables, proteins, and whole grains.";
    elseif ($bmi < 29.9) $plan = "You are overweight. Control portions, cut processed sugar, more veggies and protein with cardio.";
    else $plan = "Your BMI indicates obesity. Prioritize calorie deficit, fiber-rich meals, lean proteins, hydration, and regular exercise.";

    $stmt = $conn->prepare("INSERT INTO bmi_records (user_name, age, height_cm, weight_kg, bmi) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sdddd", $name, $age, $height, $weight, $bmi);
    $stmt->execute();
    $bmi_id = $stmt->insert_id;
    $stmt->close();

    $stmt2 = $conn->prepare("INSERT INTO diet_plan (bmi_record_id, plan_text) VALUES (?, ?)");
    $stmt2->bind_param("is", $bmi_id, $plan);
    $stmt2->execute();
    $stmt2->close();
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Your Diet Plan</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>body{background:linear-gradient(135deg,#1f2937,#111827);color:#fff}.card{background:rgba(255,255,255,.06);backdrop-filter:blur(8px);border:1px solid rgba(255,255,255,.2)}</style>
</head>
<body class="py-5">
<div class="container">
  <div class="card p-4 mx-auto" style="max-width:760px">
    <h2 class="mb-3">Your Personalized Diet Plan</h2>
    <?php if($name): ?>
      <p><strong>Hello,</strong> <?php echo htmlspecialchars($name); ?></p>
      <?php if($age): ?><p><strong>Age:</strong> <?php echo htmlspecialchars($age); ?></p><?php endif; ?>
      <p><strong>BMI:</strong> <?php echo htmlspecialchars($bmi); ?></p>
      <div class="p-3 rounded" style="background:rgba(255,255,255,.08)">
        <h5 class="text-info">Plan</h5>
        <p class="mb-0"><?php echo htmlspecialchars($plan); ?></p>
      </div>
    <?php else: ?>
      <p class="text-warning">Please submit the form from NutriPlan.</p>
    <?php endif; ?>
    <div class="mt-4">
      <a href="nutriplan.php" class="btn btn-success">Back to NutriPlan</a>
      <a href="records.php" class="btn btn-outline-light">See BMI Records</a>
    </div>
  </div>
</div>
</body>
</html>