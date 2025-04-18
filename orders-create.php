<?php include ('includes/header.php'); ?>

<style>
    .beige-card {;
        background-color:rgb(255, 255, 255); 
        color:rgb(0, 0, 0);
    }
    .beige-card-header {
        background-color: #d9c8b4 !important; 
        color: #3b2f2f; 
    }
    .form-control {
        background-color: #f8f1e3; 
        border: 1px solid #3b2f2f;
        color: #a0896b;
    }
    .form-control:focus {
        background-color:rgb(255, 255, 255); 
        border-color: #a0896b;
        box-shadow: 0 0 5px rgba(160, 137, 107, 0.5);
    }
    .btn-primary {
        background-color: #8c7355;
        border-color: #a97d5d;
    }
    .btn-primary:hover {
        background-color: #8c7355;
    }
    .btn-secondary {
        background-color: #8c7355;
        border-color: #a97d5d;
    }
    .container-fluid {
        border-radius: 25px;
        background-color:rgb(255, 255, 255); 
        padding: 20px;
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm beige-card">
        <div class="card-header beige-card-header">
            <h4 class="mb-0">
                <i class="fas fa-cash-register"></i> Create Order
                <a href="orders.php" class="btn btn-secondary float-end"> Back </a>
            </h4>
        </div>
        <div class="card-body">

            <?php alertMessage(); ?>

            <form action="orders-code.php" method="POST">

                <div class="row">
                <div class="col-md-3 mb-3">
                        <label for="">Select Product *</label>
                        <select name="product_id" class="form-select mySelect2">
                            <option value="" >-- Select Product --</option>
                            <?php
                                $products = getAll('products');
                                if($products){
                                    if(mysqli_num_rows($products) > 0){
                                        foreach($products as $prodItem){
                                            ?>
                                            <option value="<? $prodItem['id']; ?>"><?= $prodItem['name']; ?></option>
                                            <?php
                                        }
                                    }else{
                                        echo "<option value=''>No Product Found</option>";
                                    }
                                }else{
                                    echo "<option value=''>Something Went Wrong </option>";
                                }
                            ?>
                        </select>
                    </div>
                <div class="col-md-2 mb-3">
                        <label for="">Quantity </label>
                        <input type="number" name="quantity" value="1" class="form-control" />
                    </div>
                <div class="col-md-3 mb-3 text-end">
                    <br/>
                    <button type="submit" name="addItem" class="btn btn-primary">Add Product</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header">
            <h4 class="mb-0">Products</h4>
        </div>
        <div class="card-body">
            <?php
            if(isset($_SESSION['productItems'])){

                ?>
                <div class="table-responsive mb-3">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i = 1;
                                foreach($sessionProducts as $key => $item) : ?>
                                <tr>
                                    <td><?= $key; ?></td>
                                    <td><?= $item['name']; ?></td>
                                    <td><?= $item['price']; ?></td>
                                    <td>
                                        <div class="input-group">
                                            <button class="input-group-text">-</button>
                                            <input type="text" value="<? =$item['quantity']; ?>" class="qty quantityInput" />
                                            <button class="input-group-text">+</button>
                                        </div>
                                    </td>
                                    <td> <?= number_format($item['price'] * $item['quantity'], 0); ?> </td>
                                    <td>
                                        <a href="order-item-delete.php?index="<?= $key; ?> class="btn btn-danger">Remove</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php

            }else{
                echo '<h5> No Products Added </h5>';
            }   
            ?>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>