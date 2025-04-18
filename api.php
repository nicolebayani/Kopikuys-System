<?php
include 'dbcon.php';

header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $result = $conn->query("SELECT * FROM cashier_staff WHERE id=$id");
            $data = $result->fetch_assoc();
            echo json_encode($data);
        } else {
            $result = $conn->query("SELECT * FROM cashier_staff");
            $users = [];
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
            echo json_encode($users);
        }
        break;

    case 'POST':
        $first_name = $input['first_name'];
        $middle_name = $input['middle_name'];
        $last_name = $input['last_name'];
        $email = $input['email'];
        $username = $input['username'];
        $password = password_hash($input['password'], PASSWORD_BCRYPT);
        $position = $input['position'];
        $conn->query("INSERT INTO cashier_staff (first_name, middle_name, last_name, email, username, password, position) 
                      VALUES ('$first_name', '$middle_name', '$last_name', '$email', '$username', '$password', '$position')");
        echo json_encode(["message" => "Cashier/Staff added successfully"]);
        break;

    case 'PUT':
        $id = $_GET['id'];
        $first_name = $input['first_name'];
        $middle_name = $input['middle_name'];
        $last_name = $input['last_name'];
        $email = $input['email'];
        $username = $input['username'];
        $password = password_hash($input['password'], PASSWORD_BCRYPT);
        $position = $input['position'];
        $conn->query("UPDATE cashier_staff SET first_name='$first_name', middle_name='$middle_name', last_name='$last_name', email='$email', username='$username', password='$password', position='$position' WHERE id=$id");
        echo json_encode(["message" => "Cashier/Staff updated successfully"]);
        break;

    case 'DELETE':
        $id = $_GET['id'];
        $conn->query("DELETE FROM users WHERE id=$id");
        echo json_encode(["message" => "Cashier/Staff deleted successfully"]);
        break;

    default:
        echo json_encode(["message" => "Invalid request method"]);
        break;
}

$conn->close();
?>