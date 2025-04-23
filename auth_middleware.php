<?php
require_once 'dbcon.php';

function authenticate() {
    $headers = apache_request_headers();
    if (!isset($headers['Authorization'])) {
        http_response_code(401);
        echo json_encode(["message" => "No token provided"]);
        exit;
    }

    $token = trim(str_replace('Bearer', '', $headers['Authorization']));
    $query = "SELECT * FROM cashier_staff WHERE token='$token' LIMIT 1";
    $result = mysqli_query($GLOBALS['conn'], $query);

    if (mysqli_num_rows($result) != 1) {
        http_response_code(401);
        echo json_encode(["message" => "Invalid token"]);
        exit;
    }

    return mysqli_fetch_assoc($result); // return authenticated user
}
?>
