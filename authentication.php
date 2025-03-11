<?php

if(isset($_SESSION['loggedIn'])){

    $name = validate($_SESSION['loggedInUser']['name']);

    $query = "SELECT * FROM cashier_staff WHERE name='$name' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) == 0){

        logoutSession();
        redirect('../../login.php', 'Ooops! Access Denied :(');
    }
}else{

    redirect('../../login.php', 'Please, Login to continue...');
}

?>