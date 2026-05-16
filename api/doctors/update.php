<?php

include "../db.php";

header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

$id = $data['id'] ?? '';
$name = $data['name'] ?? '';
$type = $data['type'] ?? '';

if($id == "" || $name == "" || $type == ""){
    echo json_encode([
        "status"=>"error",
        "message"=>"Missing fields"
    ]);
    exit();
}

$stmt = $conn->prepare(
    "UPDATE doctors SET name=?, type=? WHERE id=?"
);

$stmt->bind_param("ssi", $name, $type, $id);

if($stmt->execute()){

    echo json_encode([
        "status"=>"success"
    ]);

}else{

    echo json_encode([
        "status"=>"error",
        "message"=>$conn->error
    ]);
}
?>