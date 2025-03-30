<?php

include('../../config/function.php');

if(isset($_POST['SaveCashier/Staff'])){
    if (!empty($_POST['first_name']) && !empty($_POST['middle_name']) && !empty($_POST['last_name']) 
        && !empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password']) 
        && !empty($_POST['position'])) {

        $first_name = validate($_POST['first_name']);
        $middle_name = validate($_POST['middle_name']);
        $last_name = validate($_POST['last_name']);
        $email = validate($_POST['email']);
        $username = validate($_POST['username']);
        $password = validate($_POST['password']);
        $position = validate($_POST['position']);

        $bcrypt_password = password_hash($password, PASSWORD_BCRYPT);

        $data = [
            'first_name' => $first_name,
            'middle_name' => $middle_name,
            'last_name' => $last_name,
            'email' => $email,
            'username' => $username,
            'password' => $bcrypt_password,
            'position' => $position
        ];
        
        $result = insert('cashier_staff', $data);

        if($result){
            redirect('admins.php', 'Cashier/Staff Created Successfully'); 
        } else {
            redirect('admins-create.php', 'Something Went Wrong!');
        }
    } else {
        redirect('admins-create.php', 'Please fill in all required fields.');
    }
}

if(isset($_POST['updateCashier/Staff'])){ 
    if (!empty($_POST['adminId']) && !empty($_POST['first_name']) && !empty($_POST['middle_name']) 
        && !empty($_POST['last_name']) && !empty($_POST['email']) && !empty($_POST['username']) 
        && !empty($_POST['position'])) {

        $adminId = validate($_POST['adminId']);
        $adminData = getById('cashier_staff', $adminId);
        
        if($adminData['status'] != 200 ){
            redirect('cashier_staff-edit.php?id='.$adminId, 'Invalid Admin ID.');
        }

        $first_name = validate($_POST['first_name']);
        $middle_name = validate($_POST['middle_name']);
        $last_name = validate($_POST['last_name']);
        $email = validate($_POST['email']);
        $username = validate($_POST['username']);
        $password = validate($_POST['password']);
        $position = validate($_POST['position']);
        
        if($password != ''){
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        } else {
            $hashedPassword = $adminData['data']['password'];
        }

        $data = [
            'first_name' => $first_name,
            'middle_name' => $middle_name,
            'last_name' => $last_name,
            'email' => $email,
            'username' => $username,
            'password' => $hashedPassword,
            'position' => $position 
        ];
        
        $result = update('cashier_staff', $adminId, $data);

        if($result){
            redirect('cashier_staff-edit.php?id='.$adminId, 'Cashier/Staff Updated Successfully'); 
        } else {
            redirect('cashier_staff-edit.php?id='.$adminId, 'Something Went Wrong!');
        }
    } else {
        redirect('admins-create.php', 'Please fill in all required fields.');
    }
}


if (isset($_POST['saveCategory'])){

    $name = validate($_POST['name']);
    $description = validate($_POST['description']);
    $status = isset($_POST['status']) == true ? 1:0;

    $data = [
        'name' => $name,
        'description' => $description,
        'status' => $status
    ];
    $result = insert('categories', $data);

    if($result){
        redirect('categories.php', 'Category Created Successfully'); 
    } else {
        redirect('categories-create.php', 'Something Went Wrong!');
    }
}
?>