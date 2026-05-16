<?php

include "../db.php";

header("Content-Type: application/json");

$id = $_GET['id'] ?? '';

if($id == ""){
    echo json_encode([
        "status"=>"error"
    ]);
    exit();
}

$stmt = $conn->prepare(
    "DELETE FROM doctors WHERE id=?"
);

$stmt->bind_param("i", $id);

if($stmt->execute()){

    echo json_encode([
        "status"=>"success"
    ]);

}else{

    echo json_encode([
        "status"=>"error"
    ]);
}
?>