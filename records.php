<?php
require 'db.php';
$sql = "SELECT r.id, r.user_name, r.age, r.height_cm, r.weight_kg, r.bmi, d.plan_text, r.created_at
        FROM bmi_records r
        JOIN diet_plan d ON r.id = d.bmi_record_id
        ORDER BY r.created_at DESC";
$res = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>BMI & Diet Record</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4" style="background:#0b0f14;color:#fff">
<div class="container">
  <h2 class="mb-3"> BMI & Diet Record</h2>
  <a href="index.php" class="btn btn-outline-light mb-3">Back</a>
  <div class="table-responsive">
    <table class="table table-dark table-striped align-middle">
      <thead>
        <tr>
          <th>ID</th><th>Name</th><th>Age</th><th>Height (cm)</th><th>Weight (kg)</th>
          <th>BMI</th><th>Diet Plan</th><th>Date</th>
        </tr>
      </thead>
      <tbody>
        <?php while($row = $res->fetch_assoc()): ?>
        <tr>
          <td><?= $row['id'] ?></td>
          <td><?= htmlspecialchars($row['user_name']) ?></td>
          <td><?= htmlspecialchars($row['age']) ?></td>
          <td><?= htmlspecialchars($row['height_cm']) ?></td>
          <td><?= htmlspecialchars($row['weight_kg']) ?></td>
          <td><?= htmlspecialchars($row['bmi']) ?></td>
          <td><?= htmlspecialchars($row['plan_text']) ?></td>
          <td><?= htmlspecialchars($row['created_at']) ?></td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>
</body>
</html>