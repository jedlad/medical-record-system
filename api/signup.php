<?php

include "db.php";

header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

$username = trim($data['username'] ?? '');
$password = trim($data['password'] ?? '');

if($username == "" || $password == ""){
    echo json_encode([
        "status"=>"error",
        "message"=>"Please fill all fields"
    ]);
    exit();
}

// 🔥 CHECK IF USER EXISTS
$check = $conn->prepare(
    "SELECT id FROM users WHERE username=?"
);

$check->bind_param("s", $username);

$check->execute();

$res = $check->get_result();

if($res->num_rows > 0){

    echo json_encode([
        "status"=>"error",
        "message"=>"Username already exists"
    ]);

    exit();
}

// 🔥 INSERT USER
$stmt = $conn->prepare(
    "INSERT INTO users(username,password)
     VALUES(?,?)"
);

$stmt->bind_param("ss", $username, $password);

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