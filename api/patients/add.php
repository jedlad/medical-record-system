<?php
include "../db.php";

header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

// BASIC VALIDATION
if(empty($data['first_name']) || empty($data['last_name']) || empty($data['philhealth_id'])){
    echo json_encode(["status"=>"error","message"=>"Required fields missing"]);
    exit();
}

$stmt = $conn->prepare("
INSERT INTO patients
(first_name,middle_name,last_name,philhealth_id,age,address,sex,civil_status,diagnosis,remarks,contact_number,doctor_id,date_admitted,date_discharged)
VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)
");

$stmt->bind_param(
    "ssssissssssiss",
    $data['first_name'],
    $data['middle_name'],
    $data['last_name'],
    $data['philhealth_id'],
    $data['age'],
    $data['address'],
    $data['sex'],
    $data['civil_status'],
    $data['diagnosis'],
    $data['remarks'],
    $data['contact_number'],
    $data['doctor_id'],
    $data['date_admitted'],
    $data['date_discharged']
);

if($stmt->execute()){
    echo json_encode(["status"=>"success"]);
}else{
    echo json_encode(["status"=>"error","message"=>$conn->error]);
}
?>