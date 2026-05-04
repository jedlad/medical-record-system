<?php
include "../db.php";

header("Content-Type: application/json");

$id = $_GET['id'] ?? 0;

if(!$id){
    echo json_encode(["error"=>"No ID"]);
    exit();
}

$res = $conn->query("SELECT * FROM patients WHERE id=$id");

if($res && $res->num_rows > 0){
    echo json_encode($res->fetch_assoc());
} else {
    echo json_encode(["error"=>"No data found"]);
}
?>