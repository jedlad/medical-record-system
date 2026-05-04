<?php
include "../db.php";

header("Content-Type: application/json");

$name = $_POST['name'] ?? '';
$type = $_POST['type'] ?? '';

if(empty($name) || empty($type)){
    echo json_encode(["status"=>"error","message"=>"Missing fields"]);
    exit();
}

$stmt = $conn->prepare("INSERT INTO doctors (name, type) VALUES (?, ?)");
$stmt->bind_param("ss", $name, $type);

if($stmt->execute()){
    echo json_encode(["status"=>"success"]);
}else{
    echo json_encode(["status"=>"error","message"=>$conn->error]);
}
?>