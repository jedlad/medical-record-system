<?php
include "../db.php";

header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

$id = $data['id'];

$sql = "UPDATE patients SET
first_name='{$data['first_name']}',
middle_name='{$data['middle_name']}',
last_name='{$data['last_name']}',
philhealth_id='{$data['philhealth_id']}',
age='{$data['age']}',
address='{$data['address']}',
sex='{$data['sex']}',
civil_status='{$data['civil_status']}',
diagnosis='{$data['diagnosis']}',
remarks='{$data['remarks']}',
contact_number='{$data['contact_number']}',
doctor_id='{$data['doctor_id']}',
date_admitted='{$data['date_admitted']}',
date_discharged='{$data['date_discharged']}'
WHERE id=$id";

if($conn->query($sql)){
    echo json_encode(["status"=>"success"]);
}else{
    echo json_encode(["status"=>"error","message"=>$conn->error]);
}
?>