<?php

include "../db.php";

header("Content-Type: application/json");

$data = [];

$res = $conn->query("SELECT * FROM doctors");

while($row = $res->fetch_assoc()){
    $data[] = $row;
}

echo json_encode($data);
?>