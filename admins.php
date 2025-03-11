<?php include ('includes/header.php'); ?>

<style>
    .beige-table {
        background-color: #f5f5dc; 
        color: #5a4a42; 
    }
    .beige-table th {
        background-color: #d9c8b4; 
        color: #3b2f2f; 
    }
    .beige-table td {
        background-color: #f8f1e3; 
    }
    .beige-table tbody tr:hover {
        background-color: #e4d5c0; 
    }
    .card-header {
        background-color: #d9c8b4 !important;
        color: #3b2f2f;
    }
    .btn-primary {
        background-color: #a0896b;
        border-color: #8c7355;
    }
    .btn-primary:hover {
        background-color: #8c7355;
    }
    .btn-success {
        background-color: #a89c86;
        border-color: #8c7e66;
    }
    .btn-danger {
        background-color: #c29b7a;
        border-color: #a97d5d;
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">
                <i class="fas fa-cash-register"></i> Cashier/Staff
                <a href="admins-create.php" class="btn btn-primary float-end"> Add Cashier/Staff </a>
            </h4>
        </div>
        <div class="card-body">
            <?php alertMessage(); ?>
            
            <?php
            $cashier_staff = getAll('cashier_staff');
            if(!$cashier_staff){
                echo '<h4>Something Went Wrong!</h4>';
                return false;
            }
            if(mysqli_num_rows($cashier_staff) > 0){
            ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered beige-table">
                    <thead> 
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($cashier_staff as $cashier_staffItem) :?>
                        <tr>
                            <td><?= $cashier_staffItem['id'] ?></td>
                            <td><?= $cashier_staffItem['name'] ?></td>
                            <td>
                                <a href="cashier_staff-edit.php?id=<?= $cashier_staffItem['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                                <a href="cashier_staff-delete.php?id=<?= $cashier_staffItem['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table> 
            </div>
            <?php
            } else {
                echo '<h4 class="mb-0">No Record Found</h4>';
            }
            ?>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>