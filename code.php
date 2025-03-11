<?php

include('../../config/function.php');

if(isset($_POST['SaveCashier/Staff'])){
    if (!empty($_POST['name']) && !empty($_POST['password']) && !empty($_POST['position'])) {
        $name = validate($_POST['name']);
        $password = validate($_POST['password']);
        $position = validate($_POST['position']);
        
        $bcrypt_password = password_hash($password, PASSWORD_BCRYPT);

        $data = [
            'name' => $name,
            'password' => $bcrypt_password,
            'position' => $position
        ];
        $result = insert('cashier_staff', $data);

        if($result){
            redirect('admins.php', 'Cashier/Staff Created Successfully'); 
        }else{
            redirect('admins-create.php', 'Something Went Wrong!.');
        }
    } else {
        redirect('admins-create.php', 'Please fill required fields.');
    }
}

if(isset($_POST['updateCashier/Staff'])){ 
    if (!empty($_POST['adminId']) && !empty($_POST['name']) && !empty($_POST['position'])) {
        $adminId = validate($_POST['adminId']);
        $adminData = getById('cashier_staff', $adminId);
        
        if($adminData['status'] != 200 ){
            redirect('cashier_staff-edit.php?id='.$adminId, 'Invalid Admin ID.');
        }

        $name = validate($_POST['name']);
        $password = validate($_POST['password']);
        $position = validate($_POST['position']);
        
        if($password != ''){
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        }else{
            $hashedPassword = $adminData['data']['password'];
        }

        $data = [
            'name' => $name,
            'password' => $hashedPassword,
            'position' => $position 
        ];
        $result = update('cashier_staff', $adminId, $data);

        if($result){
            redirect('cashier_staff-edit.php?id='.$adminId, 'Cashier/Staff Updated Successfully'); 
        }else{
            redirect('cashier_staff-edit.php?id='.$adminId, 'Something Went Wrong!.');
        }
    } else {
        redirect('admins-create.php', 'Please fill required fields.');
    }
}
?>