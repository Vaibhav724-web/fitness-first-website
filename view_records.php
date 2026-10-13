<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "project";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) die("Error: " . $conn->connect_error);

$sql = "SELECT r.id, r.user_name, r.height_cm, r.weight_kg, r.bmi, d.plan_text, r.created_at
        FROM bmi_records r
        JOIN diet_plan d ON r.id = d.bmi_record_id
        ORDER BY r.created_at DESC";

$result = $conn->query($sql);

echo "<div style='max-width:900px;margin:40px auto;font-family:Arial;'>";
echo "<h2>All BMI & Diet Records</h2>";
echo "<table border='1' cellpadding='10' cellspacing='0' style='width:100%;border-collapse:collapse;'>";
echo "<tr style='background:#eee'>
        <th>ID</th>
        <th>Name</th>
        <th>Height (cm)</th>
        <th>Weight (kg)</th>
        <th>BMI</th>
        <th>Diet Plan</th>
        <th>Date</th>
      </tr>";

while($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['user_name']}</td>
            <td>{$row['height_cm']}</td>
            <td>{$row['weight_kg']}</td>
            <td>{$row['bmi']}</td>
            <td>{$row['plan_text']}</td>
            <td>{$row['created_at']}</td>
          </tr>";
}
echo "</table></div>";

$conn->close();
?>