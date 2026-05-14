<?php

include "db.php";

header("Content-Type: application/json");

// 🔥 RECEIVE JSON FROM C#
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

$stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
$stmt->bind_param("s", $username);
$stmt->execute();

$res = $stmt->get_result();

if($res->num_rows > 0){

    $user = $res->fetch_assoc();

    // 🔥 CHECK PASSWORD
    if(
        $user['password'] == md5($password) ||
        $user['password'] == $password
    ){

        echo json_encode([
            "status"=>"success"
        ]);

    } else {

        echo json_encode([
            "status"=>"error",
            "message"=>"Invalid credentials"
        ]);
    }

} else {

    echo json_encode([
        "status"=>"error",
        "message"=>"User not found"
    ]);
}
?>