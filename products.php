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
        background-color: #8c7355;
        border-color: #8c7e66;
    }
    .btn-danger {
        background-color:rgb(180, 161, 135);
        border-color: #a97d5d;
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">
                <i class="fas fa-coffee"></i> Products
                <a href="products-create.php" class="btn btn-primary float-end"> Add Products </a>
            </h4>
        </div>
        <div class="card-body">
            <?php alertMessage(); ?>
            
            <?php
            $products = getAll('products');
            if(!$products){
                echo '<h4>Something Went Wrong!</h4>';
                return false;
            }
            if(mysqli_num_rows($products) > 0){
            ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered beige-table">
                    <thead> 
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($products as $item) :?>
                        <tr>
                            <td><?= $item['id'] ?></td>
                            <td><?= $item['name'] ?></td>
                            <td>

                                <img src="../<?= $item['image'] ?>" style="width:50px;height:50px;" alt="Img"/>
                            </td>
                           
                            <td>
                                <?php if($item['status'] == 1){
                                    echo '<span class="badge bg-danger">Not Available</span>';
                                }else{
                                    echo '<span class="badge bg-success">Available</span>';
                                }
                                ?>
                            </td>
                            <td>
                                <a href="products-edit.php?id=<?= $item['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                                <a 
                                    href="products-delete.php?id=<?= $item['id']; ?>" 
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete this image?')"
                                >
                                    Delete
                                </a>
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