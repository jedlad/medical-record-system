// api/patients/delete.php
<?php
include "../db.php";

$id = $_GET['id'];
$conn->query("DELETE FROM patients WHERE id=$id");

echo json_encode(["status"=>"deleted"]);
?>