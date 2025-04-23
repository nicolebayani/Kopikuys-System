<?php
include 'config/dbcon.php';
include 'config/auth_middleware.php';

header("Content-Type: application/json");

// Authenticate user
$user = authenticate();
$userId = $user['id'];

// Remove token from DB
$query = "UPDATE cashier_staff SET token=NULL WHERE id=$userId";
if (mysqli_query($conn, $query)) {
    echo json_encode(["message" => "Logout successful. Token invalidated."]);
} else {
    http_response_code(500);
    echo json_encode(["message" => "Error logging out"]);
}

$conn->close();
?>