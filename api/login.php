<?php
header("Content-Type: application/json");
include "db.php";

$data = json_decode(file_get_contents("php://input"), true);

// fallback if form-data (para web)
$username = $data['username'] ?? $_POST['username'] ?? '';
$password = $data['password'] ?? $_POST['password'] ?? '';

if(empty($username) || empty($password)){
    echo json_encode([
        "status" => "error",
        "message" => "Username and password required"
    ]);
    exit;
}

// NOTE: using md5 based sa imong existing DB setup
$password = md5($password);

$sql = "SELECT id, username FROM users WHERE username='$username' AND password='$password'";
$res = $conn->query($sql);

if($res->num_rows > 0){
    $user = $res->fetch_assoc();

    echo json_encode([
        "status" => "success",
        "user" => $user
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Invalid credentials"
    ]);
}
?>