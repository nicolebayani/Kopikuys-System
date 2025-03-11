<?php

require 'config/function.php';

if(isset($_POST['loginBtn'])){

    $name = validate($_POST['name']);
    $password = validate($_POST['password']);

    if($name != '' && $password != ''){

        $query = "SELECT * FROM cashier_staff WHERE name = '$name' LIMIT 1";
        $result = mysqli_query($conn, $query);
        if($result){

            if(mysqli_num_rows($result) == 1){

                $row = mysqli_fetch_assoc($result);
                $hashedPassword = $row['password'];

                if(!password_verify($password, $hashedPassword)){
                    redirect('login.php','Invalid Password');
                }

                $_SESSION['loggedIn'] = true;
                $_SESSION['loggedInUser'] = [
                    'user_id' => $row['id'],
                    'name' => $row['name'],

                ];

                redirect('admin/assets/admins-create.php','Logged In Succeessfully :)');

            }else{
                redirect('login.php','Invalid Name');
            }
        }else{
            redirect('login.php','Something went wrong!');
        }
    }else{
        redirect('login.php','Please fill all fields!'); 
    }
}





?>