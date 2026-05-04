<?php
include "../db.php";

header("Content-Type: application/json");

$key = $_GET['key'] ?? '';

$data = [];

$sql = "SELECT 
            p.id,
            p.first_name,
            p.last_name,
            p.diagnosis,
            p.doctor_id,
            COALESCE(d.name, 'No Doctor Assigned') AS doctor_name
        FROM patients p
        LEFT JOIN doctors d ON p.doctor_id = d.id";

if($key != ''){
    $key = $conn->real_escape_string($key);
    $sql .= " WHERE p.last_name LIKE '%$key%' 
              OR p.philhealth_id LIKE '%$key%'";
}

$res = $conn->query($sql);

while($row = $res->fetch_assoc()){
    $data[] = $row;
}

echo json_encode($data);
?>