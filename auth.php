<?php
include 'dbcon.php';
header("Content-Type: application/json");

$input = json_decode(file_get_contents('php://input'), true);

$username = $input['username'];
$password = $input['password'];

$query = "SELECT * FROM cashier_staff WHERE username='$username' LIMIT 1";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result);

    if (password_verify($password, $user['password'])) {
        $token = bin2hex(random_bytes(32)); 
        $userId = $user['id'];

        
        $update = "UPDATE cashier_staff SET token='$token' WHERE id=$userId";
        $query = "UPDATE cashier_staff SET token = '$token' WHERE id = '$userId'";
        mysqli_query($conn, $update);

        echo json_encode([
            "message" => "Login successful",
            "token" => $token,
            "user" => [
                "id" => $user['id'],
                "username" => $user['username'],
                "position" => $user['position']
            ]
        ]);
    } else {
        http_response_code(401);
        echo json_encode(["message" => "Invalid credentials"]);
    }
} else {
    http_response_code(401);
    echo json_encode(["message" => "Invalid credentials"]);
}
?>